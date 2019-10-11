<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Type\EmptyType;
use App\Models\Anime;
use App\Models\Video;
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
        $episodes = Video::where('anime_id',$id)->paginate(15);
        return view('backstage.episode.index',compact('episodes','anime'));
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
        Video::create($request->all());
        $row = Anime::where('id',$request->anime_id)->increment('episodes');
        return redirect()
            ->route('backstage.episode.index',$request->anime_id)
            ->with('message','Create successfully, Affected '.($row+1).' line');
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
     * @param  Video  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $episode)
    {
        $anime = $episode->anime;
        return view('backstage.episode.create_edit',compact('episode','anime'));
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
        $request->validate([
            'name'=>'required|max:30',
            'ranking'=>'required|integer'
        ]);

        $episode = new Video();
        $fillable = $episode->getFillable();
        $date = array_filter($request->all(),function ($key)use($fillable){
            return in_array($key,$fillable);
        },ARRAY_FILTER_USE_KEY);

        $row = $episode::where('id',$id)->update($date);
        return back()->with('message',"Update successfully, Affected $row line");
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
