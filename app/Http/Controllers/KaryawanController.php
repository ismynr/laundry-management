<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\TransactionService;
use App\Services\ExpanseService;
use Auth;

class KaryawanController extends Controller
{
    protected $service;
    protected $serviceExp;

	public function __construct(TransactionService $service, ExpanseService $serviceExp)
	{
        $this->service = $service;
        $this->serviceExp = $serviceExp; 
    }

    // DASHBOARD CONTROLLER
    public function index()
    {
        $idUser = Auth::user()->id;

        $CTMonth = $this->CTMonth($idUser);
        $STMonth = $this->STMonth($idUser);
        $SEMonth = $this->SEMonth($idUser);
        $ChartAllMonth = json_encode($this->ChartAllMonth());
        $RecentTrans = $this->RecentTrans();

        return view('karyawan.karyawan', compact('CTMonth', 'STMonth', 'SEMonth', 'ChartAllMonth', 
                                        'RecentTrans'));
    }

    // COUNT TRANSACTIONS EVERY MONTH
    public function CTMonth($idUser){
        $transaction = $this->service->getBy("id_user", $idUser);

        if($transaction == null){
            return 0;
        }

        $now = date('m-Y');
        $countTransMonth = 0;
        foreach($transaction as $item){
            $mTrans = date('m-Y', strtotime($item->created_at));
            if($mTrans == $now){
                $countTransMonth++;
            }
        }

        return $countTransMonth;
    }

    // SUM TRANSACTIONS EVERY MONTH
    public function STMonth($idUser){
        $transaction = $this->service->getBy("id_user", $idUser);

        if($transaction == null){
            return 0;
        }

        $now = date('m-Y');
        $sumTransMonth = 0;
        $hi = [];
        foreach($transaction as $item){
            foreach ($item->transactionDetail as $item2) {
                $mTrans = date('m-Y', strtotime($item2->created_at));
                if($mTrans == $now){
                    $sumTransMonth += $item2->harga;
                }   
            }
        }
        return $sumTransMonth;
    }

    // SUM EXPANSES EVERY MONTH
    public function SEMonth($idUser){
        $expanses = $this->serviceExp->getBy("id_user", $idUser);

        if($expanses == null){
            return 0;
        }

        $now = date('m-Y');
        $sumExpMonth = 0;
        foreach($expanses as $item){
            $mExp = date('m-Y', strtotime($item->created_at));
            if($mExp == $now){
                $sumExpMonth += $item->harga;
            }  
        }
        return $sumExpMonth;
    }

    // CHART DEFINITION
    public function ChartAllMonth(){
        $month = [
            1=>'JAN', 2=>'FEB', 3=>'MAR', 4=>'APR', 5=>'MEI', 
            6=>'JUN', 7=>'JUL', 8=>'AGU', 9=>'SEP', 10=>'OKT', 11=>'NOV', 12=>'DES'
        ];

        // SPLIT BEETWEN PREVIOUS YEAR AND CURRENT YEAR
        $monthAkhirTahun = $this->splitPrevCurr($month)["monthAkhirTahun"];
        $monthTahunSkrg = $this->splitPrevCurr($month)["monthTahunSkrg"];

        // GET TRANSACTION PRICE IN PREVIOUS YEAR
        $arrPrevious = $this->transPriceByMonth($monthAkhirTahun, date('Y', strtotime('-1 year')));
        // GET TRANSACTION PRICE IN CURRENT YEAR
        $arrCurrent = $this->transPriceByMonth($monthTahunSkrg, date('Y'));
        
        // SUM TRANSACTION PRICE BY MONTH
        $transactionArray = array_values($this->arrJoinSumPrevCurr(
            $arrCurrent, $arrPrevious)
        );
        // MAKE ARRAY
        $transactionArray = array_values($transactionArray);
        
        
        // GET EXPANSES PRICE IN PREVIOUS YEAR
        $arrPrevious = $this->expPriceByMonth($monthAkhirTahun, date('Y', strtotime('-1 year')));
        // GET EXPANSES PRICE IN CURRENT YEAR
        $arrCurrent = $this->expPriceByMonth($monthTahunSkrg, date('Y'));         
        
        // SUM EXPANSES PRICE BY MONTH
        $expanseArray = array_values($this->arrJoinSumPrevCurr(
            $arrCurrent, $arrPrevious)
        );
        // MAKE ARRAY
        $expanseArray = array_values($expanseArray);
        
        $data = [];
        $data[] = $transactionArray;
        $data[] = $expanseArray;
        return $data;
    }

    public function RecentTrans(){
        $transaction = $this->service->getAllLatestLimit(7);
        return $transaction;
    }

    /**
     * 
     * FUNGSI PEMANGGILAN 
     */
    public function transPriceByMonth($arrayMonth, $year){ //Array
        $arr = [];
        $idUser = Auth::user()->id;
        $transaction = $this->service->getBy("id_user", $idUser);
        
        if($transaction == null){
            return [];
        }

        foreach($transaction as $item){
            foreach ($item->transactionDetail as $itemDetail) {
                $mTrans = date('n', strtotime($itemDetail->created_at));
                $yTrans = date('Y', strtotime($itemDetail->created_at));
                $myTrans = $mTrans.'-'.$yTrans;

                foreach ($arrayMonth as $key => $value) {
                    $yPrevious = $year;
                    $myPrevious = $key.'-'.$yPrevious;

                    if($myTrans == $myPrevious){
                        $arr[] = [$key => $itemDetail->harga];
                    }
                }
            }
        }
        return $arr;
    }

    public function expPriceByMonth($arrayMonth, $year){ //Array
        $arr = [];
        $idUser = Auth::user()->id;
        $expanses = $this->serviceExp->getBy("id_user", $idUser);
        
        if($expanses == null){
            return [];
        }

        foreach($expanses as $item){
            $mTrans = date('n', strtotime($item->created_at));
            $yTrans = date('Y', strtotime($item->created_at));
            $myTrans = $mTrans.'-'.$yTrans;
            foreach ($arrayMonth as $key => $value) {
                $yPrevious = $year;
                $myPrevious = $key.'-'.$yPrevious;
                if($myTrans == $myPrevious){
                    $arr[] = [$key => $item->harga];
                }
            }
        }
        return $arr;
    }

    public function arrJoinSumPrevCurr($arr1, $arr2){
        // JOIN AND SUM PRICE BY MONTH
        $default = array_fill_keys(range(1,12), 0);

        // $defConvert = $default;
        $arrJoin = array_merge($arr1, $arr2);
        foreach ($arrJoin as $value) {
            foreach($value as $key => $amount){
                if(isset($default[$key])){
                    $default[$key] += $amount;
                }
            }
        }
        
        $splitMat = $this->splitPrevCurr($default)["monthAkhirTahun"];
        $splitMts = $this->splitPrevCurr($default)["monthTahunSkrg"];
        return array_merge($splitMat, $splitMts);
    }

    public function splitPrevCurr($array){
        $now = date('n', strtotime("+1 month"));
        $monthAkhirTahun = [];
        $monthTahunSkrg = [];
        foreach ($array as $key => $value) {
            if($now <= $key){
                $monthAkhirTahun[$key] = $value;
                continue;
            }else{
                $monthTahunSkrg[$key] = $value;
            }
        }
        $data['monthAkhirTahun'] = $monthAkhirTahun;
        $data['monthTahunSkrg'] = $monthTahunSkrg;
        return $data;;
    }
}
