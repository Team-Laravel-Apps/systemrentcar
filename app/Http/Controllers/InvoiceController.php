<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rental;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.invoice');
    }


    public function InvoicePelanggan($id_transaction){
        $data = [
            'inv' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->where('transactions.id_transaction', $id_transaction)->first(),
        ];

        return view('homepage.invoice', $data);
    }

    public function InvoicePrint($id_transaction){
        $data = [
            'inv' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->where('transactions.id_transaction', $id_transaction)->first(),
        ];

        return view('invoice.print', $data);
    }
}
