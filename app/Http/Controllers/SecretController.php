<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use Illuminate\Http\Request;


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
        $secrets = Secret::all()->paginate(20);
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
            'description' => 'required',
        ]);

        
        function generateKey(){
            $str = "12356890abcefghjklnopqrsuvwxyz()/$";
            $randStr = substr(str_shuffle($str), 0);
            while(exist(Bizdirectoryproducts::where('product_name_slug', $randStr))){
                $randStr = substr(str_shuffle($str), 0);
            }

                return $randStr;
            }

        $secret = new Secret();
        $secret->title = $request->title;
        $secret->slug = generateKey();
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
    public function update(Request $request, $slug)
    {
        //
        $secret = Secret::where('slug', $slug)->update([
            'title' => $request->title,
            'description' => $request->description,
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
