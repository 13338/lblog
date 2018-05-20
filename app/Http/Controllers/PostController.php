<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (request()->sort) {
            case 'myorder':
                $posts = Post::orderBy('sortable');
                break;
            
            default:
                $posts = Post::orderBy('name');
                break;
        }
        $posts = $posts->paginate(10);
        return view ('post.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $categoties = Category::all();
        if (count($categoties) == 0)
            // redirect if categories not exist
            return redirect()->route('category.create');
        else
            // create view if categories exist
            return view('post.create', compact(['categoties']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $request->merge(['sortable' => Post::all()->max('sortable') + 1]);
        $id = Post::create($request->all());
        return redirect()->route('post.show', ['post' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view ('post.show', compact(['post']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('post.edit', compact(['categories', 'post']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->fill($request->all())->save();
        return redirect()->route('post.show', ['post' => $post->id]);
    }

    /**
     * Update the sortable position resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function sortable(Request $request, Post $post)
    {
        $this->authorize('sortable', Post::class);
        if ($post->sortable > (int)$request->sortable) {
            Post::whereBetween('sortable', [$request->sortable, $post->sortable - 1])->increment('sortable', 1);
        } else {
            Post::whereBetween('sortable', [$post->sortable + 1, $request->sortable])->decrement('sortable', 1);
        }
        $post->fill($request->all())->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('post.index');
    }
}
