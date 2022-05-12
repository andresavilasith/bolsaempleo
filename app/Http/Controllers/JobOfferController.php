<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_offers = JobOffer::all();

        return response()->json([
            'job_offers' => $job_offers,
            'status' => 'success'
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job_offer = JobOffer::create($request->all());

        return response()->json([
            'job_offer' => $job_offer,
            'status' => 'success',
            'message' => 'Job offer stored successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(JobOffer $job_offer)
    {
        return response()->json([
            'job_offer' => $job_offer,
            'status' => 'success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobOffer $job_offer)
    {
        $job_offer->update($request->all());

        return response()->json([
            'job_offer' => $job_offer,
            'status' => 'success',
            'message' => 'Job offer updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOffer $job_offer)
    {
        $job_offer->delete();

        $job_offers = JobOffer::all();

        return response()->json([
            'job_offers' => $job_offers,
            'status' => 'success',
            'message' => 'Job offer deleted successfully'
        ]);
    }
}
