<?php

namespace App\Http\Controllers;

use App\Models\WorkingHours;
use App\Http\Requests\StoreWorkingHoursRequest;
use App\Http\Requests\UpdateWorkingHoursRequest;

class WorkingHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($businessname)
    {
        //
        if(exist(WorkingHours::where('business_name', $businessname))){
            $worktime = WorkingHours::where('business_name', $businessname)->get();
            return $worktime;
        }else {
            return('Faq not found.');
        }
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
     * @param  \App\Http\Requests\StoreWorkingHoursRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'business_name' => 'required',
            'slug' => 'required',
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
            'sunday' => 'required',
            'user_id' => 'required',
        ]);

        $worktime = new WorkingHours();
        $worktime->business_name = $request->business_name;
        $worktime->monday = $request->monday;
        $worktime->slug = $request->slug;
        $worktime->tuesday = $request->tuesday;
        $worktime->wednesday = $request->wednesday;
        $worktime->thursday = $request->thursday;
        $worktime->friday = $request->friday;
        $worktime->saturday = $request->saturday;
        $worktime->sunday = $request->sunday;
        $worktime->user_id = $request->user_id;        
    
        WorkingHours::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkingHours  $workingHours
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingHours $workingHours)
    {
        //
        if(exist(WorkingHours::where('slug', $slug))){
            $worktime = WorkingHours::where('slug', $slug)->get();
            return $worktime;
        }else {
            return('Working hours not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkingHours  $workingHours
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkingHours $workingHours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkingHoursRequest  $request
     * @param  \App\Models\WorkingHours  $workingHours
     * @return \Illuminate\Http\Response
     */
    public function update($slug)
    {
        //
        $worktime = WorkingHours::where('slug', $slug)->update([
            'business_name' => 'required',
            'slug' => 'required',
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
            'sunday' => 'required',
        ]);

        return $worktime;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkingHours  $workingHours
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $worktime = WorkingHours::where('slug', $slug)->get();
        return $worktime->delete();
    }
}



