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
                                <form action="{{ route('handle.updateSetting',$socialIcon->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="social_name">Name</label>
                                        <input type="text" class="form-control" id="social_name" name="social_name" placeholder="Enter social name" required value={{$socialIcon->name}}>
                                    </div>
                                    <div class="form-group">
                                        <label for="social_link">Link</label>
                                        <input type="url" class="form-control" id="social_link" name="social_link"  placeholder="Enter social link" required value={{$socialIcon->url_link}}>
                                    </div>
                                    <div class="form-group">
                                        <label for="social_icon">Icon</label>
                                        <input type="file" class="form-control" id="social_icon" name="social_icon" value={{$socialIcon->icon}} onchange="previewImage(event)">
                                        <div class="mt-3">
                                            <img id="imagePreview" src="{{ asset(env('APP_URL').  '/' . $socialIcon['icon']) }}" alt="Product Image" class="img-fluid" style="max-width: 200px;">
                                        </div>
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