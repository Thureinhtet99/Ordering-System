<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Admin
    // Direct to admin category page
    public function adminCategory()
    {
        $categories = Category::when(request("search"), function ($query) {
            $query->where("category_name", "like", "%" . request("search") . "%");
        })
            ->latest()
            ->paginate(4);
        $categories->appends(request()->all());
        return view("admin.category.list", compact("categories"));
    }

    // Direct to admin create page
    public function adminCreate()
    {
        return view("admin.category.create");
    }

    // Admin create form
    public function adminCreateForm(Request $request)
    {
        $this->validationRules($request);
        $datas = $this->getFormData($request);
        Category::create($datas);
        return redirect()->route("admin#category"); //->with(["categoryCreate" => "Create Success"]);
    }

    // Update
    public function adminUpdate($id)
    {
        // dd($id, request()->all());
        $this->validationRules(request());
        $datas = $this->getFormData(request());
        Category::where("id", $id)->update($datas);
        return redirect()->route("admin#category");
    }

    // Delete
    public function adminDelete($id)
    {
        Category::where("id", $id)->delete();
        return back()->with(["categoryDelete" => "Deleted"]);
    }

    // Edit
    public function adminEdit($id)
    {
        $categories = Category::where("id", $id)->first();
        return view("admin.category.edit", compact("categories"));
    }



    // Private
    private function getFormData(Request $request)
    {
        return [
            "category_name" => $request->categoryName,
        ];
    }

    private function validationRules(Request $request)
    {
        Validator::make($request->all(), [
            "categoryName" => "required|min:4|unique:categories,category_name," . $request->id,
        ])->validate();
    }
}
