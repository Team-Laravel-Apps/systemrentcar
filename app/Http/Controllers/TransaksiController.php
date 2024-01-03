<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use App\Models\Rental;
use App\Models\Transaction;

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

    public function pending()
    {
        $data = [
            'pending' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->join('tbl_payment', 'tbl_payment.id_transaction', '=', 'transactions.id_transaction')
            ->where('status_rental', 'pending')
            ->get()
        ];

        return view('transaksi.pending', $data);
    }

    public function selesai()
    {
        $data = [
            'selesai' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->join('tbl_payment', 'tbl_payment.id_transaction', '=', 'transactions.id_transaction')
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

    public function approvel(Request $request)
    {
        $aprovel = Rental::updateOrCreate(['id_rental' => $request['id_rental']], [
            'status_rental' => $request->status,
        ]);

        $aprovel = Transaction::updateOrCreate(['id_rental' => $request['id_rental']], [
            'is_complete' => $request->is_complete,
        ]);

        if($request->status == "batal")
        {
            $cek = Payment::where('id_rental', $request['id_rental'])->first();
            $filePath = public_path('drive/kategori' . '/' . $cek->payment_image);
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                    // Handle the case where the file doesn't exist if necessary
            }
            $aprovel = Transaction::where('id_rental', $request['id_rental'])->delete();
            $aprovel = Payment::where('id_rental', $request['id_rental'])->delete();
        }

        if($aprovel)
        {
            Alert::success('Berhasil', $request->aksi);
            return redirect()->back();
        }
    }

    public function laporan()
    {
        return view('transaksi.laporan');
    }
}
