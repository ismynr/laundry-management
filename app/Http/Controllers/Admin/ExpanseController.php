<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ExpanseService;
use DataTables;
use Auth;

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
                    ->editColumn('harga', function($data){
                        return \FormatHelp::rupiah($data->harga);
                    })
                    ->editColumn('deskripsi', function($data){
                        $desk = $data->deskripsi;
                        if(strlen($desk) > 80){
                            return $desk ? substr($desk, 0, 80).'...':'-';
                        }
                        return $data->deskripsi ?? '-';
                    })
                    ->editColumn('catatan', function($data){
                        $cat = $data->catatan;
                        if(strlen($cat) > 10){
                            return $cat ? substr($cat, 0, 10).'...':'-';
                        }
                        return $cat ?? '-';
                    })
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }
        return view('admin.expanse_management.index');
    }

    public function indexOwner(Request $request){
        if ($request->ajax()) {
            $data = $this->service->getAllLatest(Auth::user()->id);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('harga', function($data){;
                        return \FormatHelp::rupiah($data->harga);
                    })
                    ->editColumn('catatan', function($data){
                        return $data->catatan ?? '-'; 
                    })
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }
        return view('admin.expanse_management.owner.index');
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
