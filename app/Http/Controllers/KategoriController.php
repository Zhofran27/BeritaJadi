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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
