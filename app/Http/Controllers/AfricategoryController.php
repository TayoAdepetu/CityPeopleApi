<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Africategory;


class AfricategoryController extends Controller
{
    //save new image category
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'unique:africategories', 'min:2', 'max:255'],
        ]);

        $category = new Africategory();
        $category->name = $request->name;

         function generateKey(Request $request)
                {
                    $str = "12356890abcefghjklnopqrsuvwxyz()/$";
                    $randStr = substr(str_shuffle($str), 0);
                    if (Africategory::where('name_slug', $request->name_slug . '-'.$randStr)->exists()) {
                        $randStr = substr(str_shuffle($str), 0);
                    }

                    return $randStr;
                }
        $category->name_slug = $request->name_slug . '-'.generateKey();    
    
        $category->save();
    }

    public function index()
    {
        //
        $category = Africategory::all();
	    return $category;
      
    }

    public function update(Request $request, $id)
    {
        //
        $validator = $request->validate([
            'name' => ['required', 'string', 'unique:africategories', 'min:2', 'max:255'],
        ]);

        if($validator){
        $category = Africategory::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return $category;
    }

    }


    public function destroy($id)
    {
        //
        $category = Africategory::where('id', $id)->get();
        return $category->delete();

    }
}
