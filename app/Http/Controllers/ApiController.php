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


        // $users = User::find(2)->timesheet;
        $users = User::all();

        // Ref
        // $users = User::where('status_id', 1)->get();
        // $user_status = User_status::all();

        // $users = User::whereBelongsTo($user_status)->get();


        return response()->json(['status code' => 200, 'users' => $users]);
    }

    public function get_incoming_invoices(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        return response()->json(['status code' => 200, 'income' => 'incoming invoices will be accessible from this route']);
    }

    public function index_invoices(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);    

        return response()->json(['status code' => 200, 'invoices' => 'all invoices will be accessible from this route with parametrs to filter by client, candidate, date etc']);
    }

    public function get_outgoing_invoices(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);     

        return response()->json(['status code' => 200, 'income' => 'outgoing invoices will be accessible from this route']);
    }


}
