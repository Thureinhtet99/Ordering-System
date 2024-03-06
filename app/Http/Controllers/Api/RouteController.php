<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderList;
use Carbon\Carbon;

class RouteController extends Controller
{
    // GET
    // cartList
    public function cartList()
    {
        $carts = Cart::get();
        return response()->json($carts, 200);
    }

    // categorylist
    public function categorylist()
    {
        $categories = Category::get();
        return response()->json($categories, 200);
    }

    // contactlist
    public function contactlist()
    {
        $contacts = Contact::get();
        return response()->json($contacts, 200);
    }

    // orderlist
    public function order()
    {
        $orders = Order::get();
        return response()->json($orders, 200);
    }

    // orderlist
    public function orderList()
    {
        $orderlists = OrderList::get();
        return response()->json($orderlists, 200);
    }

    //productList
    public function productList()
    {
        $products = Product::get();
        return response()->json($products, 200);
    }
    //productList
    public function userlist()
    {
        $users = User::get();
        return response()->json($users, 200);
    }

    // POST
    // createCategory
    public function createCategory()
    {
        $data = [
            "category_name" => request()->name,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ];

        $categories = Category::create($data);
        return response()->json($categories, 200);
    }

    // detailsCategory
    public function detailsCategory()
    {
        $category = Category::where("id", request()->id)->first();

        if (isset($category)) {
            // Category::where("id", request()->id)->delete();
            return response()->json([
                "status" => true,
                "category" => $category
            ], 200);
        }

        return response()->json([
            "status" => false,
            "category" => "There is no category"
        ], 200);
    }

    // updateCategory
    public function updateCategory()
    {
        $category = Category::where("id", request()->id)->first();

        if (isset($category)) {
            $data = Category::where("id", request()->id)->update([
                "category_name" => request()->category_name,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
            return response()->json([
                "status" => true,
                "message" => "Category Update Success",
                "category" => $data
            ], 200);
        }
        return response()->json([
            "status" => true,
            "message" => "There is no category"
        ], 500);
    }

    // deleteCategory
    public function deleteCategory()
    {
        $category = Category::where("id", request()->id)->first();

        if (isset($category)) {
            Category::where("id", request()->id)->delete();
            return response()->json([
                "status" => true,
                "message" => "Delete Success",
                "deletedData" => $category
            ], 200);
        }

        return response()->json([
            "status" => false,
            "message" => "There is no category"
        ],500);
    }

    // contactCategory
    public function contactCategory()
    {
        $datas = [
            "name" => request()->name,
            "email" => request()->email,
            "subject" => request()->subject,
            "message" => request()->message
        ];
        $contacts = Contact::create($datas)->latest()->get();
        return response()->json($contacts, 200);
    }
}
