<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:3',
            'password' => 'required|min:8|max:32'
        ]);

        if ($validator->fails()) {
            $message = ['errors' => $validator->messages()->all()];
            $response = Response::json($message, 202);
        } else {
            $user = new User(array(
                'email' => trim($request->email),
                'name' => trim($request->name),
                'password' => bcrypt($request->password)
            ));
            $user->save();

            $message = 'Utente aggiunto con successo!';
            $response = Response::json([
                'message' => $message,
                'user' => $user
            ], 201);
        }
        return $response;
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $message = ['errors' => $validator->messages()->all()];
            $response = Response::json($message, 202);
        } else {
            $credentials = $request->only('email', 'password');
        }
        try {
            $token = JWTAuth::attempt($credentials);
            if ($token) {
                $message = ['success' => $token];
                return $response = Response::json(["token" => $token]);
            } else {
                $message = ['error' => 'Ops. Le credenziali non sono valide!'];
                return $response = Response::json($message, 202);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Ops. Non ho creato il token!'], 500);
        }
    }
}
