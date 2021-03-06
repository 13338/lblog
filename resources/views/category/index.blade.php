@extends('layouts.app')

@section('title', 'List of categories')

@section('content')
<div class="container">
  <h1 class="mb-4">
    List of categories
  </h1>
  <div class="row">
    @foreach ($categories as $category)
    <div class="col-md-6 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $category->name }}</h5>
          <p class="card-text">{{ $category->description }}</p>
          <a href="{{ route('category.show', ['category' => $category->id]) }}" class="btn btn-primary">Show posts</a>
          @can('update', $category)
          <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-warning">Edit</a>
          @endcan
          @can('delete', $category)
          <a onclick="destroy(this);" data-url="{{ route('category.destroy', ['category' => $category->id]) }}" class="btn btn-danger">Delete</a>
          @endcan
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="row justify-content-center">
    {{ $categories->links() }}
  </div>
</div>
@endsection
