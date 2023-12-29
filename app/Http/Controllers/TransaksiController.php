<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Rental;

class TransaksiController extends Controller
{
    public function proses()
    {
        $data = [
            'proses' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->join('tbl_payment', 'tbl_payment.id_transaction', '=', 'transactions.id_transaction')
            ->where('status_rental', 'proses')
            ->get()
        ];

        return view('transaksi.proses', $data);
    }

    public function pendding()
    {
        $data = [
            'pendding' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->where('status_rental', 'pendding')
            ->get()
        ];

        return view('transaksi.pendding', $data);
    }

    public function selesai()
    {
        $data = [
            'selesai' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->where('status_rental', 'selesai')
            ->get()
        ];

        return view('transaksi.selesai', $data);
    }

    public function batal()
    {
        $data = [
            'batal' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->where('status_rental', 'batal')
            ->get()
        ];

        return view('transaksi.batal', $data);
    }


    public function laporan()
    {
        return view('transaksi.laporan');
    }
}
