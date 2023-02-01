<?php

namespace App\Http\Controllers;

use App\Models\Jobsdirectory;
use Illuminate\Http\Request;


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
        $jobs = Jobsdirectory::with('user')->paginate(5);
	    return $jobs;
    }

    public function indexMore()
    {
        //
        $jobs = Jobsdirectory::with('user')->paginate(20);
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
            'job_slug' => 'required',
            'location' => 'required',
            'function' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'salary' => 'required',
        ]);

        function generateKey(){
            $str = "12356890abcefghjklnopqrsuvwxyz()/$";
            $randStr = substr(str_shuffle($str), 0);
            while(exist(Jobsdirectory::where('job_slug', $randStr))){
                $randStr = substr(str_shuffle($str), 0);
            }

                return $randStr;
            }

        $job = new Jobsdirectory();
        $job->title = $request->title;
        $job->job_slug = generateKey();
        $job->salary = $request->salary;
        $job->location = $request->location;
        $job->function = $request->function;
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
    public function show($business_name_slug)
    {
        //
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $job = $user->jobs()->with('user')->get();
        return $job;
       
    }

    public function showByJobSlug($job_slug)
    {
        //
        $job = Jobsdirectory::with('user')->where('job_slug', $job_slug)->get();
        return $job;
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
    public function update(Request $request, $job_slug)
    {
        //
        $job = Jobsdirectory::where('job_slug', $job_slug)->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'function' => $request->function,
            'salary' => $request->salary,
        ]);

        return $job;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jobsdirectory  $jobsdirectory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $job = Post::where('id', $id)->get();
        return $job->delete();
    }
}
