<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Rental;
use App\Models\Cars;

class KeranjangController extends Controller
{
    public function index($id)
    {
        $data = [
            'rental' => Rental::join('users', 'users.id', '=', 'tbl_rental.id_pelanggan')
            ->join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
            ->join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->where('status_rental', 'simpan')
            ->where('id_pelanggan', $id)
            ->where('id_pelanggan', auth()->user()->id)
            ->get()
        ];

        return view('homepage.keranjang', $data);
    }

    public function posts(Request $request)
    {
        $lastid = $request['id'] ? $request['id'] : Rental::max('id') + 1;
        $kode = $request['id_rental'] ? $request['id_rental'] : 'RENT' . str_pad($lastid, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));

        $cek = Rental::where('car_id', $request->car_id)
        ->where('id_pelanggan', auth()->user()->id)
        ->first();

        if($cek)
        {
            Alert::warning('Opps', 'Produk sudah berada di rental');
            return redirect()->back();
        }
        $keranjang = Rental::updateOrCreate(['id_rental' => $request['id_rental']],[
            'id'            => $lastid,
            'id_rental'     => $kode,
            'id_pelanggan'  => auth()->user()->id,
            'car_id'        => $request->car_id,
            'start_date'    => null,
            'end_date'      => null,
            'biaya'         => $request->biaya,
            'status_rental' => 'simpan',
        ]);


        if ($keranjang) {
            Alert::success('Berhasil', 'Produk berhasil ditambahkan kekeranjang');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Produk gagal ditambahkan kekeranjang');
            return redirect()->back();
        }
    }

    // public function jumlah(Request $request)
    // {
    //     $cek = Rental::join('tbl_cars', 'tbl_cars.id_car', '=', 'tbl_rental.car_id')
    //     ->where('car_id', $request->car_id)->first();

    //     if ($request->value == 'plus') {
    //         $qty = $cek ? ++$cek->qty : 1;
    //     } else {
    //         $qty = $cek ? max(0, --$cek->qty) : 1;
    //     }

    //     $totalbiaya = $cek->biaya_sewa * $qty;

    //     if($qty == 0){
    //         Rental::where('car_id', $request->car_id)->delete();
    //     }else{
    //         Rental::updateOrCreate(
    //             ['car_id' => $request->car_id],
    //             [
    //                 'qty'   => $qty,
    //                 'biaya' => $totalbiaya,
    //             ]
    //         );
    //     }

    //     return redirect()->back();
    // }

    public function delete(Request $request, $id_rental)
    {
        $cek = Rental::where('id_rental',  $id_rental)->first();

        if($cek)
        {
            Rental::where('id_rental', $id_rental)->delete();
            Alert::success('Berhasil', 'Produk berhasil dihapus dari keranjang');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Produk gagal dihapus dari keranjang');
            return redirect()->back();
        }
    }
}
