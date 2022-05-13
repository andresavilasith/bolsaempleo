<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobOffer\JobOfferStoreRequest;
use App\Http\Requests\JobOffer\JobOfferUpdateRequest;
use App\Models\JobOffer;
use App\Models\User;
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
    public function store(JobOfferStoreRequest $request)
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
    public function update(JobOfferUpdateRequest $request, JobOffer $job_offer)
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

    public function job_offers_users()
    {
        $job_offers_with_users = JobOffer::with('users')->get();

        return response()->json([
            'job_offers_with_users' => $job_offers_with_users,
            'status' => 'success',
        ]);
    }

    public function create_apply_to_job_offer()
    {

        $jobs_offers = JobOffer::where('state', 'activo')->get();


        return response()->json([
            'jobs_offers' => $jobs_offers,
            'status' => 'success',
        ]);
    }

    public function apply_to_job_offer(Request $request)
    {
        $user_id = auth()->user()->id;

        $user = User::find($user_id);
        $job_offer = JobOffer::find($request->get('joboffer'));

        $users_applied = [];

        foreach ($job_offer->users as $user) {
            $users_applied[] = $user->id;
        }

        if (!in_array($user_id, $users_applied)) {


            if ($request->get('joboffer')) {
                $user->job_offers()->sync($request->get('joboffer'));

                $job_offer = JobOffer::find($request->get('joboffer'));
            }

            return response()->json([
                'message' => 'You apply successfully to ' . $job_offer->name,
                'status' => 'success'
            ]);
        }

        return response()->json([
            'message' => 'You already apply to ' . $job_offer->name,
            'status' => 'error'
        ]);
    }
}
