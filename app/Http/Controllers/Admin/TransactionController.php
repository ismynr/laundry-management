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
                    ->editColumn('total_harga', function($data){
                        return \FormatHelp::rupiah($this->service->getTotalHargaById($data->id)[0]["total"] ?? "0");
                    })
                    ->editColumn('status', function($data){
                        return is_null($data->end_date) ? "Berjalan" : "Selesai" ;
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
        if(!$transaction){ return abort(404); }

        // JIKA TRANSAKSI SELESAI
        if($transaction->end_date){
            return view('admin.transaction_management.form.edit-finish', compact('transaction'));    
        }

        return view('admin.transaction_management.form.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function claimTransaction(Request $request, $id){
        $check = $this->service->getById($id);

        if(!$check){ 
            return abort(404); 
        }

        foreach($check->transactionDetail as $item){
            echo $item->status;
            if($item->status != "diambil"){
                return redirect()
                    ->route('admin.transactions.edit', $id)
                    ->with('error', 'Transaksi tidak dapat diselesaikan, Item harus sudah diambil semua oleh pelanggan!');
            }
        }
        
        $data = [
            'end_date' => new DateTime()
        ];

        $object = $this->service->update($data, $id);
        return redirect()
                    ->route('admin.transactions.edit', $id)
                    ->with('success', 'Transaksi telah selesai, Anda dapat mencetak struk kuitansi transaksi!');
    }

    public function destroy($id)
    {
        //
    }
}