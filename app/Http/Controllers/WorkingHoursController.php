<?php

namespace App\Http\Controllers;

use App\Models\WorkingHours;
use App\Models\User;
use Illuminate\Http\Request;


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
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $worktime = $user->worktime()->with('user')->get();
        return $worktime;
  
    }

    public function showAll()
    {
        //
        $worktime = WorkingHours::with('user')->paginate(20);
	    return $worktime;     
    }

 
    public function store(Request $request)
    {
        //
        $request->validate([
            'monday' => 'required|string',
            'tuesday' => 'required|string',
            'wednesday' => 'required|string',
            'thursday' => 'required|string',
            'friday' => 'required|string',
            'saturday' => 'required|string',
            'sunday' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        $worktime = new WorkingHours();
        $worktime->monday = $request->monday;
        $worktime->tuesday = $request->tuesday;
        $worktime->wednesday = $request->wednesday;
        $worktime->thursday = $request->thursday;
        $worktime->friday = $request->friday;
        $worktime->saturday = $request->saturday;
        $worktime->sunday = $request->sunday;
        $worktime->user_id = $request->user_id;       
    
        WorkingHours::create($request->all());
    }
   
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
 

    public function update(Request $request, $business_name_slug)
    {
        //
        $validator = $request->validate([
            'monday' => 'required|string',
            'tuesday' => 'required|string',
            'wednesday' => 'required|string',
            'thursday' => 'required|string',
            'friday' => 'required|string',
            'saturday' => 'required|string',
            'sunday' => 'required|string',
            'user_id' => 'required|string',
        ]);

        if($validator){
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $worktime = $user->worktime()->update([
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
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $worktime = $user->worktime()->get();
        return $worktime->delete();
    }
}



