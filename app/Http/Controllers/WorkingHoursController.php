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
    public function index()
    {
        //
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
    public function store(StoreWorkingHoursRequest $request)
    {
        //
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
    public function update(UpdateWorkingHoursRequest $request, WorkingHours $workingHours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkingHours  $workingHours
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingHours $workingHours)
    {
        //
    }
}
