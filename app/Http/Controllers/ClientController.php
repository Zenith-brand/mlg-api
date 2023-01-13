<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        
        $searchQuery = $request->query('name');
        $clientsStatus = $request->query('clients_status');
        
        $pageSize = $request->page_size ?? 10;
        $clients = Client::search($searchQuery, $clientsStatus)->paginate($pageSize);

        
        // $clients = Client::query()->paginate($pageSize);
    
        return ['status code' => 200, 'client' => ClientResource::collection($clients)->response()->getData(true)];

        // $clients = ClientResource::collection(Client::all());
        // return response()->json(['status code' => 200, 'clients' => $clients]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate data
        $data = $request->only('name','clients_status');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'clients_status' => 'required|string',            
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['status code' => 400, 'message' => $validator->messages()], 400);
        }

        //Request is valid, create new client
        $client = Client::create([
            // 'user_id' => $request->user()->id,
            'name' => $request->name,
            'clients_status' => $request->clients_status,
            

          ]);
          return response()->json(['status code' => 201, 'client' => new ClientResource($client)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        // $client = Client::findOrFail($id);

        // return new ClientResource($client);
        return response()->json(['status code' => 200, 'client' => new ClientResource($client)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
      // check if currently authenticated user is an admin
    //   if ($request->user()->id !== $book->user_id) {
    //     return response()->json(['error' => 'You can only edit your own books.'], 403);
    //   }


        //Validate data
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['status code' => 400, 'message' => $validator->messages()], 400);
        }

        //Request is valid, update client
        $client->update($request->only(['name']));

        // return new ClientResource($client);
        return response()->json(['status code' => 200, 'client' => new ClientResource($client)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
      $client->delete();

      return response()->json(null, 204);
    }
}
