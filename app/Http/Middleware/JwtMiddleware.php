<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

use App\Models\Access_token;
use Illuminate\Support\Facades\DB;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // convert from string to json object
        $access_token = json_decode($request->getContent())->access_token;

        // initialize an empty array to store tokens
        $tokens = [];

        // search for tokens in DB and add them to the array
        $db_tokens = DB::select('select token from access_tokens');
        foreach ($db_tokens as $token) {
            array_push($tokens, $token->token);
        }

        // if provided access token exist in DB allow access to the midlleware
        if (in_array($access_token, $tokens)){
            // dd($access_token == $password, "here", (int)$password, $password);
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    return response()->json(['status' => 'Token is Invalid']);
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    return response()->json(['status' => 'Token is Expired']);
                }else{
                    return response()->json(['status' => 'Authorization Token not found']);
                }
            }
            return $next($request);
        // return an error if token is invalid 
        } else {
            return response()->json(['status code' => 401,'message' => 'Access Token not found or invalid']);
        }
        // 

        // try {
        //     $user = JWTAuth::parseToken()->authenticate();
        // } catch (Exception $e) {
        //     if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
        //         return response()->json(['status' => 'Token is Invalid']);
        //     }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
        //         return response()->json(['status' => 'Token is Expired']);
        //     }else{
        //         return response()->json(['status' => 'Authorization Token not found']);
        //     }
        // }
        // return $next($request);
    }
}