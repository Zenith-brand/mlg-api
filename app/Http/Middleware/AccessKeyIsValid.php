<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

class AccessKeyIsValid
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
        
        // $pattern = "/^(?:https?:\/\/)?(?:[^@\/\n]+@)?(?:www\.)?([^:\/?\n]+)/mg";
        // preg_match($pattern, URL::current())


        // Check if url is allowed
        // dd(substr(URL::current(), 7, 9) == "127.0.0.1" ,URL::current());

        // Check if key is provided and convert it from string to json object
        try {
            $access_key = $request->header('access_key');
        } catch (Exception $e) {
            return response()->json(['status code' => 401, 'message' => 'Access Key not found'], 401);
        }

        // initialize an empty array to store keys
        $keys = [];

        // search for keys in DB and add them to the array
        $db_keys = DB::select('select key from apis');
        foreach ($db_keys as $key) {
            array_push($keys, $key->key);
        }

        // if provided access key exists in DB then allow access to the next midlleware
        if (! in_array($access_key, $keys)) {
            return response()->json(['status code' => 401, 'message' => 'Access Key is invalid'], 401);
        }

        return $next($request);
    }
}
