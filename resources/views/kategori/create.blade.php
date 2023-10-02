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
                        <h2>INPUT KATEGORI</h2>

                        <hr>
                        <form class="form" method="post">
                             @csrf
                            <div class="form-group w-50 mb-1">
                                Id Kategori: <input type="text" name="id_kategori" class="form-control" value="" >

                                Nama Kategori: <input type="text" name="nama_kategori" class="form-control" value="" >
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