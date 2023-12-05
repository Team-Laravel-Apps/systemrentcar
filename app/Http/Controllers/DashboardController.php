<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cars;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'cars' => Cars::all(),
            'pelanggan' => User::where('id_role', '0002')->get(),
            'transaksi' => Transaction::where('is_complete', 1)->get()
        ];

        return view('dashboard', $data);
    }
}
