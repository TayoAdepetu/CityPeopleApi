<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Image;
use Illuminate\Support\Facades\Validator;


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

    public function indexMore()
    {
        //
        $posts = Post::with('user', 'category')->orderBy('created_at', 'desc')->paginate(20);
	    return $posts;
      
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
            'title' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string',
            'body' => 'required|string',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            //'image' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;

        
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
        
        $post->save();
        
        }

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

    public function update(Request $request, $slug)
    {
        //
        $validator = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string',
            'body' => 'required|string',
           // 'category_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return false;

    }else{
        $post = Post::where('slug', $slug)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'body' => $request->body,
        ]);

        return $post;
    }
    }

    public function destroy($slug)
    {
        //
        $post = Post::where('slug', $slug)->get();
        return $post->delete();
    }
}
