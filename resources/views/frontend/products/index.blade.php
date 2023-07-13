@extends('layouts.front')

@section('content')
<div class="container-fluid">
    <div class="col">
        <div class="card-header">
            <div class=="col">
                <h3 >   
                    <a href="{{asset('category')}}">
                        Category
                    </a>/
                    <a href="{{asset('view-category/'.$category->slug)}}">
                        {{$judulhalaman}}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="contaier-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-3 mb-2">
                            <div class="card">
                                <a href="{{asset('view-product/'.$category->slug.'/'.$product->slug)}}">
                                    <img src="{{asset('assets/uploads/product/'.$product->image)}}" alt="product image" width="300px" height="300px">
                                    <div class="card-body">
                                        <h5 class="fw-bold">{{$product->name}}</h5>
                                        <span>{{$product->small_description}}</span> <br>
                                        <small class="float-start"><s>{{$product->formatRupiah('original_price')}}</s></small>
                                        <small class="float-end">{{$product->formatRupiah('selling_price')}}</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
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
@endsection
