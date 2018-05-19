@extends('layouts.app')

@section('title', 'Create category')

@section('content')
<div class="container">
  <h1>Create category</h1>
  <hr>
  <form action="{{ route('category.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="name">Title</label>
      <input type="text" class="form-control" id="name" placeholder="Title" name="name">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" rows="3" id="description" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
  </form>
</div>
@endsection