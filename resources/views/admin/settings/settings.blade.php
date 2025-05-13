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
                                <form action="{{ route('handle.addSetting') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="social_name">Name</label>
                                        <input type="text" class="form-control" id="social_name" name="social_name" placeholder="Enter social name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="social_link">Link</label>
                                        <input type="url" class="form-control" id="social_link" name="social_link"  placeholder="Enter social link" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="social_icon">Icon</label>
                                        <input type="file" class="form-control" id="social_icon" name="social_icon" >
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">

                            @foreach ($socialIcons as $key => $icon)
                                <tr data-id="{{ $icon['id'] }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $icon['name'] }}</td>
                                    <td>
                                        <img src="{{ asset(env('APP_URL'). '/' . $icon['icon']) }}" width="50"
                                            height="50" alt="Social Image">
                                    </td>
                                    <td>
                                        <a href="/editSetting/{{ $icon['id'] }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('handle.deleteSetting', $icon['id']) }}" method="POST"
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