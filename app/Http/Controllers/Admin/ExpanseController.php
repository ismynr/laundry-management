<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ExpanseService;
use DataTables;

class ExpanseController extends Controller
{
    protected $service;

	public function __construct(ExpanseService $service)
	{
		$this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAllLatest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('user', function($data){
                        return $data->user->name;
                    })
                    ->editColumn('harga', function($data){;
                        return number_format($data->harga,0,'','.');
                    })
                    ->editColumn('catatan', function($data){;
                        return $data->catatan ?? '-';
                    })
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }
        return view('admin.expanse_management.index');
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
