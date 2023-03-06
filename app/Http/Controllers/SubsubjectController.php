<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subsubject;
use Illuminate\Support\Facades\Mail;
use App\Mail\Report;
use App\Mail\SubjectReport;

use DB;


class SubsubjectController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $request->validate([
            'subsubject_name' => 'required|string',
            'body' => 'required|string',
            'subject_name' => 'required|string',
            //'image' => 'required',
            'user_id' => 'required|integer',
            'slug' => 'required|string',
            'description' => 'required|string',

        ]);

        $subsubject = new Subsubject();
        $subsubject->subsubject_name = $request->subsubject_name;  
        $subsubject->subject_name = $request->subject_name;   
       // $subsubject->image = $request->image;   
        $subsubject->user_id = $request->user_id;   
        $subsubject->slug = $request->slug;   
        $subsubject->description = $request->description;   
        $subsubject->body = $request->body;
    
        Subsubject::create($request->all());
    }

    public function index(Request $request, $subject_name)
    {
        //
        $subsubject = Subsubject::where('subject_name', $subject_name);
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
        $validator = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
           // 'category_id' => 'required|integer',
        ]);

        if(!$validator->fails()){
        $subsubject = Subsubject::where('id', $id)->update([
            'subsubject_name' => $request->subsubject_name,
            'slug'=> $request->slug,
            'description' => $request->description,
            'body' => $request->body,
        ]);

        return $subsubject;
    }
    }

    public function reportSubject(Request $request)
    {
        try {
            $email = $request->email;
            $subject_name = $request->subject_name;
            $comment = $request->content_comment;

            Mail::to($email)->send(new SubjectReport($subject_name, $comment));

            return response()->json([
                'success' => true,
                'data' => ['message' => 'A mail, cocntaining your comments, has been sent to the admin. Thanks for your support.']
            ]);

        } catch (\Exception $error) {
            throw $error;


        }
    }


    public function reportSubsubject(Request $request)
    {
        try {
            $email = $request->email;
            $subject_name = $request->subject_name;
            $subsubject_name = $request->subsubject_name;
            $comment = $request->content_comment . '(Subsubject_name: )' . $subsubject_name;

            Mail::to($email)->send(new Report($subject_name, $comment));

            return response()->json([
                'success' => true,
                'data' => ['message' => 'A mail, cocntaining your comments, has been sent to the admin. Thanks for your support.']
            ]);

        } catch (\Exception $error) {
            throw $error;


        }
    }

    public function destroy(Request $request, $id)
    {
        //
        $subsubject = Subsubject::where('id', $id)->get();
        return $subsubject->delete();

    }
}
