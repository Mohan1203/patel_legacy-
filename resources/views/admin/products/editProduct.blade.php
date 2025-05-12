@extends('layout.layout')

@section("content")

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="">
                <div class="row">
                    <div class="col-12 ">
                        <div>
                            <h4 class="card-title">Edit Product</h4>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('handle.updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $product->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image"
                                                accept=".jpg, .jpeg, .png, .webp" onchange="previewImage(event)">
                                            <div class="mt-3">
                                                <img id="imagePreview" src="{{ asset(env('APP_URL').'/images'.  '/' . $product['image']) }}" alt="Product Image" class="img-fluid" style="max-width: 200px;">
                                            </div>
                                        </div>

                                        <script>
                                            function previewImage(event) {
                                                const reader = new FileReader();
                                                reader.onload = function() {
                                                    const output = document.getElementById('imagePreview');
                                                    output.src = reader.result;
                                                };
                                                reader.readAsDataURL(event.target.files[0]);
                                            }
                                        </script>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description"
                                                rows="4">{{ $product->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>

@endsection