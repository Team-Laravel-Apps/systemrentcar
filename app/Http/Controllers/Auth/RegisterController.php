<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'            => 'required|unique:users,nama,' . ($request['id'] ?? '') . ',id',
            'username'        => 'required|unique:users,username,' . ($request['id'] ?? '') . ',id',
            'email'           => 'required|unique:users,email,' . ($request['id'] ?? '') . ',id',
            'no_telpon'       => 'required',
            'password'        => ($request->aksi == 'Update users' ? 'nullable' : 'required'),
        ], [
            'nama.required'         => 'Nama tidak boleh kosong!',
            'nama.unique'           => 'Data tidak boleh sama!',
            'email.unique'          => 'Data tidak boleh sama!',
            'username.required'     => 'Username tidak boleh kosong!',
            'username.unique'       => 'Data tidak boleh sama!',
            'no_telpon.required'    => 'Form tidak boleh kosong!',
            'password.required'     => 'Form tidak boleh kosong!',
            'email.required'        => 'Form tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            Alert::warning('Oopss', $request->aksi.' gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $set = User::create([
            'nama'              => $request['nama'] == '' ? null : $request['nama'],
            'no_telpon'         => $request['no_telpon'] == '' ? null : $request['no_telpon'],
            'email'             => $request['email'] == '' ? null : $request['email'],
            'username'          => $request['username'] == '' ? null : $request['username'],
            'password'          => Hash::make($request['password']) == '' ? '' : Hash::make($request['password']),
            'id_role'           => '3',
        ]);

        if ($set) {
            auth()->attempt($request->only('username', 'password'));
            Alert::success('Berhasil', $request->aksi.' berhasil dilakukan');
            return redirect()->route('home');
        } else {
            Alert::error('Gagal', $request->aksi.' gagal dilakukan');
            return redirect()->back();
        }
    }
}
