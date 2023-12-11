<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'role' => Role::all()
        ];

        return view('role', $data);
    }

    public function posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cnama_role' => 'required|unique:roles,nama_role,' . ($request['id_role'] ?? '') . ',id_role',
        ], [
            'cnama_role.required' => 'Form tidak boleh kosong!',
            'cnama_role.unique'   => 'Data telah tersedia!',
        ]);


        if ($validator->fails()) {
            Alert::warning('Oopss', 'Aksi role gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $set = Role::updateOrCreate(['id_role' => $request['id_role']], [
            'nama_role' => $request['cnama_role'] == '' ? '' : $request['cnama_role'],
        ]);


        if ($set) {
            Alert::success('Berhasil','Menambahkan role berhasil dilakukan');
            return redirect()->back();
        } else {
            Alert::error('Gagal','Menambahkan role gagal dilakukan');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        // dd($request->all())
        $validator = Validator::make($request->all(), [
            'nama_role' => 'unique:roles,nama_role,' . ($request['id_role'] ?? '') . ',id_role',
        ], [
            'nama_role.unique' => 'Data telah tersedia!',
        ]);

        if ($validator->fails()) {
            Alert::warning('Oopss', 'Aksi role gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $set = Role::where('id_role', $request['id_role'])->update([
            'nama_role' => $request['nama_role'] == '' ? '' : $request['nama_role'],
        ]);


        if ($set) {
            Alert::success('Berhasil','Mengubah role berhasil dilakukan');
            return redirect()->back();
        } else {
            Alert::error('Gagal','Mengubah role gagal dilakukan');
            return redirect()->back();
        }
    }

    public function delete(Request $request, $id_role)
    {
        $fetchRole = Role::where('id_role', $id_role)->first();
        $cek = User::where('id_role',  $fetchRole->id_role)->first();

        if($cek)
        {
            Alert::error('Gagal', 'Role gagal dihapus');
            return redirect()->back();
        }else{
            Role::where('id_role', $id_role)->delete();
            Alert::success('Berhasil', 'Role berhasil dihapus');
            return redirect()->back();
        }
    }
}
