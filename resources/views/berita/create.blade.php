@extends('adminlte::page')
@section('title', 'dashboard admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content_header')
    <h1 class="m-0 text-dark">DASHBOARD ADMIN</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <h2>INPUT BERITA</h2>

                        <hr>
                        <form class="form" method="post" enctype="multipart/form-data">
                             @csrf
                            <div class="form-group w-50 mb-1">
				            Id Kategori:
                            <select class="form-control" name="id_kategori">
                                @foreach ($datakat as $kategori)
                                   <option value="{{ $kategori->id_kategori }}">{{ $kategori->id_kategori }}</option>
                                @endforeach
                             </select>
                                Id Berita: <input type="text" name="id_berita" class="form-control" value="" >
                                Judul Berita: <input type="text" name="judul" class="form-control" value="" >
                                Tanggal Berita: <input type="date" name="tanggal" class="form-control" value="" >
				Gambar: <input type="file" name="gambar" class="form-control" value="" >

				Isi Berita:
				<textarea class="form-control rows="5" name="isi" ></textarea>
				<br>
                                <input type="submit" value="Simpan">

                            </div>
                        </form>


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
@stop
