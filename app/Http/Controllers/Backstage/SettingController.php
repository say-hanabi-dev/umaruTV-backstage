<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Controllers\Controller;
use App\Models\Backstage\Setting;
use Cassandra\Set;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index(){
        $setting = Setting::all();
        return view('backstage.setting',compact('setting'));
    }

    public function save(Request $request){
        $row = 0;
        foreach ($request->all() as $key => $value){
            if (is_numeric($key)){
                $row += Setting::where('id',$key)->update(['value'=>$value]);
            }
        }
        return back()->with('success',"Update success, Affected $row line");
    }

    public function upload(Request $request){
        $time = date('Y/m');
        $rst = $request->file('upload_file')->store('/upload/'.$time, 'public');
        return [
            'code'=>200,
            'path'=>'/storage/'.$rst
        ];
    }
}
