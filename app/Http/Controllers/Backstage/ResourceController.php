<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Http\Type\EmptyType;
use App\Models\Episode;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $episode = Episode::findOrFail($id);
        $anime = $episode->anime;
        $resources = Resource::where('video_id',$id)->get();
        return view('backstage.resource.show',compact('resources','anime','episode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $episode = Episode::findOrFail($id);
        $anime = $episode->anime;
        $resource = new EmptyType();
        return view('backstage.resource.create_edit',compact('episode','anime','resource'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResourceRequest $request)
    {
//        dd($request->all());
        Resource::create($request->all());
        return redirect()->route('backstage.resource.index',$request->video_id)->with('success','Create successfully, Affected 1 line');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = Resource::findOrFail($id);
        $episode = $resource->episode;
        $anime = $episode->anime;
        return view('backstage.resource.create_edit',compact('resource','episode','anime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ResourceRequest $request
     * @param int $id
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function update(ResourceRequest $request, $id)
    {
        $row = Resource::where('id',$id)->update_filter($request->all());
        return back()->with('success',"Update successfully, Affected $row line");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Resource::destroy($id);
        return back()->with('success',"Delete successfully, Affected $row line");
    }

    public function player(Request $request){
        return view('backstage.resource.player',[
            'url'=>$request->url
        ]);
    }
}
