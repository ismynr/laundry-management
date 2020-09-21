<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\CustomerService;
use DataTables;

class CustomerController extends Controller
{
    protected $service;

	public function __construct(CustomerService $service)
	{
		$this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAllLatest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }

        return view('karyawan.customer_management.index');
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
