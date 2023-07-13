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
                        <h5 class="text-white py-3">
                            
                        </h5>
                </div>
                
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="chkpilihsemua"></th>
                                <th>ID</th>
                                <th>Name </th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @php
                                $no =1;
                            @endphp
                            @foreach($users as $index => $item)
                            <tr>
                                <td><input type="checkbox" name="itemsid[]" value="{{$item->id}}"></td>
                                <td scope="row">{{ $index + $users->firstItem() }}</td>
                                <td>{{$item->name.' '.$item->last_name}}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_telp }}</td>
                                <td>
                                    <a href="{{asset('view-users/'.$item->id)}}" class="btn btn-info btn-lg">View</a>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
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