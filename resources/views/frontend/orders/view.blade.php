@extends('layouts.front')

@section('content')
<div class="container-fluid">
    <div class="col mb-5">
        <div class="card-header">
            <div class=="col">
                <h3 >
                    <a href="{{asset('my-orders')}}">
                        Pesanan Saya
                    </a>/
                    <a href="{{asset('view-order')}}">
                        {{$judulhalaman }}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white py-2">Pesanan {{$orders->tracking_no}}
                            <a href="{{asset('my-orders')}}" class="btn btn-light float-end">Kembali</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details" >
                                <h5 class="py-2">Detail Pengiriman</h5>
                                <hr>
                                <label for="" class="text-center my-2">Nama Depan</label>
                                <div class="border ">{{$orders->fname}}</div>
                                <label for="" class="text-center my-2">Nama Belakang</label>
                                <div class="border ">{{$orders->lname}}</div>
                                <label for="" class="text-center my-2">Email</label>
                                <div class="border ">{{$orders->email}}</div>
                                <label for="" class="text-center my-2">No. Telp</label>
                                <div class="border ">{{$orders->no_telp}}</div>
                                <label for="" class="text-center my-2">Alamat Pengiriman</label>
                                <div class="border ">
                                    {{$orders->alamat}},
                                    {{$orders->kota}},
                                    {{$orders->provinsi}},
                                    {{$orders->negara}}
                                    {{$orders->kode_pos}}.
                                </div>
                            </div>
                            <div class="col-md-6 order-details">
                                <h5 class="py-2">Detail Pesanan</h5>
                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1;@endphp
                                        @foreach($orders->orderitems as $item)
                                        <tr>
                                            <td scope="row">{{ $no++ }}</td>
                                            <td>{{$item->products->name}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>{{$item->formatRupiah('price')}}</td>
                                            <td>
                                                <img src="{{asset('assets/uploads/product/'.$item->products->image)}}" width="90px" height="90px" alt="Product Image">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr> 
                                <div class="row float-end">
                                    <div class="col-auto ">
                                        <label class=" text-center float-end"> Total Harga : {{$orders->formatRupiah('total_price')}}</label> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection