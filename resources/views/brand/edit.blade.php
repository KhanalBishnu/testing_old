@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Product
                        <a href="{{ url('/brand') }}" class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('/brand/' . $product->id) }}" enctype="multipart/form-data" method="POST">
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
                                <label for="description">Descroption</label>
                                <textarea name="description"class="form-control" rows="3">{{ $product->description }}</textarea>
                                @error('description')
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
