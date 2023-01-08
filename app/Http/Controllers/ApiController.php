<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use App\Models\User_status;
use App\Models\Client;
use App\Models\Access_token;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('forename', 'email', 'password');
        $validator = Validator::make($data, [
            'forename' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = User::create([
        	'forename' => $request->forename,
            'last_name' => 'GudIdeas', //toChange
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'status code' => 200,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['status code' => 401, 'message' => $validator->messages()], 401);
        }
        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'status code' => 400,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                'status code' => 500,
                	'message' => 'Could not create token.',
                ], 500);
        }

 		//Token created, return with success response and jwt token
        return response()->json([
            'status code' => 200,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['status code' => 200, 'message' => $validator->messages()], 200);
        }

		//Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'status code' => 200,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'status code' => 500,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

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

    public function get_clients(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $clients = Client::all();

        return response()->json(['status code' => 200, 'clients' => $clients]);
    }
}
