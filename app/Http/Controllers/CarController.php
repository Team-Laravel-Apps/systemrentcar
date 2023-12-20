<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\Cars;
use App\Models\Category;

class CarController extends Controller
{
    public function index()
    {
        $data = [
            'mobil' => Cars::all()
        ];

        return view('mobil', $data);
    }

    public function create()
    {
        $data = [
            'aksi'      => 'Tambah Kendaraan',
            'kategori'  => Category::all(),
        ];

        return view('form.formcar', $data);
    }

    public function update($id)
    {
        $data = [
            'aksi'      => 'Update Kendaraan',
            'kategori'  => Category::all(),
            'car'       => Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')->find($id)
        ];

        return view('form.formcar', $data);
    }

    public function posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail'         => ($request->aksi == 'Update Kendaraan' ? 'nullable' : 'required|file|mimes:jpeg,bmp,png,gif|max:2000'),
            'nama_kendaraan'    => 'required',
            'id_category'       => 'required',
            'biaya_sewa'        => 'required',
            'unit'              => 'required',
            'transmisi'         => 'required',
            'kapasitas'         => 'required',
            'description'       => 'required',
        ], [
            'thumbnail.file'        => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'thumbnail.mimes'       => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'thumbnail.max'         => 'Ukuran Gambar maksimal 2000 KB!',
            'thumbnail.required'    => 'Thumbnail tidak boleh kosong',
            'id_category.required'  => 'Input tidak boleh kosong',
            'biaya_sewa.required'   => 'Input tidak boleh kosong',
            'unit.required'         => 'Input tidak boleh kosong',
            'description.required'  => 'Input tidak boleh kosong',
            'transmisi.required'    => 'Input tidak boleh kosong',
            'kapasitas.required'    => 'Input tidak boleh kosong',
        ]);


        if ($validator->fails()) {
            Alert::warning('Oopss', $request->aksi.' gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $gambar = Cars::where('id', $request->id)->first();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');

            if ($file->isValid()) {
                $files = $file->hashName();

                // File Handling
                if ($request->aksi == 'Tambah Kendaraan' || $gambar->img_kendaraan == null) {
                    $file->move(public_path('drive/cars'), $files);
                } else {
                    // Delete old icon file
                    unlink(public_path('drive/cars') . '/' . $gambar->img_kendaraan);
                    $file->move(public_path('drive/cars'), $files);
                }
            } else {
                // Handle invalid file
                if($request->aksi == "Tambah Kendaraan"){
                    $files = null;
                }else{
                    $files = $gambar->img_kendaraan ?? null;
                }
            }
        } else {
            if($request->aksi == "Tambah Kendaraan"){
                $files = null;
            }else{
                $files = $gambar->img_kendaraan ?? null;
            }
        }

        $lastid = $request['id'] ? $request['id'] : Cars::max('id') + 1;
        $idcar = 'MBM' . str_pad($lastid, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));
        $set = Cars::updateOrCreate(['id' => $request['id']], [
            'id_car'            => $idcar,
            'img_kendaraan'     => $files,
            'id_category'       => $request['id_category'] == '' ? null : $request['id_category'],
            'nama_kendaraan'    => $request['nama_kendaraan'] == '' ? null : $request['nama_kendaraan'],
            'biaya_sewa'        => $request['biaya_sewa'] == '' ? null : $request['biaya_sewa'],
            'unit'              => $request['unit'] == '' ? null : $request['unit'],
            'transmisi'         => $request['transmisi'] == '' ? null : $request['transmisi'],
            'kapasitas'         => $request['kapasitas'] == '' ? null : $request['kapasitas'],
            'description'       => $request['description'] == '' ? null : $request['description'],
            'status_car'        => $request['status_car'] == '' ? 'tersedia' : $request['status_car'],
        ]);


        if ($set) {
            Alert::success('Berhasil', $request->aksi.' berhasil dilakukan');
            if($request->aksi == "Tambah Kendaraan")
            {
                return redirect()->route('mobil');
            }else{
                return redirect()->back();
            }
        }else{
            Alert::warning('Opss', 'Tidak ada perubahan dilakukan');
            return redirect()->back();
        }
    }



}
