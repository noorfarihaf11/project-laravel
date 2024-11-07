@extends("layouts.main")

@include('layouts.header')

@section('content')

<div class="page-heading">
    <h3 > Post Categories </h3>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-6" role="alert">
  {{ session ('success')}}
</div>
@endif
<section class="row">

    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="table-responsive col-lg-12">
                <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Create new Category</a>
                <table class="table table-striped col-lg-8">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Color</th>
                        <th scope="col">Create Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $category->name }}</td>
                          <td>{{ $category->color }}</td>
                          <td>{{ $category->created_at }}</td>
                          <td>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
              </div>
        </div>
</section>
</div>
@endsection
