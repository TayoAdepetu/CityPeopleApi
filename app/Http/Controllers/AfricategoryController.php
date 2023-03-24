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
    
        Africategory::create($request->all());
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
