<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResource;
use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchQuery = $request->query('name');

        $pageSize = $request->page_size ?? 10;
        $users = User::search($searchQuery)->paginate($pageSize);

        return ['status code' => 200, 'user' => UserResource::collection($users)->response()->getData(true)];
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['status code' => 200, 'user' => new UserResource($user)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        //Validate data
        $data = $request->only('forename', 'email');
        $validator = Validator::make($data, [
            'forename' => 'required|string',
            'email' => 'nullable|email',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['status code' => 400, 'message' => $validator->messages()], 400);
        }

        //Request is valid, update user
        $user->update($request->only(['forename', 'email']));


        return response()->json(['status code' => 200, 'client' => new UserResource($user)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      $user->delete();

      return response()->json(null, 204);
    }

    public function get_address_by_user(Request $request, User $user)
    {

        return response()->json(['status code' => 200, 'user' => new GeneralResource($user->addresses)]);
    }
}
