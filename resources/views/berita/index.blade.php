@extends('adminlte::page')

    @section('title', 'dashboard admin')

    @section('content_header')
        <h1 class="m-0 text-dark">DASHBOARD ADMIN</h1>
    @stop

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0">
                            <h2>DAFTAR BERITA<br>
                                 <a class="btn btn-primary btn-md" href="/berita/create">Tambah </a>
                                </h2>
                             <hr>
                           <form class="form" method="get" action="">
                            <div class="form-group w-50 mb-1">
                                <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan judul berita">
                                <button type="submit" class="btn btn-primary mb-1">Cari</button>
                            </div>
                            </form>
                        <div class="container pt-3 text-center">

                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @forelse ($data as $berita)
                                <div class="col">
                                    <div class="card" style="height: 22rem;">
                                        <div class="card-header text-muted">
                                           <img src="{{ Storage::url('../gambar/').$berita->gambar }}" class="rounded" style="width: 150px">

                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><b>{{$berita->judul}}</b> <br>
                                                {{$berita->tanggal}}<br>
                                                {{$berita->isi_berita}}<br>
                                            </p>
                                        </div>

                                            <div class="btn-group">
                                                <a class="btn btn-warning" href="#">
                                                <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger" onclick="#" href="#">
                                                <i class="fas fa-trash"></i>
                                                </a>
                                        </div>
                                </div>
                                @empty
                                <tr>
                                <td colspan="3">
                                Tidak ada data.
                                </td>
                                </tr>
                                @endforelse
                            </div>
                        </div>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('plugins.Sweetalert2', true)
    @section('plugins.Pace', true)
    @section('js')
    @if (session('success'))
        <script type="text/javascript">
            Swal.fire(
                'Sukses!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif
    <script>
        document.addEventListener("contextmenu", function(e){
            e.preventDefault();
        }, false);
    </script>
    @stop