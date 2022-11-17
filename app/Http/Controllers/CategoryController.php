<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Post();
        $category->name = $request->name;      
    
        Category::create($request->all());
    }

    public function index()
    {
        //
        $category = Category::all();
	    return $category;
      
    }

    public function update(Request $request, $id)
    {
        //

        $category = Category::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return $category;
    }


    public function destroy($id)
    {
        //
        $category = Category::where('id', $id)->get();
        return $category->delete();

    }
}
