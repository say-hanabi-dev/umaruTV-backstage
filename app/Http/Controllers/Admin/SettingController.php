<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index(){
        return view('backstage.setting.show',[
            'setting'=>Setting::all()
        ]);
    }

    public function create(){
        return view('backstage.setting.create');
    }

    public function store(Request $request){
        Setting::create($request->all());
        return redirect()
            ->route('admin.setting.index')
            ->with('message', 'Create successfully,Affected 1 line');
    }

    public function update(Request $request){
        $row = 0;
        foreach ($request->all() as $key => $value){
            if (is_numeric($key)){
                $row += Setting::where('id',$key)->update(['value'=>$value]);
            }
        }
        return back()->with('success',"Update success, Affected $row line");
    }
}
