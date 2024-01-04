<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cars;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'cars' => Cars::all(),
            'pelanggan' => User::where('id_role', 3)
            ->join('tbl_rental', 'tbl_rental.id_pelanggan', '=', 'users.id')
            ->where('status_rental', 'selesai')
            ->get(),
            'transaksi' => Transaction::where('is_complete', 1)->get(),

            'data_trx' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->join('tbl_payment', 'tbl_payment.id_transaction', '=', 'transactions.id_transaction')
            ->where('status_rental', 'selesai')
            ->orWhere('status_rental', 'dikembalikan')
            ->whereMonth('transactions.payment_date', '=', now()->month)
            ->get()
        ];

        return view('dashboard', $data);
    }
}
