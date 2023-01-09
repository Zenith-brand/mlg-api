<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use App\Models\User_status;

use Illuminate\Http\Request;


class ApiController extends Controller
{

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['status code' => 200, 'user' => $user]);
    }
    //
    public function get_users(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);


        // $users = User::find(1)->user_status->status;
        $users = User::all();

        // Ref
        // $users = User::where('status_id', 1)->get();
        // $user_status = User_status::all();

        // $users = User::whereBelongsTo($user_status)->get();


        return response()->json(['status code' => 200, 'users' => $users]);
    }


}
