@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mb-4">
      <form class="input-group input-group-lg" action="{{ route('post.search') }}">
        <input class="form-control" type="search" id="searchinput" placeholder="Search" aria-label="Search" name="q" value="{{ Request::get('q') }}">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
        {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> --}}
      </form>
    </div>
    <div class="col-md-8 mb-0">
      <h3>
        Search result
        <form action="{{ Request::fullUrl() }}" class="float-right">
          <input type="hidden" name="q" value="{{ Request::get('q') }}" />
          <div class="form-group">
            <select class="form-control form-control-sm" name="sort" onchange="this.form.submit()">
              <option value="name">Name</option>
              <option value="myorder" {{ (Request::get('sort') == 'myorder') ? ' selected' : '' }}>My order</option>
            </select>
          </div>
        </form>
      </h3>
    </div>
  </div>
  <div class="row justify-content-center" id="search">
    @forelse ($posts as $post)
    <div class="col-md-8 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
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
    @empty
      <p class="lead">No result :(</p>
    @endforelse

  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      {{ $posts->appends($_GET)->links() }}
    </div>
  </div>
</div>
@endsection
