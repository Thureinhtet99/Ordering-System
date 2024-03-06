<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Direct login page
    public function loginPage()
    {
        return view("login");
    }

    // Direct register page
    public function registerPage()
    {
        return view("register");
    }

    // Dashboard
    public function dashboard()
    {
        if (Auth::user()->role == "admin") {
            return redirect()->route("admin#category");
        }
        return redirect()->route("user#category");
    }

    // Password change
    public function adminPassword()
    {
        return view("admin.password.change");
    }

    public function adminPasswordForm()
    {
        $this->passwordValidatonCheck();
        $data = User::select('password')->where("id", Auth::user()->id)->first();

        if (Hash::check(request()->oldPassword, $data->password)) {
            User::where("id", Auth::user()->id)->update([
                "password" => Hash::make(request()->newPassword)
            ]);
            // Auth::logout();
            return back()->with(["passwordchange" => "Password Changed"]);
        }
        return back()->with(["notMatch" => "The old password not match"]);
    }

    // Account
    // Details
    public function accountDetail()
    {
        return view("admin.account.details");
    }
    // Edit
    public function accountEdit()
    {
        return view("admin.account.edit");
    }
    // Update
    public function accountUpdate(Request $request, $id)
    {
        $this->validationCheck($request);
        $datas = $this->getFromData($request);

        if ($request->hasFile("image")) {
            $dbImage = User::where("id", $id)->first(); // Old value in Database
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete("public/$dbImage");
            }

            $fileName = uniqid() . $request->file("image")->getClientOriginalName();  //Store in Project
            $request->file("image")->storeAs("public", $fileName);  //Store in Project
            $datas["image"] = $fileName;    //Store in Database
        }

        User::where("id", $id)->update($datas);
        return redirect()->route("account#detail")->with(["updateSuccess" => "Account Updated"]);
    }

    // List
    public function accountList()
    {
        $admins = User::when(request("search"), function ($query) {
            $query->orWhere("name", "like", "%" . request("search") . "%")
                ->orWhere("email", "like", "%" . request("search") . "%")
                ->orWhere("phone", "like", "%" . request("search") . "%");
        })
            ->where("role", "admin")
            ->paginate(3);
        $admins->appends(request()->all());
        return view("admin.account.list", compact("admins"));
    }

    // Delete
    public function accountDelete($id)
    {
        User::where("id", $id)->delete();
        return back()->with(["categoryDelete" => "Delete Success"]);
    }

    // Role
    public function accountRole($id){
        $accounts = User::where("id", $id)->first();
        return view('admin.account.role', compact("accounts"));
    }

    // Change role
    public function accountChangeRole(Request $request, $id){
        $datas = $this->requestRole($request);
        User::where("id", $id)->update($datas);

        return redirect()->route("account#list");
    }

    // contactIndex
    public function contactIndex()
    {
        $contacts = Contact::paginate(5);
        $contacts->appends(request()->all());
        // dd($contacts->toArray());
        return view("admin.contact.index", compact("contacts"));
    }

    // contactDetails
    public function contactDetails($id)
    {
        $contacts = Contact::where("id", $id)->first();
        // dd($contacts->toArray());
        return view("admin.contact.details", compact("contacts"));
    }

    // indexDelete
    public function indexDelete($id)
    {
        Contact::where("id", $id)->delete();
        return redirect()->route('admin#contact#index');
    }

    // PRIVATE
    private function requestRole($request){
        return[
            "role" => $request->role,
        ];
    }
    // private
    private function getFromData($request)
    {
        return [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "address" => $request->address,
            "updated_at" => Carbon::now(),
        ];
    }

    private function validationCheck($request)
    {
        Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "gender" => "required",
            "image" => "mimes:png,jpg,jpeg|file",
            "address" => "required",
        ])->validate();
    }

    private function passwordValidatonCheck()
    {
        Validator::make(request()->all(), [
            'oldPassword' => "required|min:6",
            'newPassword' => "required|min:6",
            'confirmPassword' => "required|min:6|same:newPassword",
        ])->validate();
    }
}
