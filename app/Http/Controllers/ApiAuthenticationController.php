<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Api\ErrorHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthenticationController extends Controller
{
    public function createToken(User $user, $tokenName = 'DEFAULT_APP')
    {
        $token = $user->createToken($tokenName);
        return $token->plainTextToken;
    }
    public function createUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        if (is_null($name) || is_null($email) || is_null($password)) {
            return ErrorHelper::sendError(400, 'field(s) are required!');
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            return ErrorHelper::sendError(400, 'email is already in used!');
        }

        if (strlen($password) <= 6) {
            return ErrorHelper::sendError(400, 'password is too short!');
        }

        $user = $this->createUser([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
        ]);

        $token = $this->createToken($user);

        return response([
            'user'=>$user,
            'token'=>$token,
        ], 200);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;


        if (is_null($email) || is_null($password)) {
            return ErrorHelper::sendError(400, 'field(s) are required!');
        }

        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            return ErrorHelper::sendError(404, 'user not found!');
        }

        if (!Hash::check($password, $user->password)) {
            return ErrorHelper::sendError(400, 'Wrong credentials!');
        }
        $token = $this->createToken($user);
        return response([
            'user'=>$user,
            'token'=>$token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message'=>"LOGOUT SUCCESS!",
        ], 200);
    }
}
