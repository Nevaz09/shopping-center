@extends('layouts.front')

@section('content')
<div class="container-fluid">
    <div class="col mb-5">
        <div class="card-header">
            <div class=="col">
                <h3 >
                    <a href="{{asset('category')}}">
                        Category
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
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <img src="{{asset('assets/uploads/product/'.$product->image)}}" alt="product image" width="400px" height="400px">
                    </div>
                    <div class="col-8">
                        <h2 class="fw-bold">
                            {{$product->name}}
                            <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">{{$product->trending == '1'?'Trending':''}}</label>
                            <hr>
                        </h2>
                        @php $ratenum = number_format($rating_value) @endphp
                        <div class="rating my-2">
                            <span class="fw-bold"> <u> {{$rating_value}}</u>  </span>
                            @for($i=1; $i<=$ratenum; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for($j=$ratenum+1; $j<=5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span class="fw-bold">
                                @if($ratings->count() >0)
                                    | <u> {{$ratings->count()}}</u> Penilaian
                                @else
                                    | Belum Ada Penilaian
                                @endif  
                            </span>
                            
                        </div>
                        <label class="me-3 ">Discount : <s>{{$product->formatRupiah('original_price')}}</s></label>
                        <label class="fw-bold text-black-50">Harga : {{$product->formatRupiah('selling_price')}}</label>
                        <p class="mt-3">
                            {{$product->small_description}}
                        </p>
                        <hr>
                        @if($product->qty >= 1)
                        <label class="budge bg-success fw-bold">Stock Tersedia </label>
                        @else
                        <label class="budge bg-warning">Stock Habis</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{$product->id}}" class="product_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3 ">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" value="1" class="form-control qty-input text-center">
                                    <btton class="input-group-text increment-btn">+</btton>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br>
                                <button type="button" class="btn btn-outline-danger me-3 float-start addWishlist" ><i class=" fw-3 material-icons">favorite_border</i></button>
                                @if($product->qty > 0)
                                <button type="button" class="btn btn-primary me-3 float-start addCartBtn" ><i class=" fw-3 material-icons">add_shopping_cart</i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                            <hr>
                            <h5 class="fw-bold">Deskripsi</h5>
                            <p class="my-3">{{$product->description}}</p>
                            <hr>
                            <button type="button" class="btn btn-light shadow me-3 my-2" data-toggle="modal" data-target="#exampleModal"><u> Ratting Product</u></button>
                            <button type="button" class="btn btn-light shadow me-3 my-2" data-toggle="modal" data-target="#exampleModalLong"><u> Review Product</u></button>
                            <br> 
                    </div>
                    <div class="col-md-12 mt-3">
                        @foreach($reviews as $item)
                            <div class="user-review">
                                <img src="{{asset('assets/uploads/profile/noimage.png')}}" alt="" width="45px" height="45px">
                                <h7 for="">{{$item->user->name .' '.$item->user->last_name}}</h7>
                                <br>
                                @if($item->ratings)
                                    @php $user_rated = $item->ratings->stars_rated @endphp
                                    @for($i=1; $i<=$user_rated; $i++)
                                        <i class="fa fa-star checked"></i>
                                    @endfor
                                    @for($j=$user_rated+1; $j<=5; $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                @endif
                                <br>
                                <small>{{date('d/m/Y H:i', strtotime($item->created_at))}}</small>
                                <br>
                                <p>
                                    {{$item->user_review}}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ asset('/add-ratting')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ratting {{$product->name}}</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="rating-css ">
                                            <div class="star-icon">
                                                @if($user_rating)
                                                    @for($i=1; $i<=$user_rating->stars_rated; $i++)
                                                        <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                                                        <label for="rating{{$i}}" class="fa fa-star"></label>    
                                                    @endfor
                                                    @for($j=$user_rating->stars_rated+1; $j<=5; $j++)
                                                        <input type="radio" value="{{$j}}" name="product_rating"  id="rating{{$j}}">
                                                        <label for="rating{{$j}}" class="fa fa-star"></label>
                                                    @endfor
                                                @else
                                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                                    <label for="rating1" class="fa fa-star"></label>
                                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                                    <label for="rating2" class="fa fa-star"></label>
                                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                                    <label for="rating3" class="fa fa-star"></label>
                                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                                    <label for="rating4" class="fa fa-star"></label>
                                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                                    <label for="rating5" class="fa fa-star"></label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Beri Ratting</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                @if($verifikasi_pembelian->count() > 0)
                                <form action="{{ asset('add-review')}}" method="POST">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Tuliskan ulasan anda tentang {{$product->name}}</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">    
                                        <textarea name="user_review" class="form-control" cols="50" rows="10" placeholder="Tulis ulasan anda"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan Ulasan</button>
                                    </div>
                                </form>
                                @else
                                    <div class="modal-header alert alert-danger">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Anda tidak dapat memberikan review  {{$product->name}}</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">    
                                        <p>Untuk kepercayaan ulasan, hanya pelanggan yang membeli produk 
                                            yang dapat menulis ulasan tentang produk tersebut.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
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
                    window.location.reload();
                    loadcart();
                }
            });
        });

        $('.addWishlist').click(function(e){
            e.preventDefault();
            var product_id = $(this).closest('.product_data').find('.product_id').val();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/add-wishlist",
                dataType: "json",
                data: {
                    'product_id': product_id,
                },
                success: function(response){
                    swal("", response.status, "success");
                    loadwishlist();
                    window.location.reload();
                }
            });
        });

        $('.increment-btn').click(function(e) {
           e.preventDefault(); 
           var inc_value = $('.qty-input').val();
           var value = parseInt(inc_value, 10);
           value = isNaN(value) ? 0 : value;
           if(value < 10){
                value++;
                $('.qty-input').val(value);
           }
        });
        $('.decrement-btn').click(function (e) {
            e.preventDefault(); 
            var decc_value = $('.qty-input').val();
            var value = parseInt(decc_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value > 1){
                value--;
                $('.qty-input').val(value);
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
