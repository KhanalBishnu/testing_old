@extends('layouts.app')
@section('content')
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="aler alert-success col-md-10">{{ session('message') }}</div>
        @endif
        <div class="card">

            <div class="card-header">
                <h3>Product
                    @role('Admin')
                    <a href="{{ url('brand/create') }}" class="btn btn-primary float-end btn-sm text-white">Add
                        Product</a>
                        @else
                        <div class="float-end">No Permission</div>
                        @endrole
                </h3>

            </div>
            <div class="card-body">
                <table class="table table-bordered striped">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $productItem)
                            <tr>
                                <td>{{ $productItem->id }}</td>
                                <td>{{ $productItem->name }}</td>

                                <td>{{ $productItem->description }}</td>
                                <td>

                                    <a class="btn btn-primary btn-sm"
                                        href="{{ url('/brand/' . $productItem->id . '/edit') }}">Edit</a>
                                    <a class="btn btn-danger btn-sm"
                                        href="{{ url('/brand/' . $productItem->id . '/delete') }}">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$product->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
