<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function login(Request $request)
    {
        $user = Users::where('name', $request->name)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['......']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'id' => $user->id
        ];

        return response($response, 201);
    }


    public function singin(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
        ]);
        $this->validate($req, [
            'email' => 'required',
        ]);
        $this->validate($req, [
            'password' => 'required',
        ]);

        $user = new Users();
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));

        $user->save();
        return $user;
    }
}
