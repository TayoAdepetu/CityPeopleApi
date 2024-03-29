<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:categories', 'min:2', 'max:255'],
            'name_slug'=> 'required|string',
        ]);

        function generateKey(Request $request)
                {
                    $str = "12356890abcefghjklnopqrsuvwxyz()/$";
                    $randStr = substr(str_shuffle($str), 0);
                    if (Category::where('name_slug', $request->name_slug.'-'.$randStr)->exists()) {
                        $randStr = substr(str_shuffle($str), 0);
                    }

                    return $randStr;
                }

        if($validator->fails()){

        } else{
            $category = new Category();
            $category->name = $request->name; 
            $category->name_slug = $request->name_slug.'-'.generateKey();      
    
            Category::create($request->all());
        }
        
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:categories', 'min:2', 'max:255'],
        ]);

        if($validator->fails()){

        } else{
            $category = Category::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return $category;
        }
        
    }

    public function destroy($id)
    {
        //
        $category = Category::where('id', $id)->get();
        return $category->delete();

    }
}
