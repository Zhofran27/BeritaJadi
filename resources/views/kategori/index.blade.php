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
                         <h2>DAFTAR KATEGORI<br>
                         <a class="btn btn-primary btn-md" href="/kategori/create">Tambah                            </a>
                        </h2>
                       <hr>
                       <form class="form" method="get" action="/kategori">
                            <div class="form-group w-50 mb-1">
                                <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan nama kategori">
                                <button type="submit" class="btn btn-primary mb-1">Cari</button>
                            </div>
                        </form>
                        <table  cellpadding="5" cellspacing="8">
                            <thead>
                               <tr>
                                    <th style="width: 20px">#</th>
                                   <th>ID KATEGORI</th>
                                   <th>NAMA KATEGORI</th>
                                   <th style="width: 20%">Aksi</th>
                               </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                               @forelse($data as $kat)
                                 <tr>
                                     <td>{{ $no }}</td>
                                     <td>
                                         {{$kat->id_kategori}}
                                     </td>
                                     <td>{{$kat->nama_kategori}}<br>
                                     </td>
                                     <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" href="/kategori/edit/{{$kat->id}}">
                                              <i class="fas fa-pencil-alt"></i>
                                           </a> 
                                            <a class="btn btn-danger" onclick="return confirm('yakin mau hapus data ini?');" 
                                              href="/kategori/{{$kat->id}}"> 
                                              <i class="fas fa-trash"></i>
                                            </a>
                                     </td>
                                 </tr>
                                 <?php $no++;?>
                                    @empty
                                    <tr>
                                    <td colspan="3">
                                    Tidak ada data.
                                    </td>
                                    </tr>
                                @endforelse
                              </tbody>
                          </table>

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