@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 >{{$judulhalaman}}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <form action="{{asset('update-product/'.$products->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <select class="form-select" >
                            <option value="">{{$products->category->name}}</option>
                            
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="name" value="{{$products->name }}" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" id="slug" value="{{$products->slug }}" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Small Description</label>
                        <textarea name="small_description" class="form-control"  id="small_description" value=""rows="3">{{$products->small_description }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="description" value="" rows="3">{{$products->description}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Original Price</label>
                        <input type="number" class="form-control" id="original_price" value="{{$products->original_price}}" name="original_price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Selling Price</label>
                        <input type="number" class="form-control" id="selling_price" value="{{$products->selling_price}}" name="selling_price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Qty</label>
                        <input type="number" class="form-control" id="qty" value="{{$products->qty}}" name="qty">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Tax</label>
                        <input type="number" class="form-control" id="tax" value="{{$products->tax}}"name="tax">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status" id="status" value=""{{($products->status=="1")?"checked":""}}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Trending</label>
                        <input type="checkbox" name="trending" id="trending" value=""{{($products->trending=="1")?"checked":""}}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Tittle</label>
                        <input type="text" class="form-control" name="meta_tittle" id="meta_tittle" value="{{$products->meta_tittle }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" class="form-control" id="meta_keywords" value=""rows="3">{{$products->meta_keywords }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_descrip" class="form-control" id="meta_descrip" value=""rows="3">{{$products->meta_descrip }}</textarea>
                    </div>
                    @if($products->image)
                        <img src="{{ asset('assets/uploads/product/'.$products->image) }}" alt="product image"  style="width: 100px;">
                    @endif
                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" id="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection