<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class PelangganController extends Controller
{
    public function index()
    {
        $data = [
            'pelanggan' => User::join('roles', 'roles.id_role', '=', 'users.id_role')
            ->where('roles.nama_role', 'Pelanggan')
            ->get(),
        ];

        return view('pelanggan', $data);
    }

    public function delete(Request $request, $id)
    {
        $cek = User::where('id',  $id)->first();

        if($cek)
        {
            if($cek->profile == null)
            {

            }else{
                $filePath = public_path('drive/profile/' . '/' . $cek->profile);
                if (file_exists($filePath)) {
                    unlink($filePath);
                } else {
                    // Handle the case where the file doesn't exist if necessary
                }
            }

            User::where('id', $id)->delete();
            Alert::success('Berhasil', 'Profile pelanggan berhasil dihapus');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Profile pelanggan gagal dihapus');
            return redirect()->back();
        }
    }
}
