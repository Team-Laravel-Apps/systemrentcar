<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $data = [
            'user' => User::join('roles', 'roles.id_role', '=', 'users.id_role')
            ->where('users.id', '!=', auth()->user()->id)
            ->get(),

            'count' => User::join('roles', 'roles.id_role', '=', 'users.id_role')->get(),

            'role' => Role::all(),
        ];

        return view('users', $data);
    }

    public function create()
    {
        $data = [
            'aksi' => 'Tambah users',
            'role' => Role::where('roles.nama_role', '!=', 'Pelanggan')->get(),
        ];

        return view('form.formusers', $data);
    }

    public function update($id)
    {
        $data = [
            'aksi' => 'Update users',
            'role' => Role::where('roles.nama_role', '!=', 'Pelanggan')->get(),
            'users' => User::find($id)
        ];

        return view('form.formusers', $data);
    }

    public function posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'            => 'required|unique:users,nama,' . ($request['id'] ?? '') . ',id',
            'username'        => 'required|unique:users,username,' . ($request['id'] ?? '') . ',id',
            'email'           => 'required|unique:users,email,' . ($request['id'] ?? '') . ',id',
            'profile'         => 'file|mimes:jpeg,bmp,png,gif|max:2000',
            'no_telpon'       => 'required',
            'alamat'          => 'required',
            'password'        => ($request->aksi == 'Update users' ? 'nullable' : 'required'),
            'id_role'         => 'required',
        ], [
            'nama.required'         => 'Nama tidak boleh kosong!',
            'nama.unique'           => 'Data tidak boleh sama!',
            'email.unique'          => 'Data tidak boleh sama!',
            'username.required'     => 'Username tidak boleh kosong!',
            'username.unique'       => 'Data tidak boleh sama!',
            'profile.file'          => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'profile.mimes'         => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'profile.max'           => 'Ukuran Gambar maksimal 2000 KB!',
            'no_telpon.required'    => 'Form tidak boleh kosong!',
            'alamat.required'       => 'Form tidak boleh kosong!',
            'password.required'     => 'Form tidak boleh kosong!',
            'id_role.required'      => 'Form tidak boleh kosong!',
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

        $set = User::updateOrCreate(['id' => $request['id']], [
            'profile'           => $files,
            'nama'              => $request['nama'] == '' ? null : $request['nama'],
            'no_telpon'         => $request['no_telpon'] == '' ? null : $request['no_telpon'],
            'email'             => $request['email'] == '' ? null : $request['email'],
            'alamat'            => $request['alamat'] == '' ? null : $request['alamat'],
            'username'          => $request['username'] == '' ? null : $request['username'],
            'password'          => Hash::make($request['password']) == '' ? '' : Hash::make($request['password']),
            'id_role'           => $request['id_role'] == '' ? '' : $request['id_role'],
        ]);

        if ($set) {
            Alert::success('Berhasil', $request->aksi.' berhasil dilakukan');
            if ($request->aksi = 'Update users') {
                return redirect()->back();
            } else {
                return redirect()->route('users');
            }
        } else {
            Alert::error('Gagal', $request->aksi.' gagal dilakukan');
            return redirect()->back();
        }
    }

    public function delete(Request $request, $id)
    {
        $cek = User::where('id', $id)->first();

        if($cek)
        {
            if($cek->profile == null)
            {

            }else{
                $filePath = public_path('drive/profile' . '/' . $cek->profile);
                if (file_exists($filePath)) {
                    unlink($filePath);
                } else {
                    // Handle the case where the file doesn't exist if necessary
                }
            }
            User::where('id', $id)->delete();
            Alert::success('Berhasil', 'Users berhasil dihapus');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Users gagal dihapus');
            return redirect()->back();
        }
    }
}
