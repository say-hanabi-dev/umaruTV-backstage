<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Type\EmptyType;
use App\Models\Website\Anime;
use App\Models\Website\Episode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $anime = Anime::findOrFail($id);
        $episodes = Episode::where('anime_id',$id)->paginate(15);
        return view('backstage.episode.show',compact('episodes','anime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $anime = Anime::findOrFail($id);
        $episode = new EmptyType();
        return view('backstage.episode.create_edit',compact('episode','anime'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'anime_id'=>'required|exists:animes,id',
            'name'=>'required|max:30',
            'ranking'=>'required|integer'
        ]);
        Episode::create($request->all());
        $row = Anime::where('id',$request->anime_id)->increment('episodes');
        return redirect()
            ->route('backstage.episode.index',$request->anime_id)
            ->with('success','Create successfully, Affected '.++$row.' line');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Episode $episode)
    {
        $anime = $episode->anime;
        return view('backstage.episode.create_edit',compact('episode','anime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param Episode $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:30',
            'ranking'=>'required|integer'
        ]);

        $row = Episode::where('id',$id)->update_filter($request->all());
        return back()->with('success',"Update successfully, Affected $row line");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $row = Episode::destroy($id);
        $row += Anime::where('id',$request->anime_id)->decrement('episodes');
        return back()->with('success',"Delete successfully, Affected $row line");
    }
}
