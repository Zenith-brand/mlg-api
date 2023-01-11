<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AccessTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // Check if token is provided and convert it from string to json object
        try {
            $access_token = json_decode($request->getContent())->access_token;
        } catch (Exception $e) {
            return response()->json(['status code' => 401, 'message' => 'Access Token not found'], 401);
        }

        // initialize an empty array to store tokens
        $tokens = [];

        // search for tokens in DB and add them to the array
        $db_tokens = DB::select('select token from apis');
        foreach ($db_tokens as $token) {
            array_push($tokens, $token->token);
        }

        // if provided access token exists in DB then allow access to the next midlleware
        if (! in_array($access_token, $tokens)) {
            return response()->json(['status code' => 401, 'message' => 'Access Token is invalid'], 401);
        }

        return $next($request);
    }
}
