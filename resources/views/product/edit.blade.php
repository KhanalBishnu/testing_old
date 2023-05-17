@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Product
                        <a href="{{ url('/product') }}" class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('/product/' . $product->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name">Product</label>
                                <input type="text" name="name"class="form-control" value="{{ $product->name }}">
                                @error('name')
                                    <small class=text-danger>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">

                                <label for="image">Image</label>
                                <input type="file" multiple name="image[]"class="form-control">
                                {{-- @if ($product->image)

                                <img src="{{asset($product->image)}}" width="60px" height="60px">
                                @endif --}}
                                @if ($product->hasMedia('product_image'))
                                    @foreach ($product->getMedia('product_image') as $image)
                                        <img src="{{ $image->getUrl() }}" style="width: 80px; height: 50px"
                                            alt="{{ $product->name }}">
                                    @endforeach
                                @endif

                                @error('image')
                                    <small class=text-danger>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description">Descroption</label>
                                <textarea name="description"class="form-control" rows="3">{{ $product->description }}</textarea>
                                @error('description')
                                    <small class=text-danger>{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="mb-3 col-md-6">
                                <label for="price">Price</label>
                                <input type="number" name="price"class="form-control" value="{{ $product->price }}">
                                @error('price')
                                    <small class=text-danger>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary ">Update Product</button>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
