<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // List
    public function list()
    {
        $pizzas = Product::select("products.*", "categories.*")->when(request("search"), function ($query) {
            $query->where("products.name", "like", "%" . request("search") . "%");
        })
            ->leftJoin("categories", "categories.id", "products.category_id")
            ->orderBy("products.created_at", "desc")
            ->paginate(3);
        // dd($pizzas->toArray());
        $pizzas->appends(request()->all());
        return view("admin.products.pizzaList", compact("pizzas"));
    }

    // to create page
    public function createPage()
    {
        $categories = Category::select("id", "category_name")->get();
        return view("admin.products.create", compact("categories"));
    }
    // Create
    public function create(Request $request)
    {
        $this->productValidationCheck($request);
        $datas = $this->getFormData($request);

        if ($request->hasFile("pizzaImage")) {
            $fileName = uniqid() . $request->file("pizzaImage")->getClientOriginalName();
            $request->file("pizzaImage")->storeAs("public", $fileName); //store in project
            $datas["image"] = $fileName;    //store in database
        }

        Product::create($datas);
        return redirect()->route("product#list");
    }

    // delete
    public function delete($id)
    {
        Product::where("id", $id)->delete();
        return redirect()->route("product#list")->with(["deleteSuccess" => "Product Deleted"]);
    }

    // edit
    public function edit($id)
    {
        $pizzas = Product::select("products.*", "categories.*")
            ->leftJoin("categories", "categories.id", "products.category_id")
            ->where("products.id", $id)
            ->first();

        return view("admin.products.edit", compact("pizzas"));
    }

    // update
    public function updatePage($id)
    {
        $pizzas = Product::where("id", $id)->first();
        $categories = Category::get();

        return view("admin.products.update", compact("pizzas", "categories"));
    }

    // update
    public function update(Request $request)
    {
        $this->productValidationCheck($request);
        $datas = $this->getFormData($request);

        if ($request->hasFile("pizzaImage")) {
            $oldImage = Product::where("id", $request->id)->first();
            $oldImage = $oldImage->image;

            if ($oldImage != null) {
                Storage::delete("public/$oldImage");
            }

            $fileName = uniqid() . $request->file("pizzaImage")->getClientOriginalName();
            $request->file("pizzaImage")->storeAs("public", $fileName);
            $datas["image"] = $fileName;
        }

        Product::where("id", $request->id)->update($datas);
        return redirect()->route("product#list");
    }

    // private
    private function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            "pizzaName" => "required|min:4|unique:products,name," . $request->id,
            "pizzaCategory" => "required",
            "pizzaDescription" => "required|min:10",
            "pizzaImage" => "mimes:jpg,png,jpeg,webp|file",
            "pizzaPrice" => "required",
            "pizzaWaiting" => "required",
        ])->validate();
    }
    private function getFormData($request)
    {
        return [
            "category_id" => $request->pizzaCategory,
            "name" => $request->pizzaName,
            "description" => $request->pizzaDescription,
            "price" => $request->pizzaPrice,
            "waiting_time" => $request->pizzaWaiting,
        ];
    }
}
