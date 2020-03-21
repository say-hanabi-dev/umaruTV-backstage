<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Requests\Backstage\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::filter()->paginate();
        return view('backstage.user.show',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backstage.user.create_edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->toArray();
        if ($request->input('password'))
            $data['password'] = Hash::make($request->input('password'));

        User::where('id',$id)->update_filter($data);

        return back()->with('success','Update successfully, Affected 1 line');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success','Delete successfully, Affected 1 line');
    }

    public function banned(){
        $users = User::whereBanned()->paginate();
        return view('backstage.user.show',compact('users'));
    }

    public function block(Request $request){
        if ($request->input('time') > 0){
            User::block(... array_values($request->only(['id','time','reason'])));
        }else{
            User::blockForever(... array_values($request->only(['id','reason'])));
        }
        return back();
    }

    public function unblock($id){
        User::unblock($id);
        return back();
    }
}
