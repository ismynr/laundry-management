<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Http\Requests\KaryawanRequest;
use App\Services\UserService;
use App\Services\KaryawanService;
use Auth;

class ProfileController extends Controller
{
    protected $service;
    protected $serviceKary;

    public function __construct(UserService $service, KaryawanService $serviceKary)
	{
        $this->service = $service;
        $this->serviceKary = $serviceKary;
    }

    public function index()
    {
        $profile = $this->service->getById(Auth::user()->id);
        $karyawan = $this->serviceKary->getBy('id_user', Auth::user()->id);
        if(!$profile){ return abort(404); }

        $now = date('m-Y');

        $countTrans = 0;
        foreach($profile->transaction as $item){
            $mTrans = date('m-Y', strtotime($item->created_at));
            if($mTrans == $now){
                $countTrans++;
            }
        }
        return view('karyawan.profile.index', compact('profile', 'karyawan', 'countTrans'));
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
            return redirect()->route('karyawan.profile.index')->with('error', 'Cannnot update!');
        }

        $user['name'] = $request->name;
        $user['email'] = $request->email;

        if($request->password != null){
            $user['password'] = $request->password;
        }

        $object = $this->service->update($user, $id);
        return redirect()->route('karyawan.profile.index')->with('success', 'Profile berhasil diubah!');
    }

    public function updateKaryawan(KaryawanRequest $request, $id)
    {
        $check =  $this->serviceKary->getById($id);
        if($request->id_user != Auth::user()->id || !$check){
            return redirect()->route('karyawan.profile.index')->with('error', 'Cannnot update!');
        }

        $object = $this->serviceKary->update($request->all(), $id);
        return redirect()->route('karyawan.profile.index')->with('success', 'Profile berhasil diubah!');
    }

    public function destroy($id)
    {
        //
    }
}
