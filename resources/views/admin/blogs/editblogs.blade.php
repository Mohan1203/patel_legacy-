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
                                <form action="{{ route('handle.updateBlog',$blog->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter title" required  value="{{ $blog->title }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="coverImage"
                                            accept=".jpg, .jpeg, .png, .webp" onchange="previewImage(event)">
                                        <div class="mt-3">
                                            <img id="imagePreview" src="{{ asset(env('APP_URL').  '/' . $blog['cover_image']) }}" alt="Product Image" class="img-fluid" style="max-width: 200px;">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Content</label>
                                        <textarea id="editor" name="content">{{ $blog->content }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>  
                    </div>
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
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
    
@endsection