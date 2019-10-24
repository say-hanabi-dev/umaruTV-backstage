<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Requests\AnimeRequest;
use App\Http\Type\EmptyType;
use App\Models\Anime;
use App\Http\Controllers\Controller;
use App\Models\AnimeTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animes = Anime::orderBy('id','desc')->paginate(20);
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
        $tags = Tag::all();
        return view('backstage.anime.create_edit',compact('anime','tags'));
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
        $data = [];
        foreach ($request->tag_id as $id){
            $data[] = ['tag_id'=>$id,'anime_id'=>$anime->id];
        }
        $row = AnimeTag::insert($data);
        return redirect()
            ->route('backstage.anime.edit', $anime->id)
            ->with('message', 'Create successfully,Affected '.++$row.' line');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $anime_tag = AnimeTag::select('id','tag_id')->where('anime_id',$id)->get()->toArray();
        // 在数据库中出现却没在表单里出现的，是要删除的关系
        $delete = array_diff(array_column($anime_tag,'tag_id'),$request->tag_id);
        // 反之就是要增加的关系
        $create = array_diff($request->tag_id,array_column($anime_tag,'tag_id'));

        $delete_id = array_filter($anime_tag,function ($value)use($delete){
            return in_array($value['tag_id'],$delete);
        });
        $delete_id = array_column($delete_id,'id');

        $insert = array();
        foreach ($create as $tag_id){
            $insert[] = ['anime_id'=>$id,'tag_id'=>$tag_id];
        }
        $rest = 0;
        $rest += AnimeTag::destroy($delete_id);
        $rest += AnimeTag::insert($insert);
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
}
