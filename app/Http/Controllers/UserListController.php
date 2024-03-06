<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    // index
    public function index()
    {
        $userlists = User::where("role", "user")->latest()->paginate(5);
        $userlists->appends(request()->all());
        return view("admin.userlist.index", compact("userlists"));
    }

    // changeRole
    public function changeRole()
    {
        $updateRole = [
            "role" => request()->role
        ];
        User::where("id", request()->userID)->update($updateRole);
    }
}
