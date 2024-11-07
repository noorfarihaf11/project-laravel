@extends("layouts.main")

@include('layouts.header')

@section('content')

<div class="page-heading">
    <h3 > My Posts </h3>
</div>

@if(session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session ('success')}}
</div>
@endif
<section class="row">
    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="table-responsive">
                <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a>
                <table class="table table-striped col-lg-8">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $post->title }}</td>
                          <td>{{ $post->category->name}}</td>
                          <td>
                            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></a>
                            <a href="/dashboard/posts/{{ $post->slug}}/edit" class="badge bg-warning"><i class="bi bi-pencil"></i></a>
                            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                              @method('delete')
                              @csrf
                              <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Are you sure to delete this post?')">
                                  <i class="bi bi-x-circle"></i>
                              </button>
                          </form>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
              </div>
        </div>
    </div>
</section>
</div>
@endsection
