<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use App\Models\Rental;
use App\Models\Transaction;
use App\Models\Cars;

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
            ->where('status_rental', 'batal')
            ->get()
        ];

        return view('transaksi.batal', $data);
    }

    public function pengembalian()
    {
        $data = [
            'pengembalian' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->join('tbl_payment', 'tbl_payment.id_transaction', '=', 'transactions.id_transaction')
            ->where('status_rental', 'selesai')
            ->orWhere('status_rental', 'dikembalikan')
            ->get(),

            'count' => Rental::where('status_rental', 'dikembalikan')->count()
        ];

        return view('transaksi.pengembalian', $data);
    }

    public function approvel(Request $request)
    {
        if($request->aksi == 'Menyelesaikan transaksi')
        {
            $stok = Cars::select('unit')->where('id_car', $request->id_car)->first();
            $aprovel = Cars::updateOrCreate(['id_car' => $request['id_car']], [
                'unit' => $stok->unit - 1,
            ]);
        }

        $aprovel = Rental::updateOrCreate(['id_rental' => $request['id_rental']], [
            'status_rental' => $request->status,
        ]);

        $aprovel = Transaction::updateOrCreate(['id_rental' => $request['id_rental']], [
            'is_complete' => $request->is_complete,
        ]);

        if($request->status == "batal")
        {
            $cek = Payment::where('id_transaction', $request['id_transaction'])->first();
            $filePath = public_path('drive/kategori' . '/' . $cek->payment_image);
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                    // Handle the case where the file doesn't exist if necessary
            }
            $aprovel = Transaction::where('id_rental', $request['id_rental'])->delete();
            $aprovel = Payment::where('id_transaction', $request['id_transaction'])->delete();
        }

        if($aprovel)
        {
            Alert::success('Berhasil', $request->aksi.' berhasil dilakukan');
            return redirect()->back();
        }
    }

    public function diterima(Request $request)
    {
        $stok = Cars::select('unit')->where('id_car', $request->id_car)->first();
        $diterima = Cars::updateOrCreate(['id_car' => $request['id_car']], [
            'unit' => $stok->unit + 1,
        ]);

        $diterima = Rental::updateOrCreate(['id_rental' => $request['id_rental']], [
            'status_rental' => $request->status,
            'end_date'      => now(),
        ]);

        if($diterima)
        {
            Alert::success('Berhasil', 'Pengembalian kendaraan berhasil dilakukan');
            return redirect()->back();
        }
    }

    public function laporan(Request $request)
    {
        $query = Transaction::join('tbl_rental', 'tbl_rental.id_rental', '=', 'transactions.id_rental')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_payment', 'tbl_payment.id_transaction', '=', 'transactions.id_transaction')
            ->where('is_complete', 1);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $query->whereBetween('tbl_payment.payment_date', [$start_date, $end_date]);
        } elseif ($start_date) {
            $query->where('tbl_payment.payment_date', '>=', $start_date);
        } elseif ($end_date) {
            $query->where('tbl_payment.payment_date', '<=', $end_date);
        }


        $data = [
            'transaksi' => $query->get(),
        ];

        return view('transaksi.laporan', $data);
    }
}
