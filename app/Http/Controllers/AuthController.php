<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    // TODO: Http codes and validation
    public function registration(Request $request): JsonResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string|min:5|max:30',
            'surname' => 'required|string|min:5|max:30',
            'role' => 'required|string|in:student,teacher',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:30|confirmed'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if($user) {
            $request->session()->regenerate();

            return response()->json([
                'message' => trans('auth.register.success'),
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => trans('auth.register.failed')
        ], 422);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:30',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'message' => trans('auth.login.success'),
                'user' => Auth::user()
            ]);
        }

        return response()->json(['message' => trans('auth.login.failed')], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->session()->invalidate();

        return response()->json(['message' => trans('auth.logout.success')]);
    }

    public function refresh(Request $request): JsonResponse
    {
        $request->session()->regenerate();

        return response()->json(['info' => trans('auth.refresh')]);
    }

    public function current_user(): JsonResponse
    {
        return response()->json(Auth::user());
    }
}
