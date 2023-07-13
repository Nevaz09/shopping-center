@extends('layouts.front')

@section('content')
   @include('layouts.inc.slider')
      <div class="py-5">
         <div class="container-fluid">
            <div class="row">
               <h3 class="fw-bold text-center"> Promo Product </h3>
               <div class="owl-carousel owl-theme product">
                  @foreach($featured_product as $products)
                  <div class="col-md mt-3 ">
                     <div class="card">
                        <a href="#">
                           <img src="{{asset('assets/uploads/product/'.$products->image)}}" alt="product image"width="300px" height="300px">
                           <div class="card-body">
                              <h5 class="fw-bold">{{$products->name}}</h5>
                              <small class="float-start"><s>{{$products->formatRupiah('original_price')}}</s></small>
                              <small class="float-end">{{$products->formatRupiah('selling_price')}}</small>
                           </div>
                        </a>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
      <div class="py-5">
         <div class="container-fluid">
            <div class="row">
               <h3 class="fw-bold text-center"> Category Trending </h3>
               <div class="owl-carousel owl-theme product">
                  @foreach($featured_category as $category)
                  <div class="col-md mt-3 ">
                     <div class="card">
                        <a href="{{asset('view-category/'.$category->slug)}}">
                           <img src="{{asset('assets/uploads/category/'.$category->image)}}" alt="product image"width="300px" height="300px">
                           <div class="card-body">
                              <h5 class="fw-bold">{{$category->name}}</h5>
                              <p >{{$category->description}}</p>
                           </div>
                        </a>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
@endsection
@section('js')
   <script>
      $('.product').owlCarousel({
         loop:true,
         margin:10,
         nav:true,
         
         responsive:{
            0:{
                  items:1
            },
            600:{
                  items:3
            },
            1000:{
                  items:5
            }
         }
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
@endsection
