<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Requests\AnimeRequest;
use App\Http\Type\EmptyType;
use App\Models\Website\Anime;
use App\Http\Controllers\Controller;
use App\Models\Website\AnimeTag;
use App\Models\Website\Danmaku;
use App\Models\Website\Episode;
use App\Models\Website\Tag;
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

    public function batch(Request $request){
//        dd($request->toArray());
        $row = 0;
        switch ($request->input('operating')){
            case 'delete':
                $row = Anime::destroy($request->input('ids')); break;
            case 'merge':
                $row = $this->mergeAnimeResource($request->input('ids'));break;
            case "setEnd":
                $row = Anime::whereIn('id',$request->input('ids'))->update(['end']); break;
        }
        return back()
            ->with('success',"Update successfully, Affected $row line");

    }

    public function mergeAnimeResource($ids){
        $animes = Anime::whereIn('id',$ids)->get();
        $max_episode_count = $animes[0]->episode()->count();
        $max_episodes = $animes[0]->episode;
        foreach ($animes as $anime){
            $count = $anime->episode()->count();
            if ($count > $max_episode_count){
                $max_episodes = $anime->episode;
                $max_episode_count = $count;
            }
        }
        $count = 0;
        foreach ($animes as $anime){
            $episodes = $anime->episode;
            foreach ($episodes as $episode){
                $episode->resource()->update(['episode_id'=>$max_episodes[$count]->id]);
            }
            $count ++;
        }
        $master = $animes->pop();
        $master->episode()->delete();
        foreach ($max_episodes as $episode){
            $episode->update(['anime_id'=>$master->id]);
        }

        foreach ($animes as $anime){
            $anime->delete();
        }
    }

    public function mergeAnime($ids){
        $row = 0;
        $animes = Anime::whereIn('id',$ids)->orderBy('id','desc')->get();
        $merge_data = [
            'watch'=>0,
            'collection'=>0,
            'danmaku'=>0,
        ];
        $max_episodes = 0;
        $max_episodes_anime = $animes[0];

        foreach ($animes as $anime){
            $merge_data['watch'] += $anime->watch;
            $merge_data['collection'] += $anime->collection;
            $merge_data['danmaku'] += $anime->danmaku;

            if ($anime->episode()->count() > $max_episodes){
                $max_episodes = $anime->episode()->count();
                $max_episodes_anime = $anime;
            }
        }
        dump($max_episodes_anime);

        $max_episodes = $max_episodes_anime->episode()->orderBy('id','asc')->orderBy('ranking','asc')->get();
        foreach ($animes as $anime){
            if ($anime->id == $max_episodes_anime->id)
                continue;
            $num = 0;
            foreach ($anime->episode()->orderBy('id','asc')->orderBy('ranking','asc')->get() as $episode){
                $row += $episode->resource()->update(['episode_id'=>$max_episodes[$num]->id]);
                $num++;
            }
        }
        dump($max_episodes_anime->episode()->with('resource')->get());

        $master = $animes->pop();
        $row += $master->update($merge_data);
        $row += $master->episode()->delete();
        $row += $max_episodes_anime->episode()->update(['anime_id'=>$master->id]);
        dump($master->episode()->with('resource')->get());
        dump($ids);
        dump(array_filter($ids,function ($v)use($master){
            return ! ($v == $master->id);
        }));

//        dd($master);

        $row += Anime::destroy(array_filter($ids,function ($v)use($master){
            return ! ($v == $master->id);
        }));


        return $row;
    }
}
