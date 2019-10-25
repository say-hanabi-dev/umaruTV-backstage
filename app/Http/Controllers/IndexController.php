<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('admin.edit',compact('user'));
    }
    public function updateProfile(Request $request){
        return (new AdminController())->update($request,Auth::id());
    }
}
