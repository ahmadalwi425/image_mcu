<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function updatePassword(Request $request)
    {
        $request->validate([
        'password' => 'required|min:6|confirmed'
    ]);

    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->must_change_password = false;
    $user->save();

    return redirect()->route('dashboard')->with('success', 'Password berhasil diubah');
    }

    public function showChangePassword()
    {
        return view('auth.change-password');
    }
}
