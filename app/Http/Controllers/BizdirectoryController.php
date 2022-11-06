<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bizdirectory;

class BizdirectoryController extends Controller
{
    //
    public function index()
    {
        //
       $bizdirectories = Bizdirectory::all();
	   return $bizdirectories;
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'business_name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'location' => 'required',
            'user_id' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'website' => 'required',
            'established' => 'required',
            'registered_here' => 'required',
            'number_of_employees' => 'required',
        ]);

        $biz = new Bizdirectory();
        $biz->business_name = $request->business_name;
        $biz->location = $request->location;
        $biz->slug = $request->slug;
        $biz->phone = $request->phone;
        $biz->description = $request->description;
        $biz->website = $request->website;
        $biz->established = $request->established;
        $biz->registered_here = $request->registere_here;
        $biz->number_of_employees = $request->number_of_employees;
        $biz->user_id = $request->user_id;        
    
        Bizdirectory::create($request->all());
    }


    public function showbiz($slug)
    {
        //
       // if(exist(Bizdirectory::where('slug', $slug))){
            $biz = Bizdirectory::where('slug', $slug)->get();
            return $biz;
       // }else {
        //    return('Biz not found.');
       // }
    }

    public function update(Request $request, $slug)
    {
        //
        $biz = Bizdirectory::where('slug', $slug)->update([
            'business_name' => $request->business_name,
            'slug' => $request->slug,
            'description' => $request->description,
            'location' => $request->location,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'established' => $request->established,
            'registered_here' => $request->registered_here,
            'number_of_employees' => $request->number_of_employees,
        ]);

        return $biz;
    }

    public function destroy($slug)
    {
        //
        $biz = Bizdirectory::where('slug', $slug)->get();
        return $biz->delete();
    }
}
