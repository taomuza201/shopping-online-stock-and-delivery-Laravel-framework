<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Proposal_tag;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;

class Proposal_requestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposal = Proposal::get();
        return view('proposal-request.proposal_list', compact('proposal'));
    }

    public function upload(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('uploads', $fileName, 'public');
        return response()->json(['location' => "/storage/$path"]);

        /*$imgpath = request()->file('file')->store('uploads', 'public');
    return response()->json(['location' => "/storage/$imgpath"]);*/

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

        //  print_r($request->tags);

        $proposals = Proposal::create([
            'proposals_name' => $request['proposals_name'],
            'proposals_about' => $request['proposals_about'],
            'proposals_price_cost' => $request['proposals_price_cost'],
            'proposals_price' => $request['proposals_price'],
            'proposals_amount' => $request['proposals_amount'],
            'proposals_cover_photo' => $fileName,
            'proposals_story' => $request['proposals_story'],
        ]);

        foreach ($request->tags as $tags) {
            $data = new Proposal_tag();
            $data->proposals_id = $proposals->proposals_id;
            $data->tags_id = $tags;
            $data->save();
        }

        return Redirect::to('/proposal-list-request');
    }

    function print($id) {
        $proposals = Proposal::find($id);
        $story = str_replace("../uploads_image", "../public/uploads_image", $proposals->proposals_story);

        view()->share('proposals', $proposals);
        view()->share('story', $story);
        $pdf = PDF::loadView('report.proposal-request');
        return $pdf->download('proposal.pdf');
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
        return view('proposal-request.detail', compact('proposals', 'tags', 'proposals_tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
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

        return Redirect::to('/proposal-list-request');
    }

    public function approve( $id)
    {
        // echo $id;
        // dd($request);
        $proposals = Proposal::find($id);
        $proposals->proposals_status = 2;
        $proposals->save();
       
        return Redirect::to('/proposal-list-request');
    }
    public function edit($id)
    {
        $proposals = Proposal::find($id);
        $proposals->proposals_status = 3;
        $proposals->save();
       
        return Redirect::to('/proposal-list-request');
    }

    public function none( $id)
    {
        // echo $id;
        // dd($request);
        $proposals = Proposal::find($id);
        $proposals->proposals_status = 4;
        $proposals->save();
       
        return Redirect::to('/proposal-list-request');
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
