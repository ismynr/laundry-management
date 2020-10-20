<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use DataTables;
use DateTime;
use PDF;

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
                        $d['id'] = $data->id;
                        $d['end_date'] = $data->end_date;
                        return $d;
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

    public function destroy($id)
    {
        //
    }

    /**
     * 
     * CUSTOM FUNCTION OR ROUTE
     */
    public function claimTransaction(Request $request, $id){
        $check = $this->service->getById($id);

        if(!$check){ 
            return abort(404); 
        }

        if(count($check->transactionDetail) < 1 ){
            return redirect()
                    ->route('admin.transactions.edit', $id)
                    ->with('error', 'Transaksi tidak dapat diselesaikan, Item tidak ada!');
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
        activity("transaction")
            ->withProperties(["attributes" => $check])  
            ->performedOn($check)
            ->log(':causer.name has claimed this transaction with code :subject.code');
        return redirect()
            ->route('admin.transactions.edit', $id)
            ->with('success', 'Transaksi telah selesai, Anda dapat mencetak struk kuitansi transaksi!');
    }

    public function generateInvoice($id)
    {
        $invoice = $this->service->getById($id);
        $now =  new DateTime();
        if(!$invoice){ return abort(404); }

        if(count($invoice->transactionDetail) < 1 ){
            return redirect()
                    ->route('admin.transactions.edit', $id)
                    ->with('error', 'Tidak dapat dicetak, Item tidak ada!');
        }

        $pdf = PDF::loadView('admin.transaction_management.invoice.print', compact('invoice', 'now'))
                        ->setPaper('a5', 'potrait');
        return $pdf->stream();
    }

    public function generateMark(Request $request, $id)
    {
        $invoice = $this->service->getById($id);
        if(!$invoice){ return abort(404); }

        if(count($invoice->transactionDetail) < 1 ){
            return redirect()
                    ->route('admin.transactions.edit', $id)
                    ->with('error', 'Tidak dapat dicetak, Item tidak ada!');
        }

        $arrPrintMark = $request->all();
        unset($arrPrintMark["_token"]);
        
        $pdf = PDF::loadView('admin.transaction_management.invoice.print-mark', compact('invoice', 'arrPrintMark'))
                        ->setPaper('a5', 'potrait');
        return $pdf->stream();
    }
}
