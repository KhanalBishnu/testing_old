@extends('layouts.app')
@section('content')
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="aler alert-success col-md-10">{{ session('message') }}</div>
        @endif
        <div class="card">

            <div class="card-header">
                <h3>Product
                    <a href="{{ url('product/create') }}" class="btn btn-primary float-end btn-sm text-white">Add
                        Product</a>
                </h3>

            </div>
            <div class="card-body">
                <table class="table table-bordered striped">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($product as $productItem)
                            <tr>
                                <td>{{ $productItem->id }}</td>
                                <td>{{ $productItem->name }}</td>
                                <td>
                                    {{-- @if ($productItem->image)
                                        <img src="{{ asset($productItem->image) }}"
                                            style="width: 80px; height: 50px" alt="{{ $productItem->name }}">
                                    @endif --}}
                                    {{-- @if ($productItem->hasMedia('product_image'))
                                    @foreach ($productItem->getMedia('product_image') as $image )


                                    <img src="{{ $image->getUrl() }}"
                                    style="width: 80px; height: 50px" alt="{{ $productItem->name }}">
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{ $productItem->description }}</td>
                                <td>{{ $productItem->price }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ url('/product/' . $productItem->id . '/edit') }}">Edit</a>
                                    <a class="btn btn-danger btn-sm"
                                        href="{{ url('/product/' . $productItem->id . '/delete') }}">delete</a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
                <div>
                    {{-- {{$product->links()}} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
