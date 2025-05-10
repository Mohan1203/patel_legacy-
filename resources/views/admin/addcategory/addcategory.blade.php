@extends('layout.layout')

@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-title">Add Category</h4>
                        <div class="card">
                            <div class="card-body">
                                {{-- <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"> --}}
                                    {{-- @csrf --}}
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter category name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description"
                                            rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    {{-- <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a> --}}
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
