@extends('layouts.app')
@section('content')
<div class="row ">
    <div class="col-md-10 grid-margin">
        <div class="card">
            <div class="card-header">
                <h3>Add Product
                    <a href="{{ url('product') }}" class="btn btn-primary float-end btn-sm text-white">Back</a>
                </h3>

            </div>
            <div class="card-body">
                <form action="{{ url('/product') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row col-md-8 mb-4">
                        <div class="mb-3 col-md-12">
                            <label for="name">Product</label>
                            <input type="text" name="name"class="form-control">
                            @error('name')
                                <small class=text-danger>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="image">Image</label>
                            <input type="file" multiple name="image[]"class="form-control">
                            @error('image')
                            <small class=text-danger>{{$message}}</small>
                        @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="description">Descroption</label>
                            <textarea name="description"class="form-control" rows="3" ></textarea>
                            @error('description')
                            <small class=text-danger>{{$message}}</small>
                        @enderror
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="price">price</label>
                            <input type="number" name="price"class="form-control">
                            @error('price')
                                <small class=text-danger>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <button class="btn btn-primary ">Save Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
