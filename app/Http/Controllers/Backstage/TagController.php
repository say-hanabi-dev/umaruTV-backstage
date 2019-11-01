<?php

namespace App\Http\Controllers\Backstage;

use App\Models\Anime;
use App\Models\AnimeTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('backstage.tag.show',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:20|min:1',
            'type'=>'required|max:6|min:1',
        ]);
        Tag::create($request->all());
        return back()->with('message','Create success, Affected 1 line');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:20|min:1',
            'type'=>'required|max:6|min:1',
        ]);
        $row = Tag::where('id',$id)->update_filter($request->all());
        return back()->with('message',"Update successfully, Affected $row line");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $row = Tag::destroy($id);
        return back()->with('message',"Delete successfully, Affected $row line");
    }
}
