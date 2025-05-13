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
                                @if (session('error'))
                                <div class="alert alert-danger py-2">
                                    {{ session('error') }}
                                </div>
                                @endif
                                
                                @if (session('success'))
                                <div class="alert alert-success py-2">
                                    {{ session('success') }}
                                </div>
                                @endif
                                
                                @if ($errors->any())
                                <div class="alert alert-danger py-2">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form action="{{ route('handle.addBlog') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug">
                                    </div>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Select Category</label>
                                        <select class="form-select" id="category" name="category" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Content</label>
                                        <textarea id="editor" name="content">{{ old('content') }}</textarea>
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
                                <th>Blog Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">
                            @foreach ($blogs as $key => $blog)
                                <tr data-id="{{ $blog['id'] }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $blog['title'] }}</td>
                                    <td>
                                        <a href="/editBlog/{{ $blog['id'] }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('handle.deleteBlog', $blog['id']) }}" method="POST"
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

    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            height: 600,
            menubar: false,
            menubar: 'file edit view insert format tools table help',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code image help wordcount imagetools link',
            toolbar: 'undo redo | formatselect | bold italic backcolor | \
                      alignleft aligncenter alignright alignjustify | \
                      bullist numlist outdent indent | removeformat | image | help ',
                      block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
            image_dimensions: true,
            image_advtab: true,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            document_base_url: 'config("app.url")/',
            content_css: '{{ asset('css/app.css') }}',
            images_upload_handler: function(blobInfo, progress) {
            return new Promise((resolve, reject) => {
            let xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('blogs.upload-image') }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onload = function() {
                let json;
                if (xhr.status !== 200) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }
                
                json = JSON.parse(xhr.responseText);
                
                if (!json || typeof json.location != 'string') {
                    reject('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                const fullUrl = '{{ config("app.url") }}' + json.location;
                resolve(json.location);
            };
            
            xhr.onerror = function() {
                reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };
            
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            console.log(formData);
            xhr.send(formData);
        });
    }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');

            titleInput.addEventListener('input', function() {
                const titleValue = titleInput.value;
                const slugValue = titleValue
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                    .replace(/^-|-$/g, ''); // Remove leading and trailing hyphens
                slugInput.value = slugValue;
            });
        });
    </script>

    
@endsection