@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{$judulhalaman}}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <form action="{{ asset('update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="name" value="{{$category->name }}" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" id="slug" value="{{$category->slug }}"name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="description" value="" class="form-control" rows="3">{{$category->description }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status" id="status" value=""{{($category->status=="1")?"checked":""}}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox" id="popular" name="popular" value="" {{($category->popular=="1")?"checked":""}}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Tittle</label>
                        <input type="text" class="form-control" id="meta_tittle" value="{{$category->meta_tittle }}" name="meta_tittle">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" class="form-control" id="meta_keywords" value="" rows="3">{{$category->meta_keywords}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_descrip" class="form-control" id="meta_descrip" value=""  rows="3">{{$category->meta_descrip}}</textarea>
                    </div>
                    @if($category->image)
                        <img src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="category image"  style="width: 100px;">
                    @endif
                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" id="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection