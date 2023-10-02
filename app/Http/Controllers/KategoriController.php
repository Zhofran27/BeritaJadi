<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //mengurutkan datanya berdasarkan terbaru dengan method latest() 
        //dan membatasi data yang ditampilkan sejumlah 5 data perhalaman.
        $data = Kategori::latest()->paginate(5);
                
        //tampilkan data ke file index.blade.php yang ada didalam folder kategori
        return view('kategori.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $simpan = Kategori::create($request->all());

        if($simpan){
            //redirect dengan pesan sukses
            return redirect('/kategori')->with(['success'=>'Data Sukses Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect('/kategori')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ubah=kategori::find($id);
        return view('kategori.edit',compact(['ubah']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $upd = kategori::find($id);
        $upd->update($request->all());
        if($upd){
            return redirect('/kategori')->with(['success'=>'Data Sukses di ubah']);
        }else{
            return redirect('/kategori')->with(['error'=>'Data gagal di ubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $del=kategori::find($id);
        $del->delete(); //perintah untuk hapus
        if($del){
            //redirect dengan pesan sukses
            return redirect('/kategori')->with(['success'=>'Data Sukses Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect('/kategori')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }


    public function search(Request $request)
    {
        $keyword = $request->search; //fungsi cari yang hasilnya dimasukkan ke dalam variabel keyword
        //menjalan model kategori untuk menampilkan data berdasarkan keyword yang dicari di nama kategori
        $data = Kategori::where('nama_kategori', 'like', "%" . $keyword . "%")->paginate(5);

        //menampilkan hasil pencarian yang isinya sudah ditampung dalam variabel data
        //dengan menampilkan hasil pencarian untuk keyword yang mirip sebanyak maksimal 5 data perhalaman
        return view('kategori.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
