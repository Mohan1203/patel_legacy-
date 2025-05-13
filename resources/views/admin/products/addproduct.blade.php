@extends('layout.layout')

@section("content")
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="">
                <div class="row">
                    <div class="col-12 ">
                        <div>
                            {{-- <h4 class="card-title"></h4> --}}
                            <h4 class="card-title">Feature Section</h4>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('handle.addFeature') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Section Title</label>
                                            <input type="text" class="form-control" id="name" name="title"
                                                placeholder="Section Title" required value="{{ $featureSection->title ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Section Description</label>
                                            <textarea class="form-control" id="description" name="description"
                                                rows="4">{{ $featureSection->description ?? '' }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                        <h4 class="card-title">Add Product</h4>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('handle.addProduct') }}" method="POST" enctype="multipart/form-data"> 
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter product name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept=".jpg, .jpeg, .png, .webp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description"
                                            rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Submit</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div>
                    <table id="product-table" class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">

                            @foreach ($products as $key => $product)
                                <tr data-id="{{ $product['id'] }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product['name'] }}</td>
                                    <td>
                                        <img src="{{ asset(env('APP_URL').'/images'.  '/' . $product['image']) }}" width="50"
                                            height="50" alt="Category Image">
                                    </td>
                                    <td>{{ $product['description'] }}</td>
                                    <td>
                                        <a href="/editProduct/{{ $product['id'] }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('handle.deleteProduct', $product['id']) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    
@endsection