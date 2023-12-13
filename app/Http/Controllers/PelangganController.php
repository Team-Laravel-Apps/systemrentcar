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
}
