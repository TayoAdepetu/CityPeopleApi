<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bizdirectory;
use App\Models\Bizdirectoryproducts;
use App\Models\User;


class BizdirectoryController extends Controller
{
    //
    public function index()
    {
        //
       $bizdirectories = Bizdirectory::with('user')->paginate(5);
	   return $bizdirectories;
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'description' => 'required',
            'location' => 'required',
            'website' => 'required',
            'established' => 'required',
            'number_of_employees' => 'required',
        ]);

        $biz = new Bizdirectory();
        $biz->location = $request->location;
        $biz->description = $request->description;
        $biz->website = $request->website;
        $biz->established = $request->established;
        //$biz->registered_here = $request->registered_here;
        $biz->number_of_employees = $request->number_of_employees;
        $biz->user_id = $request->user_id;
    
        Bizdirectory::create($request->all());
    }


    public function showbiz($business_name_slug)
    {
        //
       // if(exist(Bizdirectory::where('slug', $slug))){
        //$biz = User::findorfail($business_name_slug)->bizdirectory()->first()->get();
        //$user = User::where('business_name_slug', $business_name_slug)->first();
        //        $biz = Bizdirectory::with('user')->where('business_name_slug', $business_name_slug)->first();
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $biz = $user->bizdirectory()->with('user')->first();
        return $biz;
            //$biz = Bizdirectory::where('business_name_slug', $business_name_slug)->get();
            //return $biz;
       // }else {
        //    return('Biz not found.');
       // }
    }

    public function update(Request $request, $business_name_slug)
    {
        //
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $biz = $user->bizdirectory()->update([
            'description' => $request->description,
            'location' => $request->location,
            'website' => $request->website,
            'established' => $request->established,
            'number_of_employees' => $request->number_of_employees,
        ]);

        return $biz;
    }

    public function destroy($business_name_slug)
    {
        //
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $biz = $user->bizdirectory()->get();
        return $biz->delete();
    }

    /*
    public function searchAll(Request $request, $keyword){
        $searchResult = User::where('name', 'Like', '%'. $request->keyword . '%')
        ->orWhere('business_name', 'Like', '%' . $request->keyword . '%')

        
        if($request->item == 'username'){
            $user = User::where('name', 'Like', '%'. $request->keyword . '%')->get()->paginate(20);
            return $user;           
        }

        if($request->item == 'business'){
            $user = User::where('business_name', 'Like', '%' . $request->keyword . '%')>get();
            $biz = $user->bizdirectory()->with('user')->get()->paginate(20);
            return $biz;          
        }

        if($request->item == 'product'){
            $products = Bizdirectoryproducts::where('product_name', 'Like', '%' . $request->keyword . '%')->with('user')->get()->paginate(20);
            return $products;
        }
        
        if($request->item == 'article'){
            $article = Post::where('title', 'Like', '%' . $request->keyword . '%')->with('user')->get()->paginate(20);
            return $article;        
        }

        
       
    }
    */
}
