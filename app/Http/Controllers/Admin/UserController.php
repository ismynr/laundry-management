<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\UserService;
use DataTables;

class UserController extends Controller
{
    protected $service;

	public function __construct(UserService $service)
	{
		$this->service = $service;
    }

    /**
     * ADMIN LIST
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAllLatestAdmin();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }

        return view('admin.user_management.user_admin.index');
    }
    
    /**
     * KARYAWAN LIST
     */
    public function indexKaryawan(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAllLatestKaryawan();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('action', function($data) {
                        $d['id_user'] = $data->id;
                        $d['id_karyawan'] = $data->karyawan->id;
                        return $d;
                    })
                    ->make(true);
        }

        return view('admin.user_management.user_karyawan.index');
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
