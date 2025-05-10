@extends('layout.layout')

@section("content")
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="">
                <div class="row">
                    <div class="col-12 ">
                        <div>
                            {{-- <h4 class="card-title"></h4> --}}
                            <div class="card">
                                <div class="card-body">
                                    {{-- <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"> --}}
                                        {{-- @csrf --}}
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Section Title</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Section Title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Section Description</label>
                                            <textarea class="form-control" id="description" name="description"
                                                rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        {{-- <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a> --}}
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                        <h4 class="card-title">Add Product</h4>
                        <div class="card">
                            <div class="card-body">
                                {{-- <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"> --}}
                                    {{-- @csrf --}}
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter product name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept=".jpg, .jpeg, .png">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description"
                                            rows="4"></textarea>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    {{-- <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a> --}}
                                {{-- </form> --}}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection