<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
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
        //dan membatasi data yang ditampilkan sejumlah 10 data perhalaman.
        $data = Berita::latest()->paginate(10);
        //tampilkan data ke file index.blade.php yang ada didalam folder berita
        return view('berita.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datakat = Kategori::All();
        //sebelumnya pastikan sudah import modul Berita
        $data = Berita::all(); //untuk mengambil data dari tabel berita
        //tampilkan form untuk input yang ada dalam resources/views/berita/create.blade.php
        return view('berita.create',compact(['datakat']));
        return view('berita.create',compact(['data'])); //menuju atau membuka file create.blade.php yang ada dalam folder berita
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
                'id_berita'     => 'required',
                'id_kategori'   => 'required',
                'judul'   => 'required',
                'tanggal'   => 'required',
                'isi'   => 'required',
                'gambar' => 'required|mimes:jpg,jpeg,png|max:2048'
             ]);

             //proses upload gambar
             if($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $image->move(public_path('gambar'),$image->getClientOriginalName());
            }else{
                $image=NULL;
            }
             $simpan = Berita::create([
                 'id_berita'   => $request->id_berita,
                 'id_kategori'   => $request->id_kategori,
                 'judul'   => $request->judul,
                 'tanggal'   => $request->tanggal,
                 'isi_berita'   => $request->isi,
                 'gambar'   => $image->getClientOriginalName()
             ]);
             if($simpan){

                //redirect dengan pesan sukses
                return redirect('/berita')->with(['success' => 'Data Berhasil Disimpan!']);

            }else{

                //redirect dengan pesan error
                return redirect('/berita')->with(['error' => 'Data Gagal Disimpan!']);

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
        $datakat=Kategori::all();
        $berita=Berita::find($id);
        return view('berita.edit',compact(['berita','datakat'])); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'id_berita'     => 'required',
            'id_kategori'   => 'required',
            'judul'   => 'required',
            'tanggal'   => 'required',
            'isi'   => 'required',
            'gambar' => 'mimes:jpg,jpeg,png|max:2048'
     ]);
     $upd = Berita::find($id);

    if($request->file('gambar') == "") {

        $upd->update([
            'id_berita'   => $request->id_berita,
             'id_kategori'   => $request->id_kategori,
             'judul'   => $request->judul,
             'tanggal'   => $request->tanggal,
             'isi_berita'   => $request->isi,
        ]);

    } else {

         //hapus old image
        $photo = $upd->gambar;
        if(File::exists(public_path('gambar/'.$photo))){
            File::delete(public_path('gambar/'.$photo));
        }

        //proses upload gambar baru
            $image = $request->file('gambar');
            $image->move(public_path('gambar'),$image->getClientOriginalName());

        $upd ->update([
           'id_berita'   => $request->id_berita,
             'id_kategori'   => $request->id_kategori,
             'judul'   => $request->judul,
             'tanggal'   => $request->tanggal,
             'isi_berita'   => $request->isi,
             'gambar'   => $image->getClientOriginalName()
        ]);
    }

     if($upd){

        //redirect dengan pesan sukses
        return redirect('/berita')->with(['success' => 'Data Berhasil Disimpan!']);

    }else{

        //redirect dengan pesan error
        return redirect('/berita')->with(['error' => 'Data Gagal Disimpan!']);

    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $del=Berita::find($id);
        $del->delete(); //perintah untuk hapus
        if($del){
            //hapus gambar
            $photo = $del->gambar;
            if(File::exists(public_path('gambar/'.$photo))){
                File::delete(public_path('gambar/'.$photo));
             }
            //redirect dengan pesan sukses
            return redirect('/berita')->with(['success' => 'Data Berhasil Dihapus!']);

        }else{
            //redirect dengan pesan error
            return redirect('/berita')->with(['error' => 'Data Gagal Dihapus!']);

        }
    }

    public function search(Request $request)
    {
        $keyword = $request->search; //fungsi cari yang hasilnya dimasukkan ke dalam variabel keyword
        //menjalan model kategori untuk menampilkan data berdasarkan keyword yang dicari di judul berita
        $data = Berita::where('judul', 'like', "%" . $keyword . "%")->paginate(5);

        //menampilkan hasil pencarian yang isinya sudah ditampung dalam variabel data
        //dengan menampilkan hasil pencarian untuk keyword yang mirip sebanyak maksimal 5 data perhalaman
        return view('berita.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
