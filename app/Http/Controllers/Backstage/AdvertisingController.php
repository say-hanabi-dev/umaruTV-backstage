<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Controllers\Controller;
use App\Models\Website\Advertising;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backstage.advertising.show',[
            'ads'=>Advertising::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $row = Advertising::create($request->all());
        return back()->with('success',"Create successfully, Affected 1 line");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        Advertising::where('id',$id)->update([
            'name'=>$request->input('name'),
            'image'=>$request->input('image'),
            'link'=>$request->input('link')
        ]);
        return back()->with('success',"Update successfully, Affected 1 line");
    }
}
