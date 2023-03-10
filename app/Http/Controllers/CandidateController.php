<?php

namespace App\Http\Controllers;

use App\Http\Resources\CandidateResource;
use App\Http\Resources\GeneralResource;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $searchQuery = $request->query('name');

        $pageSize = $request->page_size ?? 10;
        $candidates = Candidate::search($searchQuery)->paginate($pageSize);


        return ['status code' => 200, 'candidates' => CandidateResource::collection($candidates)->response()->getData(true)];
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        return response()->json(['status code' => 200, 'candidate' => new CandidateResource($candidate)]);
    }

    public function get_address_by_candidate(Request $request, Candidate $candidate)
    {

        return response()->json(['status code' => 200, 'candidate' => new GeneralResource($candidate->addresses)]);
    }

}
