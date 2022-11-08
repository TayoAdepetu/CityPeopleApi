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
    public function index($business_name_slug)
    {
        //
        if(exist(WorkingHours::where('business_name_slug', $business_name_slug))){
            $worktime = WorkingHours::where('business_name_slug', $business_name_slug)->get();
            return $worktime;
        }else {
            return('Faq not found.');
        }
    }

    public function showAll()
    {
        //
        $worktime = WorkingHours::all();
	    return $worktime;
      
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
            'business_name_slug' => 'required',
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
        $worktime->business_name_slug = $request->business_name_slug;
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

     /*
    public function show($businessname)
    {
        //
        if(exist(WorkingHours::where('business_name', $businessname))){
            $worktime = WorkingHours::where('business_name', $businessname)->get();
            return $worktime;
        }else {
            return('Working hours not found.');
        }
    }

    */

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
    public function update(Request $request, $business_name_slug)
    {
        //
        $worktime = WorkingHours::where('business_name_slug', $business_name_slug)->update([
            'monday' => $request->monday,
            'tuesday' => $request->tuesday,
            'wednesday' => $request->wednesday,
            'thursday' => $request->thursday,
            'friday' => $request->friday,
            'saturday' => $request->saturday,
            'sunday' => $request->sunday,
        ]);

        return $worktime;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkingHours  $workingHours
     * @return \Illuminate\Http\Response
     */
    public function destroy($business_name_slug)
    {
        //
        $worktime = WorkingHours::where('business_name_slug', $business_name-slug)->get();
        return $worktime->delete();
    }
}



