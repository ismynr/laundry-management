<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\TransactionDetailRequest;
use App\Services\TransactionDetailService;
use DataTables;
use DateTime;

class TransactionDetailController extends Controller
{
    protected $service;

	public function __construct(TransactionDetailService $service)
	{
		$this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getBy('id_transaction', $request->id_transaction);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('package', function($data){
                        return $data->package->nama_paket;
                    })
                    ->editColumn('qty', function($data){
                        return $data->qty . " " . $data->package->tipe_berat;
                    })
                    ->editColumn('action', function($data) {
                        $d['id'] = $data->id;
                        $d['status'] = $data->status;
                        return $d;
                    })
                    ->make(true);
        }
    }

    public function indexMark(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getBy('id_transaction', $request->id_transaction);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('package', function($data){
                        return $data->package->nama_paket;
                    })
                    ->editColumn('qty', function($data){
                        return $data->qty . " " . $data->package->tipe_berat;
                    })
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }
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
