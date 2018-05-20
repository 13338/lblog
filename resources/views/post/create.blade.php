@extends('layouts.app')

@section('title', 'Create post')

@section('content')
<div class="container">
  <h1>
    Create post
  </h1>
  <hr>
  <form action="{{ route('post.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="name">Title</label>
      <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group">
      <label for="category_id">Category</label>
      <select class="form-control" name="category_id" id="category_id">
        @foreach ($categoties as $category)
          <option value="{{ $category->id }}"{{(Request::get('id') == $category->id) ? " selected" : ""}}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="content">Description</label>
      <textarea class="form-control" rows="3" id="content" name="content"></textarea>
    </div>
    <button type="submit" class="btn btn-success mb-3">Create</button>
  </form>
</div>
@endsection