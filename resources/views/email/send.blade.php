@extends('layouts.main')

@include('layouts.header')

@section('content')
<div class="page-heading">
    <h3>Create New Post</h3>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                   name="title" required autofocus value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                   value="{{ old('slug') }}">
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="id_category">
                @foreach($categories as $category)
                    @if(old('id_category') == $category->id_category)
                        <option value="{{ $category->id_category }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Post Image</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                   name="image" onchange="previewImage()">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            @error('body')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function () {
            if (title.value.trim() !== '') { // Make sure input is not empty
                fetch('/dashboard/post/checkSlug?title=' + encodeURIComponent(title.value))
                .then(response => {
                    return response.json();
                })
                    .then(data => slug.value = data.slug);
            }
        });

        document.addEventListener('trix-file-accept', function (e) {
            e.preventDefault();
        });

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

</script>
@endsection
