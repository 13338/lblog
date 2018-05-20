@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mb-4">
      <h1>
        Category: {{ $category->name }}
      </h1>
      <p>{{ $category->description }}</p>
    </div>
    @foreach ($category->posts() as $post)
    <div class="col-md-8 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><a href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->name }}</a></h5>
        {{ $post->content }}
      </div>
      <div class="card-footer text-muted">
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
      {{ $category->posts()->links() }}
    </div>
  </div>
</div>
@endsection