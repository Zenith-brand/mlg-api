<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    public function get_clients(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $clients = Client::all();

        return response()->json(['status code' => 200, 'clients' => $clients]);
    }
}
