<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ActivityLogService;
use DataTables;
use Auth;

class ActivityLogController extends Controller
{
    protected $service;

	public function __construct(ActivityLogService $service)
	{
		$this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAllLatest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('user_role', function($data){
                        return $data->user->role;
                    })
                    ->editColumn('time', function($data){
                        return \FormatHelp::timeAgo($data->created_at);
                    })
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }
        return view('admin.activity_log.index');
    }
}
