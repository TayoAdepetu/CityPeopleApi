<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
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
        if(exist(Faqs::where('business_name_slug', $business_name_slug))){
            $faq = Faqs::where('business_name_slug', $business_name_slug)->get();
            return $faq;
        }else {
            return('Faq not found.');
        }
    }


    public function showAll()
    {
        //
        $faqs = Faqs::all();
	    return $faqs;
      
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
     * @param  \App\Http\Requests\StoreFaqsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'business_name' => 'required',
            'business_name_slug' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'user_id' => 'required',
        ]);

        $faq = new Faqs();
        $faq->business_name = $request->business_name;
        $faq->question = $request->question;
        $faq->business_name_slug = $request->business_name_slug;
        $faq->answer = $request->answer;
        $faq->user_id = $request->user_id;        
    
        Faqs::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //        
        if(exist(Faqs::where('id', $id))){
            $faq = Faqs::where('id', $id)->get();
            return $faq;
        }else {
            return('Faq not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function edit(Faqs $faqs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFaqsRequest  $request
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $faq = Faqs::where('id', $id)->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return $faq;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $faq = Faqs::where('id', $id)->get();
        return $faq->delete();
    }
}
