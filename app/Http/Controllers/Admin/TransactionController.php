<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use DataTables;
use DateTime;

class TransactionController extends Controller
{
    protected $service;

	public function __construct(TransactionService $service)
	{
		$this->service = $service;
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAllLatest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('customer', function($data){
                        return $data->customer->name;
                    })
                    ->editColumn('jml_transaction', function($data){
                        $count = $this->service->getCountJoinTdBy("transactions.id", $data->id);
                        return $count;
                    })
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }

        return view('admin.transaction_management.index');
    }

    public function create()
    {
        return view('admin.transaction_management.form.create');
    }

    public function store(TransactionRequest $request)
    {
        $tr = [
            'start_date' => new DateTime(),
            'end_date' => null,
        ];  
        $request->request->add($tr);
        $inTransaction = $this->service->insert($request->all());

        // REDIRECT TO EDIT PAGE
        return redirect()->route('admin.transactions.edit', $inTransaction->id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $transaction = $this->service->getById($id);
        return view('admin.transaction_management.form.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function addItem(Request $request){
        $item = session()->get('item');
        // if(!$item) {
            $item = [
                "id_transaction" => $request->id_transaction,
                "id_package" => $request->id_package,
                "qty" => $request->$qty,
                "harga" => $request->harga
            ];
 
            session()->put('item', $item);
        // }
 
        dd (response()->json($item));
    }

    public function klaimTransaksi(){
        
    }
}
