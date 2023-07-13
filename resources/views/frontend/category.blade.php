@extends('layouts.front')

@section('content')
<div class="container-fluid">
    <div class="cad">
        <div class="card-header">
            <div class=="col">
                <h3 class=" m-0 text-dark text-xl">{{$judulhalaman}}</h3>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="contaier-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach($featured_category as $category)
                        <div class="col-md-2 mb-2">
                            <div class="card ">
                                <a href="{{asset('view-category/'.$category->slug)}}">
                                    <img src="{{asset('assets/uploads/category/'.$category->image)}}" alt="category image" width="300px" height="300px">
                                    <div class="card-body">
                                        <h5 class="fw-bold">{{$category->name}}</h5>
                                        <span>{{$category->description}}</span>
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