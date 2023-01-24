<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

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
        $posts = Post::with('user', 'category')->orderBy('created_at', 'desc')->paginate(5);
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
            'title' => 'required|max:255',
            'slug' => 'required|min:5|max:255',
            'description' => 'required',
            //'body' => 'required',
            'category_id' => 'required|integer',
            'user_id' => 'required',
            //'image' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;

         /*
        if(preg_match('/^data:image\/(\w+);base64,/', $request->image)){
                $value = substr($request->image, strpos($request->image, ',') + 1);
                //$value = base64_decode($value);
                $filename = $request->slug. '.' .'png';
                $location = public_path('postimage/' . $filename);
                //using the intervention library we installed to save in laravel folder
                Image::make($value)->resize(800, 400)->save($location);
                //put image name in database so that we can use it to search the folder when we need it
                $post->image = $filename;
        }
        you must use $post->save() for the image name to be uploaded properly to database
        */
        $post->save();
        
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
        $post = Post::with('user', 'category')->where('slug', $slug)->get();
        return $post;
        
    }


    public function showByUsername($username)
    {
        //
        $user = User::where('name', $username)->first();
        $post = $user->posts()->with('user')->get();
        return $post;
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
