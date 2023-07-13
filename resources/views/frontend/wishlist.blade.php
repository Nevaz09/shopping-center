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
                    <a href="{{asset('wishlist')}}">
                        {{$judulhalaman }}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    
   
    @if($wishlist->count() > 0)
    @foreach( $wishlist as $item)
    <div class="container my-3 ">
        <div class="card shadow product_data">
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
                        @if($item->products->qty > 0)
                            <h6 class="mt-2">
                                <label class="budge bg-success">Stock Tersedia</label>
                            </h6>
                        @else
                            <h6 class="mt-2" >
                                <label class="budge bg-warning">Stock Habis</label>
                            </h6>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{$item->product_id}}" class="product_id">
                                @if( $item->products->qty >= $item->product_qty)
                                    @if($item->products->qty >0)
                                        <label for="Quantity">Quantity</label>
                                        <div class="input-group text-center mb-3 ">
                                            <button class="input-group-text decrement-btn">-</button>
                                            <input type="text" name="quantity" value="1" class="form-control qty-input text-center">
                                            <btton class="input-group-text increment-btn">+</btton>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="col-md-10">
                                <br>
                                <button type="button" class="btn btn-lg btn-danger delete-wishlistItem" ><i class="fa-solid fa-trash"></i> </button>
                                @if($item->products->qty > 0)
                                <button type="button" class="btn btn-lg btn-primary addCartBtn" ><i class="fa-solid fa-cart-plus"></i> </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="container my-3">
        <div class="card shadow ">
            <div class="card-body text-center">
                <h3 class="mb-5">Tidak Ada Barang Dimasukkan Kedalam Daftar Keinginan</h3>
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

        $('.delete-wishlistItem').click(function (e) {
            e.preventDefault();
            var product_id =  $(this).closest('.product_data').find('.product_id').val();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "delete-wishlistItem",
                data: {
                    'product_id':product_id,
                },
                success: function (response) {
                    window.location.reload();
                    swal("", response.status, "success");
                }
            });
        });
        
        $('.addCartBtn').click(function(e){
            e.preventDefault();
            
            var product_id = $(this).closest('.product_data').find('.product_id').val();
            var product_qty = $(this).closest('.product_data').find('.qty-input').val();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/add-cart",
                dataType: "json",
                data: {
                    'product_id': product_id,
                    'product_qty': product_qty,
                },
                success: function(response){
                    swal("", response.status, "success");
                    loadcart();
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
