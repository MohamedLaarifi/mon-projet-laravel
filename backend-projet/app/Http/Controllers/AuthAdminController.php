<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'emailAdmin' => 'required|email',
            'password' => 'required',
        ]);
    
        $admin = Admin::where('emailAdmin', $request->emailAdmin)->first();
    
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }
    
        $token = $admin->createToken('admin-token')->plainTextToken;
    
        return response()->json([
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnexion réussie']);
    }
    public function profile(Request $request)
{
    return response()->json($request->user());
}

}

