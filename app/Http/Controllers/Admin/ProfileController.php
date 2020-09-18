<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Auth;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
	{
        $this->service = $service;
    }

    public function index()
    {
        $profile = $this->service->getById(Auth::user()->id);
        if(!$profile){ return abort(404); }

        $mTrans = date('m', strtotime($profile->transaction[0]->created_at));
        $now = date('m');

        $countTrans = 0;
        foreach($profile->transaction as $item){
            $mTrans = date('m', strtotime($item->created_at));
            if($mTrans == $now){
                $countTrans++;
            }
        }
        return view('admin.profile.index', compact('profile', 'countTrans'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(UserRequest $request, $id)
    {
        $check = $this->service->getById($request->id);
        if($id != Auth::user()->id || !$check){
            return redirect()->route('admin.profile.index')->with('error', 'Cannnot update!');
        }

        $user['name'] = $request->name;
        $user['email'] = $request->email;

        if($request->password != null){
            $user['password'] = $request->password;
        }

        $object = $this->service->update($user, $id);
        return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil diubah!');
    }

    public function destroy($id)
    {
        //
    }
}
