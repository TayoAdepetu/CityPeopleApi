<?php

namespace App\Http\Controllers;

use App\Models\Jobsdirectory;
use App\Http\Requests\StoreJobsdirectoryRequest;
use App\Http\Requests\UpdateJobsdirectoryRequest;

class JobsdirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jobs = Jobsdirectory::all();
	    return $jobs;
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
     * @param  \App\Http\Requests\StoreJobsdirectoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'location' => 'required',
            'function' => 'required',
            'employer' => 'required',
            'user_id' => 'required',
            'salary' => 'required',
        ]);

        $job = new Jobsdirectory();
        $job->title = $request->title;
        $job->body = $request->body;
        $job->slug = $request->slug;
        $job->description = $request->description;
        $job->user_id = $request->user_id;        
    
        Jobsdirectory::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jobsdirectory  $jobsdirectory
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //

       // if(exist(Jobsdirectory::where('slug', $slug))){
            $job = Jobsdirectory::where('slug', $slug)->get();
            return $job;
        //}else {
       //     return('Job not found.');
        //}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jobsdirectory  $jobsdirectory
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobsdirectory $jobsdirectory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobsdirectoryRequest  $request
     * @param  \App\Models\Jobsdirectory  $jobsdirectory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $job = Jobsdirectory::where('slug', $slug)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'body' => $request->body,
        ]);

        return $job;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jobsdirectory  $jobsdirectory
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $job = Post::where('slug', $slug)->get();
        return $job->delete();
    }
}
