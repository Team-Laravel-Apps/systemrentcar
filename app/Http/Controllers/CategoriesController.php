<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => Category::all()
        ];

        return view('kategori', $data);
    }

    public function create()
    {
        $data = [
            'aksi' => 'Tambah Kategori',
        ];

        return view('form.formkategori', $data);
    }

    public function update($id_category)
    {
        $data = [
            'aksi'      => 'Update Kategori',
            'kategori'  => Category::where('id_category', $id_category)->first()
        ];

        return view('form.formkategori', $data);
    }

    public function posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:categories,category,' . ($request['id_category'] ?? '') . ',id_category',
            'icon'     => 'file|mimes:jpeg,bmp,png,gif|max:2000',
        ], [
            'category.required' => 'Form tidak boleh kosong!',
            'category.unique'   => 'Data telah tersedia!',
            'icon.file'         => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'icon.mimes'        => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'icon.max'          => 'Ukuran Gambar maksimal 2000 KB!',
        ]);


        if ($validator->fails()) {
            Alert::warning('Oopss', $request->aksi.' gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $gambar = Category::where('id_category', $request->id_category)->first();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');

            if ($file->isValid()) {
                $files = $file->hashName();

                // File Handling
                if ($request->aksi == 'Tambah Kategori' || $gambar->icon == null) {
                    $file->move(public_path('drive/kategori'), $files);
                } else {
                    // Delete old icon file
                    unlink(public_path('drive/kategori') . '/' . $gambar->icon);
                    $file->move(public_path('drive/kategori'), $files);
                }
            } else {
                // Handle invalid file
                if($request->aksi == "Tambah Kategori"){
                    $files = null;
                }else{
                    $files = $gambar->icon ?? null;
                }
            }
        } else {
            if($request->aksi == "Tambah Kategori"){
                $files = null;
            }else{
                $files = $gambar->icon ?? null;
            }
        }

        if($request->aksi == "Tambah Kategori"){
            $set = Category::create([
                'category' => $request['category'] == '' ? '' : $request['category'],
                'icon'     => $files,
            ]);
        }else{
            $set = Category::where('id_category', $request->id_category)->update([
                'category' => $request['category'] == '' ? '' : $request['category'],
                'icon'     => $files,
            ]);
        }


        if ($set) {
            Alert::success('Berhasil', $request->aksi.' berhasil dilakukan');
            if($request->aksi == "Tambah Kategori")
            {
                return redirect()->route('kategori');
            }else{
                return redirect()->back();
            }
        }else{
            Alert::warning('Opss', 'Tidak ada perubahan dilakukan');
            return redirect()->back();
        }
    }
    public function delete(Request $request, $id_category)
    {
        $cek = Category::where('id_category',  $id_category)->first();

        if($cek)
        {
            if($cek->icon == null)
            {

            }else{
                $filePath = public_path('drive/kategori' . '/' . $cek->icon);
                if (file_exists($filePath)) {
                    unlink($filePath);
                } else {
                    // Handle the case where the file doesn't exist if necessary
                }
            }

            Category::where('id_category', $id_category)->delete();
            Alert::success('Berhasil', 'Kategori berhasil dihapus');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Kategori gagal dihapus');
            return redirect()->back();
        }
    }
}
