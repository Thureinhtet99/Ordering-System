<?php

namespace App\Http\Controllers\Contact;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // contactIndex
    public function contactIndex()
    {
        $orders = Order::where("user_id", auth()->user()->id)->get();
        $carts = Cart::where("user_id", auth()->user()->id)->get();

        return view("user.contact.index", compact("orders", "carts"));
    }

    // contactIndexForm
    public function contactIndexForm()
    {
        $datas = $this->getContactData(request());
        // dd($datas);
        Contact::create($datas);

        return redirect()->route('user#contact#index')->with(["success" => "Your message is sent" ]);
    }


    // PRIVATE
    private function getContactData()
    {
        return [
            "name" => request()->name,
            "email" => request()->email,
            "subject" => request()->subject,
            "message" => request()->message,
        ];
    }

}
