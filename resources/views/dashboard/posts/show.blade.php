@extends("layouts.main")

@include('layouts.header')

@section('content')
    
  
    <article class="py-8 max-w-screen-md"> <!-- Menambahkan margin-bottom -->
     
      <h2 class ="mb-1 text-3xl tracking-tight font-bold text-gray-900"> {{ $post->title }} </h2>
      <div>
        <a href="/dashboard/posts" class="btn btn-success">
            <i class="bi bi-backspace"></i>
            <span>Back to all my posts</span>
        </a>
        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning">
            <i class="bi bi-pencil"></i>
            <span>Edit</span>
        </a>
        <a href="" class="btn btn-danger">
            <i class="bi bi-x-circle"></i>
            <span>Delete</span>
        </a>
      </div>
  
      <div class="mt-4 text-base text-gray-700">
        {{ Str::limit(strip_tags($post->body), 150) }}
      </div>

      @if( $post->image)
      <div style="max-height: 450px; max-width: 600;  overflow:hidden;">
      <img src="{{ asset('storage/'. $post->image)}}" alt="
      {{ $post->category->name }}" class="img-fluid mt-3">
      @endif

      </article>

    
</section>
</div>
@endsection
