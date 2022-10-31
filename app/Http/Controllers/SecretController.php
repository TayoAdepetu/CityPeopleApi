<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use App\Http\Requests\StoreSecretRequest;
use App\Http\Requests\UpdateSecretRequest;

class SecretController extends Controller
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
     * @param  \App\Http\Requests\StoreSecretRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSecretRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function show(Secret $secret)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function edit(Secret $secret)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSecretRequest  $request
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSecretRequest $request, Secret $secret)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secret $secret)
    {
        //
    }
}
