<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_m_user;
use App\Models\Log;
use Illuminate\Support\Facades\Validator; //panggil library validator untuk validasi inputan
use Illuminate\Support\Facades\Auth; //panggil library untuk otentikasi
use Illuminate\Http\Exceptions\HttpResponseException;
use Firebase\JWT\JWT; //panggil library jwt

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }

        if (Auth::attempt($validator->validate())) {

            $payload = [
                'name' => Auth::tb_m_user()->name,
                'role' => Auth::tb_m_user()->role,
                'iat' => now()->timestamp,
                'exp' => now()->timestamp + 7200
            ];

            $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

            log::create([
                'module' => 'login',
                'action' => 'login akun',
                'useraccess' => Auth::tb_m_user()->email
            ]);

            return response()->json([
                "data" => [
                    'msg' => "berhasil login",
                    'name' => Auth::tb_m_user()->name,
                    'email' => Auth::tb_m_user()->email,
                    'role' => Auth::tb_m_user()->role,
                ],
                "token" => "Bearer {$token}"
            ], 200);
        }

        return response()->json("email atau password salah", 422);
    }
}
