<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\User;
use Illuminate\Http\Request;

class FaqsController extends Controller
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
        $faq = $user->faqs()->with('user')->get();
        return $faq;
       
    }


    public function showAll()
    {
        //
        $faqs = Faqs::with('user')->paginate(20);
	    return $faqs;
      
    }    

    public function store(Request $request)
    {
        //
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        $faq = new Faqs();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->user_id = $request->user_id;      
    
        Faqs::create($request->all());
    }
    public function show($id)
    {
        //
        $faq = Faqs::where('id', $id)->get();
        return $faq;
    }
 
    public function update(Request $request, $id)
    {
        //
         $validator = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        if($validator){
        $faq = Faqs::where('id', $id)->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return $faq;
    }
    }
    public function destroy($id)
    {
        //
        $faq = Faqs::where('id', $id)->get();
        return $faq->delete();
    }
}
