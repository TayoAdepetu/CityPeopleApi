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


    public function showbiz($businessname)
    {
        //
        if(exist(Bizdirectory::where('business_name', $businessname))){
            $product = Bizdirectory::where('product_name', $businessname)->get();
            return $product;
        }else {
            return('Biz not found.');
        }
    }

    public function update($slug)
    {
        //
        $biz = Bizdirectory::where('slug', $slug)->update([
            'business_name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'location' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'website' => 'required',
            'established' => 'required',
            'registered_here' => 'required',
            'number_of_employees' => 'required',
        ]);

        return $biz;
    }

    public function destroy($businessname)
    {
        //
        $biz = Bizdirectory::where('business_name', $businessname)->get();
        return $biz->delete();
    }
}
