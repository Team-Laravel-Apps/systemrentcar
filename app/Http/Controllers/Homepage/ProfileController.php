<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('homepage.profile');
    }

    public function posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'        => 'required|unique:users,username,' . ($request['id'] ?? '') . ',id',
            'email'           => 'required|unique:users,email,' . ($request['id'] ?? '') . ',id',
            'profile'         => 'file|mimes:jpeg,bmp,png,gif|max:2000',
            'no_telpon'       => 'required',
            'alamat'          => 'required',
            'nik'             => 'required',
            'gender'          => 'required',
            'password'        => ($request->aksi == 'Update profile' ? 'nullable' : 'required'),
        ], [
            'nama.required'         => 'Nama tidak boleh kosong!',
            'email.unique'          => 'Data tidak boleh sama!',
            'username.required'     => 'Username tidak boleh kosong!',
            'username.unique'       => 'Data tidak boleh sama!',
            'profile.file'          => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'profile.mimes'         => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'profile.max'           => 'Ukuran Gambar maksimal 2000 KB!',
            'no_telpon.required'    => 'Form tidak boleh kosong!',
            'alamat.required'       => 'Form tidak boleh kosong!',
            'password.required'     => 'Form tidak boleh kosong!',
            'nik.required'          => 'Form tidak boleh kosong!',
            'gender.required'       => 'Form tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            Alert::warning('Oopss', $request->aksi.' gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $gambar = User::where('id', $request->id)->first();

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');

            if ($file->isValid()) {
                $files = $file->hashName();

                // File Handling
                if ($request->aksi == 'Tambah users' || $gambar->profile == null) {
                    $file->move(public_path('drive/profile'), $files);
                } else {
                    // Delete old icon file
                    unlink(public_path('drive/profile') . '/' . $gambar->profile);
                    $file->move(public_path('drive/profile'), $files);
                }
            } else {
                // Handle invalid file
                if($request->aksi == "Tambah users"){
                    $files = null;
                }else{
                    $files = $gambar->profile ?? null;
                }
            }
        } else {
            if($request->aksi == "Tambah users"){
                $files = null;
            }else{
                $files = $gambar->profile ?? null;
            }
        }

        $pass = User::where('id', $request->id)->first();

        if($request->password == ""){
            $password = $pass->password;
        }else{
            $password = Hash::make($request['password']);
        }

        $set = User::updateOrCreate(['id' => $request['id']], [
            'profile'           => $files,
            'nama'              => $request['nama'] == '' ? null : $request['nama'],
            'nik'               => $request['nik'] == '' ? null : $request['nik'],
            'gender'            => $request['gender'] == '' ? null : $request['gender'],
            'no_telpon'         => $request['no_telpon'] == '' ? null : $request['no_telpon'],
            'email'             => $request['email'] == '' ? null : $request['email'],
            'alamat'            => $request['alamat'] == '' ? null : $request['alamat'],
            'username'          => $request['username'] == '' ? null : $request['username'],
            'password'          => $password,
        ]);

        if ($set) {
            Alert::success('Berhasil', $request->aksi.' berhasil dilakukan');
            if ($request->aksi = 'Update profile') {
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else {
            Alert::error('Gagal', $request->aksi.' gagal dilakukan');
            return redirect()->back();
        }
    }
}
