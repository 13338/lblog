@extends('layouts.app')

@section('title', 'Edit post')

@section('content')
<div class="container">
  <h1>
    Edit post
  </h1>
  <hr>
  <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
      <label for="name">Title</label>
      <input type="text" class="form-control" name="name" id="name" value="{{ $post->name }}">
    </div>
    <div class="form-group">
      <label for="category_id">Category</label>
      <select class="form-control" name="category_id" id="category_id">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}"{{($post->category_id == $category->id) ? " selected" : ""}}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="content">Description</label>
      <textarea class="form-control" rows="3" id="content" name="content">{{ $post->content }}</textarea>
    </div>
    <button type="submit" class="btn btn-success mb-3">Update</button>
  </form>
</div>
@endsection