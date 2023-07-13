@extends('layouts.front')

@section('content')
<div class="container-fluid">
    <div class="col mb-5">
        <div class="card-header">
            <div class=="col">
                <h3 >
                    <a href="{{asset('/')}}">
                        Home
                    </a>/
                    <a href="{{asset('view-category/'.$product->category->slug)}}">
                        {{$product->category->name}}
                    </a>/
                    <a href="{{asset('view-product/'.$product->category->slug.'/'.$product->slug)}}">
                        {{$judulhalaman}}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if($verifikasi_pembelian->count() > 0)
                            <h5>Tuliskan ulasan anda tentang {{$produt->name}}</h5>
                            <form action="" method="POST">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                            </form>
                        @else

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection