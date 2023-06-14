<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Membuat Fungsi Search
        $keyWords = $request->keyWords;
        $pages = 5;
        if (strlen($keyWords)) {
            Session::flash('keyWords', $request->keyWords);
            $foods = Makanan::where('name', 'like', "%$keyWords%")
            ->orWhere('price', 'like', "%$keyWords%")
            ->orWhere('description', 'like', "%$keyWords%")
            ->paginate($pages);
        } else {
            //Menampilkan Seluruh Data Makanan
            $foods = Makanan::latest()->paginate($pages);
        }
        return view('makanan.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Menampilkan Tampilan Yang Terkait Dengan Menambahkan Data
        return view('makanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Untuk Mengembalikan Nilai Yang Diketik User Pada Form
        Session::flash('name', $request->name);
        Session::flash('price', $request->price);
        Session::flash('description', $request->description);
        Session::flash('qty', $request->qty);
        Session::flash('image', $request->hashName);

        //Untuk Validasi Data Yang Masuk Ke Database
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required|max:500',
            'qty' => 'required|numeric|',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ], [
            'name.required' => "Kolom Nama Harus Diisi",
            'name.max' => "Oops! Nama Maksimal 255 Karakter",
            'price.required' => "Kolom Harga Wajib Diisi",
            'price.numeric' => "Harga Hanya Boleh Diisi Dengan Angka",
            'description.required' => "Kolom Deskripsi Harus Diisi",
            'description.max' => "Oops! Deskripsi Maksimal 500 Karakter",
            'qty.required' => "Kolom Qty Harus Diisi",
            'qty.numeric' => "Qty Hanya Boleh Diisi Dengan Angka",
            'image.required' => "Kolom Foto Harus Diisi",
            'image.image' => "File Harus Berbentuk Image",
            'image.mimes' => "Gambar Harus Dengan Format png, jpg or JPEG"
        ]);

        //Untuk Menambahkan Data Kedalam Database Kita
        $image = $request->file('image');
        $image->storeAs('public/makanans', $image->hashName());

        $foodsData = Makanan::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'qty' => $request->qty,
            'image' => $image->hashName()
        ]);

        if ($foodsData) {
            return redirect()->to('makanan')->with(["success" => "Data Berhasil Disimpan!"]);
        } else {
            return redirect()->to('makanan')->with(['error', "Data Gagal Disimpan!"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Untuk Menampilkan Tampilan Edit
        $food = Makanan::where('id', $id)->first();
        return view('makanan.edit')->with('food', $food);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Untuk Validasi Update
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required|max:500|',
            'qty' => 'required|numeric',
            'image' => 'image|mimes:png,jpg,jpeg'
        ], [
            'name.required' => "Kolom Nama Harus Diisi",
            'name.max' => "Oops! Nama Maksimal 255 Karakter",
            'price.required' => "Kolom Harga Harus Diisi",
            'price.numeric' => "Oops! Harga Hanya Boleh Diisi Dengan Angka",
            'description.required' => "Kolom Deskripsi Harus Diisi",
            'description.max' => "Oopa! Deskripsi Maksimal 500 Karakter",
            'qty.required' => "Kolom Qty Harus Diisi",
            'qty.numeric' => "Oops! Qty Hanya Boleh Diisi Dengan Engka",
            'image.image' => "Oops! Gambar Harus Berbentuk Image",
            'image.mimes' => "Oops! Format Gambar Harus PNG, JPG Atau JPEG"
        ]);
        
        //Untuk Update Data
        $foodsData = Makanan::findOrFail($id);

        if ($request->file('image') == "") {
            $foodsData->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'qty' => $request->qty
            ]);
        } else {
            Storage::disk('local')->delete('public/makanans/'.$foodsData->image);

            $image = $request->file('image');
            $image->storeAs('public/makanans/', $image->hashName());

            $foodsData->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'qty' => $request->qty,
                'image' => $image->hashName()
            ]);
        }

        if ($foodsData) {
            return redirect()->route('makanan.index')->with(['success' => "Data Berhasil Di Update!"]);
        } else {
            return redirect()->route('makanan.index')->with(['error' => "Data Gagal Di Update!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Untuk Menghapus Data
        $foodsData = Makanan::where('id', $id)->first();
        Storage::disk('local')->delete('public/makanans'.$foodsData->image);
        $foodsData->delete();

        if ($foodsData) {
            return redirect()->route('makanan.index')->with(['success' => "Data Berhasil Di Hapus!"]);
        } else {
            return redirect()->route('makanan.index')->with(['error' => "Data Gagagl Di Hapus!"]);
        }
    }
}
