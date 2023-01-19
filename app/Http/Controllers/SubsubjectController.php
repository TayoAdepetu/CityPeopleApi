<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subsubject;

class SubsubjectController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $request->validate([
            'subsubject_name' => 'required',
            'body' => 'required',
            'subject_id' => 'required',
            //'image' => 'required',
            'user_id' => 'required',
            'slug' => 'required',
            'description' => 'required',

        ]);

        $subsubject = new Subsubject();
        $subsubject->subsubject_name = $request->subsubject_name;  
        $subject->subject_name = $request->subject_name;   
       // $subsubject->image = $request->image;   
        $subsubject->user_id = $request->user_id;   
        $subsubject->slug = $request->slug;   
        $subsubject->description = $request->description;   
        $subsubject->body = $request->body;
    
        Subsubject::create($request->all());
    }

    public function index(Request $request, $slug)
    {
        //
        $subsubject = Subsubject::where('subject_name', $slug);
	    return $subsubject;
      
    }

     public function fetchById(Request $request, $id)
    {
        $subsubject = Subsubject::where('id', $id)->get();
        return $subsubject;
    }

    public function update(Request $request, $id)
    {
        //

        $subsubject = Subsubject::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return $subsubject;
    }


    public function destroy($id)
    {
        //
        $subsubject = Subsubject::where('id', $id)->get();
        return $subsubject->delete();

    }
}
