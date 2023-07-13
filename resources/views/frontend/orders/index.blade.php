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
                    <a href="{{asset('my-orders')}}">
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
                        <h4 class="py-3"></h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Order</th>
                                    <th>Tracking Number</th>
                                    <th>Total harga</th>
                                    <th>Status</th>
                                    <th>Acation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no =1;
                                @endphp
                                @foreach($orders as $item)
                                <tr>
                                    <td scope="row">{{ $no++ }}</td>
                                    <td>{{date('d/M/Y', strtotime($item->created_at))}}</td>
                                    <td>{{$item->tracking_no}}</td>
                                    <td>{{$item->formatRupiah('total_price')}}</td>
                                    <td>{{$item->status == '0' ? 'Pending' :'Selesai'}}</td>
                                    <td>
                                        <a href="{{asset('view-order/'.$item->id)}}" class="btn btn-lg btn-info">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection