@extends('layout.layout')

@section("content")
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-title">Settings</h4>
                        <div class="card">
                            <div class="card-body">
                                {{-- <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data"> --}}
                                    {{-- @csrf --}}
                                    {{-- @method('PUT') --}}
                                    <div class="mb-3">
                                        <label for="site_name" class="form-label">Site Name</label>
                                        <input type="text" class="form-control" id="site_name" name="site_name"
                                            placeholder="Enter site name"  required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="site_description" class="form-label">Site Description</label>
                                        <textarea class="form-control" id="site_description" name="site_description"
                                            rows="4"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control" id="logo" name="logo"
                                            accept=".jpg, .jpeg, .png">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection