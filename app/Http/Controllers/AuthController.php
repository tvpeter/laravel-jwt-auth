<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([$users]);
    }
    /**
     * Register a new user
     * @param  - http request object
     * @return - response object
     */
    public function register(Request $request){

        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            ], $validated);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * login a user
     * @param - http request object
     */

     public function login(Request $request)
     {
         $credentials = $request->only(['email', 'password']);
         $token = auth()->attempt($credentials);

         if(!$token){ 
             return response()->json(['error' => 'Unauthorized'], 401);
         }

         return $this->respondWithToken($token);
     }

     /**
      * Logout endpoint
      */
     public function logout()
     {
        auth()->logout();

        return response()->json(['message' => 'successfully logged out'], 200);
     }

     /** 
      * helps to send our response with token
      * @param - token - the generated token
      */

      protected function respondWithToken($token)
      {
          return response()->json([
              'access_token' => $token,
              'token_type' => 'bearer',
              'expires_in' => auth()->factory()->getTTL() * 60
          ]);
      }


}
