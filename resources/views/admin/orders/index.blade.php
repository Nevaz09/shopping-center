@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="cad">
            <div class="card-header">
                <div class=="col">
                    <h4 class="m-0 text-dark">{{$judulhalaman}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <div class="card">       
                    <div class="card-header bg-primary">
                        <h5 class="text-white py-2">
                            <a href="{{asset('orders-history')}}" class="btn btn-light float-end ">Riwayat Pesanan</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="chkpilihsemua"></th>
                                    <th>No</th>
                                    <th>Tanggal Order</th>
                                    <th>Kode Pesanan</th>
                                    <th>Total harga</th>
                                    <th>Status</th>
                                    <th>Acation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no =1;
                                @endphp
                                @foreach($orders as $index => $item)
                                <tr>
                                    <td><input type="checkbox" name="itemsid[]" value="{{$item->id}}"></td>
                                    <td scope="row">{{ $index + $orders->firstItem() }}</td>
                                    <td scope="row">{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                                    <td>{{$item->tracking_no}}</td>
                                    <td>{{$item->formatRupiah('total_price')}}</td>
                                    <td>{{$item->status == '0' ? 'Pending' :'Selesai'}}</td>
                                    <td>
                                        <a href="{{asset('adminView-order/'.$item->id)}}" class="btn btn-lg btn-info">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$orders->links()}}
                    </div>
                </div>
            </form>  
        </div>
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
                text: "Untuk Menghapus Category "+nama+"..! ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location ="/destroy-category/"+itemid+""
                swal("Terhapus! Kamu Berhasil Menghapus Category "+nama+"!", {
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