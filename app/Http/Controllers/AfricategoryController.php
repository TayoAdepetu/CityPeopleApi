<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfricategoryController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
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

        $category = Africategory::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return $category;
    }


    public function destroy($id)
    {
        //
        $category = Africategory::where('id', $id)->get();
        return $category->delete();

    }
}
