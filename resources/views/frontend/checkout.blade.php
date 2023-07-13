@extends('layouts.front')

@section('content')
<div class="container-fluid">
    <div class="col mb-5">
        <div class="card-header">
            <div class=="col">
                <h3 >
                    <a href="{{asset('cart')}}">
                        Keranjang Saya
                    </a>/
                    <a href="{{asset('checkout')}}">
                        {{$judulhalaman }}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <form action="{{asset('place-order')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="row">
                <div class="col-md-7">
                    <div class="card-header bg-primary">
                        <h4 class="text-white py-3"></h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-bold">Basic Details</h5>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">Nama Depan</label>
                                    <input type="text" class="form-control firstname" value="{{Auth::user()->name}}" name="fname" placeholder="Masukkan Nama Depan">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nama Belakang</label>
                                    <input type="text" class="form-control lastname" value="{{Auth::user()->last_name}}" name="lname" placeholder="Masukkan Nama Belakang">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control email" value="{{Auth::user()->email}}" name="email" placeholder="Masukkan Email">
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Nomor Telepon</label>
                                    <input type="text" class="form-control no_telp" name="no_telp" value="{{Auth::user()->no_telp}}" placeholder="Masukkan Nomor Telepon">
                                    <span id="no_telp_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Alamat</label>
                                    <input name="alamat" class="form-control alamat" value="{{Auth::user()->alamat}}"  name="alamat" placeholder="Masukkan Alamat">
                                    <span id="alamat_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Kota</label>
                                    <input type="text" class="form-control kota" value="{{Auth::user()->kota}}" name="kota" placeholder="Masukkan Kota">
                                    <span id="kota_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Provinsi</label>
                                    <input type="text" class="form-control provinsi" value="{{Auth::user()->provinsi}}" name="provinsi" placeholder="Masukkan Provinsi">
                                    <span id="provinsi_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Negara</label>
                                    <input type="text" class="form-control negara" value="{{Auth::user()->negara}}" name="negara" placeholder="Masukkan Negara">
                                    <span id="negara_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Kode Pos</label>
                                    <input type="text" class="form-control kode_pos" value="{{Auth::user()->kode_pos}}" name="kode_pos" placeholder="Masukkan Kode Pos">
                                    <span id="kode_pos_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card-header bg-secondary">
                        <h5 class="text-bold py-3"></h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-bold">Order Detail</h5>
                            <hr>
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th>No.</th>
                                        <th>Name Category</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                        $no =1;
                                    @endphp
                                    @php 
                                    $total = 0; 
                                    @endphp
                                    @foreach($cartitems as $item)
                                    <tr>
                                        
                                        <td scope="row">{{ $no++ }}</td>
                                        <td>{{$item->products->name}}</td>
                                        <td>{{$item->product_qty}}</td>
                                        <td>{{$item->products->formatRupiah('selling_price')}}</td>
                                        @php 
                                            $total += $item->products->selling_price * $item->product_qty;
                                        @endphp
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table> 
                            <hr> 
                                <h5 class=" my-3"> Total Harga : Rp. {{number_format($total, 2, ',','.')}} </h5>
                            <div class="row justify-content-center">
                                <div class="col-auto mb-3">
                                    <input type="hidden" name="payment_mode" value="COD">
                                    <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-people-carry-box"></i> Pesan Sekarang | COD</button>
                                </div>
                                <div class="col-auto mb-3">
                                    <button type="button" class="btn btn-outline-primary razorpay_btn "><i class="fa-solid fa-credit-card"></i> Pesan Sekarang | Payment</button>
                                </div>
                                <div class="col-auto mb-3">
                                <button id="pay-button">Midtrans</button>
                                </div>
                                
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-szHjkwT1FXmogz5M>"></script>

@endsection