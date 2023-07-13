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
                    <a href="{{asset('cart')}}">
                        {{$judulhalaman }}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    
    @if($cartItem->count() > 0)
    @php $total = 0; @endphp
    @foreach( $cartItem as $item)
    <div class="container my-3 ">
        <div class="card shadow product_data ">
            <div class="card-body">
                <div class="row ">
                    <div class="col-4 p-4">
                        <img src="{{asset('assets/uploads/product/'.$item->products->image)}}" alt="product image" width="200px" height="200px">
                    </div>
                    <div class="col-8">
                        <h2 class="fw-bold">
                           {{ $item->products->name}}
                            <hr>
                        </h2>
                        <label class="me-3">Harga : {{$item->products->formatRupiah('selling_price')}}</label>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{$item->product_id}}" class="product_id">
                                @if( $item->products->qty >= $item->product_qty)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3 ">
                                        <button class="input-group-text chageQuantity decrement-btn">-</button>
                                        <input type="text" name="quantity" value="{{$item->product_qty}}" class="form-control qty-input text-center">
                                        <btton class="input-group-text chageQuantity increment-btn">+</btton>
                                    </div>
                                    @php 
                                        $total += $item->products->selling_price * $item->product_qty;
                                    @endphp
                                @else 
                                    <label class="budge bg-warning">Stock Habis</label>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <br>
                                <button type="button" class="btn btn-danger delete-cartItem" ><i class="fa-solid fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    @endforeach
    <div class="container">
        <div class="card-footer my-2">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-8">
                    <h5 class="float-end my-3 "> Total Harga : Rp. {{number_format($total, 2, ',','.')}} 
                        <a href="{{asset('checkout')}}" class="btn btn-outline-primary btn-lg">Check out</a>
                    </h5>    
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container my-3">
        <div class="card shadow ">
            <div class="card-body text-center">
                <h3 class="mb-5">Tidak Ada Barang Yang Dimasukkan Keranjang</h3>
                <a href="{{asset('category')}}" class="btn btn-lg btn-outline-primary float-end mt-5">Lanjutkan Berbelanja</a>
            </div> 
        </div>
    </div>
    @endif
</div>

@endsection
@section('js')
<script>
    $(document).ready(function(){

        $('.increment-btn').click(function(e) {
           e.preventDefault(); 
           var inc_value = $(this).closest('.product_data').find('.qty-input').val();
           var value = parseInt(inc_value, 10);
           value = isNaN(value) ? 0 : value;
           if(value < 10){
                value++;
                $(this).closest('.product_data').find('.qty-input').val(value);
           }
        });
        $('.decrement-btn').click(function (e) {
            e.preventDefault(); 
            var dec_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(dec_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value > 1){
                value--;
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });

        // $('.delete-cartItem').click(function (e) {
        $(document).on('click', '.delete-cartItem', function(e){
            e.preventDefault();
            var product_id =  $(this).closest('.product_data').find('.product_id').val();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "delete-cartItem",
                data: {
                    'product_id':product_id,
                },
                success: function (response) {
                    window.location.reload();
                    // $('.cartitems').load(location.href + ".cartitems");
                    swal("", response.status, "success");
                }
            });
        });
        
        
        $('.chageQuantity').click(function (e){
            e.preventDefault();
            var product_id =  $(this).closest('.product_data').find('.product_id').val();
            var qty = $(this).closest('.product_data').find('.qty-input').val();
            data = {
                    'product_id':product_id,
                    'product_qty':qty,
            }
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                method: "POST",
                url: "update-cartItem",
                data: data,
                success: function (response) {
                    window.location.reload();
                    // $('.cartitems').load(location.href + ".cartitems");
                    swal("", response.status, "success");
                }
            });
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
