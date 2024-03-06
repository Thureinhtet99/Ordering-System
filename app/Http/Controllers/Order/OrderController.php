<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderList;

class OrderController extends Controller
{
    // orderList
    public function orderList()
    {
        $orders = Order::select("orders.*", "users.name as user_name")
            ->leftJoin("users", "users.id", "orders.user_id")
            ->when(request("search"), function ($query) {
                $query->orWhere("user_id", "like", "%", request("search"), "%")
                    ->orWhere("order_code", "like", "%", request("search"), "%")
                    ->orWhere("total_price", "like", "%", request("search"), "%");
            })
            ->latest()
            ->paginate(5);
        $orders->appends(request()->all());

        return view("admin.order.list", compact("orders"));
    }

    public function orderListChange()
    {
        $orders = Order::select("orders.*", "users.name as user_name")
            ->leftJoin("users", "users.id", "orders.user_id")
            ->when(request("search"), function ($query) {
                $query->orWhere("user_id", "like", "%", request("search"), "%")
                    ->orWhere("order_code", "like", "%", request("search"), "%")
                    ->orWhere("total_price", "like", "%", request("search"), "%");
            });

        if (request()->status == null) {
            $orders = $orders->get();
        } else {
            $orders = $orders->where("orders.status", request()->status)->get();
        }

        // $orders->appends(request()->all());

        return view("admin.order.list", compact("orders"));
    }

    public function statusChangeAjax()
    {
        // logger(request()->all());
        Order::where("id", request()->orderID)->update([
            "status" => request()->status,
        ]);
    }

    public function orderCodeStatus($orderCodeStatus)
    {
        $orders = Order::where("order_code", $orderCodeStatus)->first();
        $orderList = OrderList::select(
            "order_lists.*",
            "users.name as user_name",
            "products.image as product_image",
            "products.name as product_name"
        )
            ->leftJoin("users", "users.id", "order_lists.user_id")
            ->leftJoin("products", "products.id", "order_lists.product_id")
            ->where("order_lists.order_code", $orderCodeStatus)->get();
        // dd($orders->toArray());
        return view("admin.order.productList", compact("orderList", "orders"));
    }
}
