<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Http\Requests\StoreFaqsRequest;
use App\Http\Requests\UpdateFaqsRequest;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($businessname)
    {
        //
        if(exist(Faqs::where('business_name', $businessname))){
            $faq = Faqs::where('business_name', $businessname)->get();
            return $faq;
        }else {
            return('Faq not found.');
        }
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
            'slug' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'user_id' => 'required',
        ]);

        $faq = new Faqs();
        $faq->business_name = $request->business_name;
        $faq->question = $request->question;
        $faq->slug = $request->slug;
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
    public function show($slug)
    {
        //        
        if(exist(Faqs::where('slug', $slug))){
            $faq = Faqs::where('slug', $slug)->get();
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
    public function update($slug)
    {
        //
        $faq = Faqs::where('slug', $slug)->update([
            'business_name' => 'required',
            'slug' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);

        return $faq;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $faq = Faqs::where('slug', $slug)->get();
        return $faq->delete();
    }
}
