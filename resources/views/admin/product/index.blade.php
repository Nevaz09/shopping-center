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
        <form action="{{ route('destroyallproduct')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="card">
                <div class="card-header">
                    <div class="justify-content-end">
                        <div class=="col">
                            <!-- <input placeholder="Search" type="search" name="search" class="form-control" > -->
                        </div>
                        <div class="float-right">
                            <a href="{{route('add-product')}}" class="btn btn-primary">Create</a>
                            <button type="submit" class="btn btn-danger">Delete All</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="chkpilihsemua"></th>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Name Product</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @php
                                $no =1;
                            @endphp
                            @foreach($products as $index => $item)
                            <tr>
                                <td><input type="checkbox" name="itemsid[]" value="{{$item->id}}"></td>
                                <td scope="row">{{ $index + $products->firstItem() }}</td>
                                <td>{{$item->category->name}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->small_description }}</td>
                                <td>{{ $item->formatRupiah('selling_price') }}</td>
                                <td>
                                    <img src="{{asset('assets/uploads/product/'.$item->image)}}" alt="product image" class="cate-image"> 
                                </td>
                                <td>{{ $item->qty }}</td>
                                <td>
                                    <a href="{{ asset('edit-product/' .$item->id)}}" class="btn btn-success">Edit</a>                                        
                                    <a href="#" class="btn btn-danger delete" data-id="{{$item->id}}" data-nama="{{$item->name}}">Delete</a>                                      
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
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