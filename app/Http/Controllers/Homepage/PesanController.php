<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use DateTime;

use App\Models\Cars;
use App\Models\Rental;

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
        $kode = 'RENT' . str_pad($lastid, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));

        $start_date = new DateTime($request->start_date);
        $end_date = new DateTime($request->end_date);
        $days_difference = $start_date->diff($end_date)->days;

        $totalbiaya = $request->biaya * $days_difference;
        dd($totalbiaya);
        $pesan = Rental::updateOrCreate(['car_id' => $request['car_id']],[
            'id'            => $lastid,
            'id_rental'     => $kode,
            'id_pelanggan'  => auth()->user()->id,
            'car_id'        => $request->car_id,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'qty'           => 1,
            'biaya'         => $totalbiaya,
            'status_rental' => 'proses',
        ]);


        if ($pesan) {
            Alert::success('Berhasil', 'Test 1');
            return redirect()->back();
        }
    }
}
