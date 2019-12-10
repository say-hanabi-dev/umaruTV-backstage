<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Requests\AnimeRequest;
use App\Http\Type\EmptyType;
use App\Models\Anime;
use App\Http\Controllers\Controller;
use App\Models\AnimeTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class AnimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $animes = Anime::search($request->input('search'))
            ->orderBy('id','desc')
            ->filter()
            ->paginate(20);
        return view('backstage.anime.show',compact('animes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param EmptyType $anime
     * @return \Illuminate\Http\Response
     */
    public function create(EmptyType $anime)
    {
        return view('backstage.anime.create_edit',[
            'anime'=>new EmptyType(),
            'tags'=>Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnimeRequest  $AnimeRequest
     * @return \Illuminate\Http\Response
     */
    public function store(AnimeRequest $request)
    {
        $request->saveCover();
        $anime = Anime::create($request->all());
        $row = 0;
        if ($request->input('tag_id'))
            $row = AnimeTag::association($anime->id,$request->input('tag_id'));
        return redirect()
            ->route('backstage.anime.edit', $anime->id)
            ->with('message', 'Create successfully,Affected '.++$row.' line');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        $tags = Tag::all();
        return view('backstage.anime.create_edit',compact('anime','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AnimeRequest  $AnimeRequest
     * @param  int  $id
     * @param Anime $anime
     * @return \Illuminate\Http\Response
     */
    public function update(AnimeRequest $request, $id)
    {
        $rest = 0;
        if ($request->tag_id)
            $rest+=AnimeTag::changeAssociation($id,$request->tag_id);

        $request->saveCover();
        $rest += Anime::where('id',$id)->update_filter($request->all());

        return back()->with('success',"Update successfully, Affected $rest line");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $rest = Anime::destroy($id);
        return back()->with('success',"Delete successfully, Affected $rest line");
    }

    public function timeline(Request $request){
        $active = $request->input('active')?:1;

        $animes = Anime::whereIn('status',['stop','updating'])->get();
        return view('backstage.anime.timeline',compact('animes','active'));
    }

    public function search(Request $request){
        return Anime::select('id','name')
            ->search($request->input('q'))
            ->limit(10)
            ->get();
    }

    public function add(Request $request){
        $row = Anime::where('id',$request->input('id'))->update([
            'update_time'=>$request->input('update_time'),
            'status'=>'updating'
        ]);

        return back()
            ->with('success','Update successfully, Affected '.$row.' line');
    }

    public function end($id,Request $request){
        Anime::where('id',$id)->update([
            'status'=>'end'
        ]);

        return back()
            ->with('success','Update successfully, Affected 1 line');
    }
}
