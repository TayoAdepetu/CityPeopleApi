<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::with('user')->get();
	    return $posts;
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->category_id = Category::find($request->category_id)->pluck('id');        
        $post->user_id = $request->user_id;        
    
        Post::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        if(exist(Post::where('slug', $slug))){
            $post = Post::where('slug', $slug)->get();
            return $post;
        }else {
            return('Post not found.');
        }
        
    }


    public function showByUsername($username)
    {
        //
        if(exist(Post::where('name', $username))){
            $post = Post::where('name', $username)->get();
            return $post;
        }else {
            return('Post not found.');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //$post = Post::findOrFail($slug);       
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //

        $post = Post::where('slug', $slug)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'author' => $request->author,
            'description' => $request->description,
            'body' => $request->body,
        ]);

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $post = Post::where('slug', $slug)->get();
        return $post->delete();

    }
}
