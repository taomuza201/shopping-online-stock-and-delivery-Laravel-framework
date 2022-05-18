<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Proposal_tag;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

        if(Auth::user()->position=='admin'){
            $proposal = Proposal::get();
        }else{
            $proposal = Proposal::where('proposals_owner_id',Auth::user()->id)->get();
        }
        return view('proposal.proposal_list', compact('proposal'));
    }

    public function store_page()
    {
        $tags = tag::get();

        return view('proposal.index', compact('tags'));
    }

 

    public function upload(Request $request)
    {
        $fileName = time() . '.' . $request->file('file')->extension();
        $request->file('file')->move(public_path('uploads_image'), $fileName);
        $url = "../public/uploads_image/".$fileName;
        return response()->json(['location' => $url ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fileName = time() . '.' . $request->proposals_cover_photo->extension();
        $request->proposals_cover_photo->move(public_path('uploads_image'), $fileName);

        $proposals = Proposal::create([
            'proposals_name' => $request['proposals_name'],
            'proposals_about' => $request['proposals_about'],
            'proposals_price_cost' => $request['proposals_price_cost'],
            'proposals_price' => $request['proposals_price'],
            'proposals_amount' => $request['proposals_amount'],
            'proposals_cover_photo' => $fileName,
            'proposals_owner_id' =>  Auth::user()->id,
            'proposals_story' => str_replace("uploads_image","../uploads_image",$request['proposals_story']),
        ]);

        foreach ($request->tags as $tags) {
            $data = new Proposal_tag();
            $data->proposals_id = $proposals->proposals_id;
            $data->tags_id = $tags;
            $data->save();
        }

        return Redirect::to('/proposal-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposals = Proposal::find($id);
        $tags = tag::get();
        $proposals_tags = Proposal_tag::where('proposals_id', '=', $id)->select('tags_id')->get();
        return view('proposal.detail', compact('proposals', 'tags', 'proposals_tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //  print_r($request->tags);

        $proposals = Proposal::find($id);
        $proposals->proposals_name = $request->proposals_name;
        $proposals->proposals_about = $request->proposals_about;
        $proposals->proposals_price_cost = $request->proposals_price_cost;
        $proposals->proposals_price = $request->proposals_price;
        $proposals->proposals_amount = $request->proposals_amount;
        $proposals->proposals_status = 1;
        $proposals->proposals_owner_id  = Auth::user()->id;
        if ($request->proposals_cover_photo != '') {
            $fileName = time() . '.' . $request->proposals_cover_photo->extension();
            $request->proposals_cover_photo->move(public_path('uploads_image'), $fileName);

            $proposals->proposals_cover_photo = $fileName;
        }

        $proposals->proposals_story = $request->proposals_story;
        $proposals->save();

        $tags_delete = DB::table('proposal_tags')->where('proposals_id', $id)->delete();

        foreach ($request->tags as $tags) {
            $data = new Proposal_tag();
            $data->proposals_id = $proposals->proposals_id;
            $data->tags_id = $tags;
            $data->save();
        }

        return Redirect::to('/proposal-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
