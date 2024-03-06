<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // category
    public function userCategory()
    {
        $datas = Product::latest()->get();

        $categories = Category::get();

        $carts = Cart::where("user_id", Auth::user()->id)->get();

        $orders = Order::where("user_id", Auth::user()->id)->get();

        return view("user.category.list", compact("datas", "categories", "carts", "orders"));
    }

    // changePassword
    public function changePassword()
    {
        return view("user.password.change");
    }

    // changePasswordForm
    public function changePasswordForm()
    {
        $this->passwordValidatonCheck();

        if (Hash::check(request()->oldPassword, Auth::user()->password)) {
            User::select("password")->where("id", Auth::user()->id)
                ->update([
                    "password" => Hash::make(request()->newPassword)
                ]);
            return back()->with(["passwordchange" => "Password Changed"]);
        }
        return back()->with(["notMatch" => "The old password not match"]);
    }

    // accountPage
    public function accountPage()
    {
        return view("user.profile.account");
    }

    //accountPage
    public function accountChangePage()
    {
        return view("user.profile.edit");
    }

    // accountUpdatePage
    public function accountUpdatePage($id)
    {
        $this->validationCheck();

        $datas = $this->getFormdData();

        if (request()->hasFile("image")) {
            $dbimage = User::where("id", $id)->first();
            $dbimage = $dbimage->image;

            if ($dbimage != null) {
                Storage::delete("public/" . $dbimage);
            }

            $fileName = uniqid() . request()->file("image")->getClientOriginalName();
            request()->file("image")->storeAs("public", $fileName);
            $datas["image"] = $fileName;
        }
        User::where("id", $id)->update($datas);

        return redirect()->route('account#Page');
    }

    // filter
    public function filter($id)
    {
        $datas = Product::where("category_id", $id)->latest()->get();

        $categories = Category::get();

        $carts = Cart::where("user_id", Auth::user()->id)->get();

        $orders = Order::where("user_id", Auth::user()->id)->get();

        return view("user.category.list", compact("datas", "categories", "carts", "orders"));
    }

    // Category
    // detail
    public function detail($id)
    {
        $data = Product::where("id", $id)->first();

        $products = Product::get();

        $carts = Cart::where("user_id", Auth::user()->id)->get();

        $orders = Order::where("user_id", Auth::user()->id)->get();

        return view("user.category.details", compact("data", "products", "carts", "orders"));
    }

    // cart
    public function index()
    {
        $carts = Cart::select(
            "carts.*",
            "products.name as product_name",
            "products.price as product_price",
            "products.image as product_image",
        )
            ->leftJoin("products", "products.id", "carts.product_id")
            ->where("carts.user_id", Auth::user()->id)
            ->get();    

        $subtotal = 0;

        foreach ($carts as $cart) {
            $subtotal += $cart->product_price * $cart->qty;
        }

        $orders = Order::where("user_id", Auth::user()->id)->get();

        return view("user.cart.index", compact("carts", "subtotal", "orders"));
    }

    // history
    public function history()
    {
        $carts = Cart::where("user_id", Auth::user()->id)->get();

        $orders = Order::where("user_id", Auth::user()->id)
            ->latest()
            ->paginate(4);

        $orders->appends(request()->all());

        return view("user.category.history", compact("carts", "orders"));
    }

    // PRIVATE //
    private function passwordValidatonCheck()
    {
        Validator::make(request()->all(), [
            'oldPassword' => "required|min:6",
            'newPassword' => "required|min:6",
            'confirmPassword' => "required|min:6|same:newPassword",
        ])->validate();
    }

    private function getFormdData()
    {
        return [
            "name" => request()->name,
            "email" => request()->email,
            "phone" => request()->phone,
            "gender" => request()->gender,
            "address" => request()->address,
            "updated_at" => Carbon::now(),
        ];
    }

    private function validationCheck()
    {
        Validator::make(request()->all(), [
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "gender" => "required",
            "address" => "required",
            "image" => "mimes:jpg,jpeg,png,webp|file",
        ])->validate();
    }

}
