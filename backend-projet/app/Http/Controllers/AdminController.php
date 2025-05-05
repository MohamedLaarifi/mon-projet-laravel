<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return Admin::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomAdmin' => 'required',
            'emailAdmin' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);

        return Admin::create($data);
    }

    public function show($id)
    {
        return Admin::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $admin->update($data);
        return $admin;
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return response()->json(['message' => 'Admin supprimé']);
    }
}
