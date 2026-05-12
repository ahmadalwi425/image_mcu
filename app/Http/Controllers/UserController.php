<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // LIST
    public function dashboard()
    {
        $user = Auth::user();

        return match (Auth::user()->id_level) {
            1 => redirect()->route('user.index'),
            2 => redirect('/capture'),
            3 => redirect('/mcu'),
            default => abort(403),
        };

        abort(403, 'Unauthorized');
    }
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('user1234');
        $user->must_change_password = 1;
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil direset, user harus ganti password.');
    }
    public function index()
    {
        $users = User::with('poli')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('user.create', compact('polis'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'id_level' => 'required',
            'id_poli' => 'nullable',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make("user1234"), // atau default password
            'id_level' => $request->id_level,
            'id_poli' => $request->id_poli,
            'must_change_password' => true,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    // EDIT FORM
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $polis = Poli::all();

        return view('user.edit', compact('user', 'polis'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'id_level' => 'required',
            'id_poli' => 'nullable',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'id_level' => $request->id_level,
            'id_poli' => $request->id_poli,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
    }

    // DELETE
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}