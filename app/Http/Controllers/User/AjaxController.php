<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // list
    public function ajaxList()
    {
        if (request()->status == "asc") {
            $datas = Product::orderBy("created_at", "asc")->get();
        } else {
            $datas = Product::orderBy("created_at", "desc")->get();
        }

        return response()->json($datas, 200);
    }

    // cart
    public function ajaxCart()
    {
        $datas = $this->getOrderData(request());
        Cart::create($datas);
        $response = [
            "status" => "success",
            "message" => "Add to Cart Success",
        ];
        return response()->json($response, 200);
    }

    // order
    public function ajaxOrder()
    {
        $total = 0;
        foreach (request()->all() as $item) {
            $orderList = OrderList::create([
                "user_id" => $item["user_id"],
                "product_id" => $item["product_id"],
                "qty" => $item["qty"],
                "total" => $item["total"],
                "order_code" => $item["order_code"],
            ]);

            $total += ($orderList->total * $orderList->qty) + (($orderList->total * $orderList->qty) * 0.025);
        };
        Cart::where("user_id", Auth::user()->id)->delete();

        Order::create([
            "user_id" => Auth::user()->id,
            "order_code" => $orderList->order_code,
            "total_price" => ($orderList->total * $orderList->qty) + (($orderList->total * $orderList->qty) * 0.025),
        ]);
        return response()->json([
            "status" => "true",
            "message" => "Order Success",
        ], 200);
    }

    // ajaxclearCart
    public function ajaxclearCart()
    {
        Cart::where("user_id", Auth::user()->id)->delete();
    }

    // ajaxClearCurrentCart
    public function ajaxClearCurrentCart()
    {
        Cart::where("user_id", Auth::user()->id)
            ->where("product_id", request()->productID)
            ->where("id", request()->cartID)
            ->delete();
    }

    // increaseCount
    public function increaseCount()
    {
        $products = Product::where("id", request()->productID)->first();
        $viewCount = [
            "view_count" => $products->view_count + 1
        ];
        Product::where("id", request()->productID)->update($viewCount);
    }

    // PRIVATE
    private function getOrderData()
    {
        return [
            "user_id" => request()->userID, //Hidden input
            "product_id" => request()->pizzaID, //Hidden input
            "qty" => request()->count,
            "created_at" => Carbon::now(),
        ];
    }
}
