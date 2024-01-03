<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use DateTime;

use App\Models\Cars;
use App\Models\Rental;
use App\Models\Transaction;
use App\Models\Payment;

class PesanController extends Controller
{
    public function index($id_car)
    {
        if(auth()->user()->nik == null && auth()->user()->alamat == null && auth()->user()->alamat == null)
        {
            return view('homepage.profile');
        }else{
            $data = [
                'item' => Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
                ->join('tbl_rental', 'tbl_rental.car_id', '=', 'tbl_cars.id_car')
                ->where('id_car', $id_car)->first()
            ];
            return view('homepage.pesan', $data);
        }
    }

    public function posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date'        => 'required',
            'end_date'          => 'required',
        ], [
            'start_date.required'    => 'Form tidak boleh kosong!',
            'end_date.required'      => 'Form tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            Alert::warning('Oopss', 'Checkout gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lastid = $request['id'] ? $request['id'] : Rental::max('id') + 1;
        $kode = $request['id_rental'] ? $request['id_rental'] : 'RENT' . str_pad($lastid, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));

        $lastid1 = $request['id'] ? $request['id'] : Rental::max('id') + 1;
        $kodetrs = 'TRX' . str_pad($lastid1, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));

        $start_date = new DateTime($request->start_date);
        $end_date = new DateTime($request->end_date);
        $days_difference = $start_date->diff($end_date)->days;

        $totalbiaya = $request->biaya * $days_difference;
        if($totalbiaya == 0)
        {
            Alert::warning('Opps', 'Tanggal penyewaan tidak valid');
            return redirect()->back();
        }

        $cektransaksi = Rental::where('id_pelanggan', auth()->user()->id)
        ->where('status_rental', 'pending')
        ->orWhere('status_rental', 'proses')
        ->orWhere('status_rental', 'selesai')
        ->first();

        if($cektransaksi)
        {
            Alert::warning('Opps', 'lakukan pemesanan kembali setelah penyewaan anda berakhir');
            return redirect()->back();
        }

        $pesan = Rental::updateOrCreate(['id_rental' => $request['id_rental']], [
            'id'            => $lastid,
            'id_rental'     => $kode,
            'id_pelanggan'  => auth()->user()->id,
            'car_id'        => $request->car_id,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'qty'           => 1,
            'biaya'         => $totalbiaya,
            'status_rental' => 'pending',
        ]);

        $pesan = Transaction::create([
            'id'            => $lastid1,
            'id_transaction'=> $kodetrs,
            'id_rental'     => $kode,
            'payment_amount'  => $totalbiaya,
        ]);


        if ($pesan) {
            return redirect()->route('payment', $kodetrs);
        }
    }

    public function payment($id_transaction)
    {
        $data = [
            'pay' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->join('transactions', 'transactions.id_rental', '=', 'tbl_rental.id_rental')
            ->where('transactions.id_transaction', $id_transaction)->first(),
        ];
        return view('homepage.checkout', $data);
    }

    public function transfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transfer' => 'required',
        ], [
            'transfer.required' => 'Form tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            Alert::warning('Oopss', 'Payment gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('transfer');
        $files = $file->hashName();
        $file->move(public_path('drive/transfer'), $files);

        $lastid = $request['id'] ? $request['id'] : Payment::max('id') + 1;
        $idpay  = 'PAY' . str_pad($lastid, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));

        $transfer = Payment::create([
            'id'                => $lastid,
            'id_payment'        => $idpay,
            'id_transaction'    => $request->id_transaction,
            'id_rental'         => $request->id_rental,
            'payment_date'      => $request->payment_date,
            'payment_amount'    => $request->payment_amount,
            'payment_image'     => $files,
        ]);

        $transfer = Transaction::updateOrCreate(['id_transaction' => $request['id_transaction']], [
            'payment_date'    => now(),
        ]);

        if ($transfer) {
            return redirect()->back();
        }
    }

    public function delete(Request $request, $id_rental)
    {
        $cek = Rental::where('id_rental',  $id_rental)->first();
        $trx = Transaction::where('id_rental',  $id_rental)->first();

        if($cek)
        {
            Rental::where('id_rental', $id_rental)->delete();
            Transaction::where('id_rental', $id_rental)->delete();
            Payment::where('id_transaction', $trx->id_transaction)->delete();
            Alert::success('Berhasil', 'Produk berhasil dihapus dari keranjang');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Produk gagal dihapus dari keranjang');
            return redirect()->back();
        }
    }
}
