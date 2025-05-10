@extends('layout.layout')

@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-title">Add Blog</h4>
                        <div class="card">
                            <div class="card-body">
                                {{-- <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data"> --}}
                                    {{-- @csrf --}}
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description"
                                            rows="4"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept=".jpg, .jpeg, .png">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    {{-- <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back</a> --}}
                                {{-- </form> --}}
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>  
    </div>
@endsection