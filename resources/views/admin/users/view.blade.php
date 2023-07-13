@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class=="col">
                    <h4 class="m-0 text-dark">{{$judulhalaman}}</h4>
                </div>
            </div>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="card">
                <div class="card-header bg-primary">
                        <h5 class="text-white py-2">
                            <a href="{{asset('users')}}" class="btn btn-light mr-3 float-end">Kembali</a>
                        </h5>
                </div> 
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="">Role</label>
                            <div class="p-3 border">{{$users->role_as == '0' ? 'User':'Admin'}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Nama Depan</label>
                            <div class="p-3 border">{{$users->name }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Nama Belakang</label>
                            <div class="p-3 border">{{ $users->last_name }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Email</label>
                            <div class="p-3 border">{{$users->email}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Nomor Telepon</label>
                            <div class="p-3 border">{{$users->no_telp}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Alamat</label>
                            <div class="p-3 border">{{$users->alamat}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Kota</label>
                            <div class="p-3 border">{{$users->kota}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Provinsi</label>
                            <div class="p-3 border">{{$users->provinsi}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Negara</label>
                            <div class="p-3 border">{{$users->negara}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Kode Pos</label>
                            <div class="p-3 border">{{$users->kode_pos}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Akun Dibuat</label>
                            <div class="p-3 border">{{ date('D-M-Y', strtotime($users->created_at)) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
    <script>
        $('.delete').click(function(){
            var itemid=$(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                title: "Apakah kamu yakin?",
                text: "Untuk Menghapus Product "+nama+"..! ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location ="/destroy-product/"+itemid+""
                swal("Terhapus! Kamu Berhasil Menghapus Data Product "+nama+"!", {
                icon: "success",
                });
            } else {
                swal("Data Tidak Jadi Dihapus!");
            }
            }); 
        });
    </script>
    <script>
    @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}")
    @endif
    @if(Session::has('error'))
        toastr.error("{{Session::get('error')}}")
    @endif
    @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}")
    @endif
    </script>
@endsection()