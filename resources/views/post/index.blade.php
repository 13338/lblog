@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mb-4">
      <h1>
        All posts 
        <form action="{{ url()->current() }}" class="float-right">
          <div class="form-group">
            <select class="form-control form-control-sm" name="sort" onchange="this.form.submit()">
              <option value="name">Name</option>
              <option value="myorder" {{ (Request::get('sort') == 'myorder') ? ' selected' : '' }}>My order</option>
            </select>
          </div>
        </form>
      </h1>
    </div>
  </div>
  <div class="row justify-content-center" id="sortable">
    @foreach ($posts as $post)
    <div class="col-md-8 mb-4" data-sortable="{{ $post->id }}" data-page="{{ ((Request::get('page') ?: 1) - 1)*($posts->perPage()) }}">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          @can('create', App\Post::class)
          @if (Request::get('sort') == 'myorder')
          <span class="drag-handle mr-2">&#9776;</span>
          @endif
          @endcan
          <a href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->name }}</a>
        </h5>
        {{ $post->content }}
      </div>
      <div class="card-footer text-muted">
        <a href="{{ route('post.show', ['post' => $post->id]) }}" class="btn btn-sm btn-primary">Show</a>
        @can('update', $post)
        <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="btn btn-sm btn-warning">Edit</a>
        @endcan
        @can('delete', $post)
        <a onclick="destroy(this);" data-url="{{ route('post.destroy', ['post' => $post->id]) }}" class="btn btn-sm btn-danger text-white">Delete</a>
        @endcan
        <span class="text-success saved ml-3"></span>
        <span class="text-danger fail ml-3"></span>
        <span class="float-right"{!! (!empty($post->updated_at)) ? ' title="Last update '.$post->updated_at.'"' : '' !!}>
          {{ $post->created_at }}
        </span>
      </div>
    </div>
    </div>
    @endforeach

  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      {{ $posts->appends($_GET)->links() }}
    </div>
  </div>
</div>
@endsection
