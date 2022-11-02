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
        $secrets = Secret::all();
	    return $secrets;
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);

        $secret = new Secret();
        $secret->title = $request->title;
        $secret->slug = $request->slug;
        $secret->description = $request->description;       
    
        Secret::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        //if(exist(Secret::where('slug', $slug))){
            $secret = Secret::where('slug', $slug)->get();
            return $secret;
       // }else {
          //  return('Secret not found.');
       // }
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
    public function update($slug)
    {
        //
        $secret = Secret::where('slug', $slug)->update([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);

        return $secret;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secret  $secret
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $secret = Secret::where('slug', $slug)->get();
        return $secret->delete();
    }
}
