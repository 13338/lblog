@extends('layouts.app')

@section('title', 'Edit category')

@section('content')
<div class="container">
  <h1>Edit category</h1>
  <hr>
  <form action="{{ route('category.update', ['category' => $category->id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
      <label for="name">Title</label>
      <input type="text" class="form-control" id="name" placeholder="Title" name="name" value="{{ $category->name }}">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" rows="3" id="description" name="description">{{ $category->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection