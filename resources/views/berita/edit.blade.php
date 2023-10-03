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
                        <form class="form-horizontal" action="/berita/{{$berita->id}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group w-50 mb-1">
				            Id Kategori:
                            <label for="id_kategori" class="col-sm-2 control-label">Id Kategori</label>
                            <div class="col-sm-3">
                            <select name="id_kategori" class="form-control">
                             @foreach ($datakat as $idkat )
                               <option value="{{ $idkat->id_kategori }}" {{ $berita->id_kategori == $idkat->id_kategori ? 'selected' : '' }}>
                                     {{$idkat->id_kategori}}
                               </option>
                             @endforeach
                            </select>
                            </div>
                
                                Id Berita: <input type="text" name="id_berita" class="form-control" value="{{$berita->id_berita}}" >
                                Judul Berita: <input type="text" name="judul" class="form-control" value="{{$berita->judul}}" >
                                Tanggal Berita: <input type="date" name="tanggal" class="form-control" value="{{$berita->tanggal}}" >
				                {{-- Gambar: <input type="file" name="gambar" class="form-control" value="" > --}}
                                Isi Berita:<textarea class="form-control rows="5" name="isi">{{$berita->isi_berita}}</textarea>
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
