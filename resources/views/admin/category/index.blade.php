@extends('layouts.admin')

@section('content')
<!-- <div class="row">
    <div class="col-12 col-md">
        @if($pesan = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$pesan}}
            </div>
        @endif
        @if($pesan = Session::get('warning'))
            <div class="alert alert-warning" role="alert">
                {{$pesan}}
            </div>
        @endif
    </div>
</div> -->
<div class="container-fluid shadow">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class=="col">
                    <h4 class="m-0 text-dark">{{$judulhalaman}}</h4>
                </div>
            </div>
        </div>
        <form action="{{ route('destroyallcategory')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="card">
                <div class="card-header">
                    <div class="justify-content-end">
                        <div class=="col">
                            <!-- <input placeholder="Search" type="search" name="search" class="form-control" > -->
                        </div>
                        <div class="float-right">
                            <a href="{{route('add-category')}}" class="btn btn-primary">Create</a>
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
                                <th>Name Category</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                    </thead>
                        <tbody> 
                            @php
                                $no =1;
                            @endphp
                            @foreach($category as $index => $item)
                            <tr>
                                <td><input type="checkbox" name="itemsid[]" value="{{$item->id}}"></td>
                                <td scope="row">{{ $index + $category->firstItem() }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <img src="{{asset('assets/uploads/category/'.$item->image)}}" alt="category image" class="cate-image"> 
                                </td>
                                <td>
                                    <a href="{{ asset('edit-category/' .$item->id)}}" class="btn btn-success">Edit</a>                                        
                                    <a href="#" class="btn btn-danger delete" data-id="{{$item->id}}" data-nama="{{$item->name}}">Delete</a>                                      
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    {{$category->links()}}
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