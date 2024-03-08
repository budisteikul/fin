<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use budisteikul\fin\Classes\FinClass;
use budisteikul\toursdk\Helpers\GeneralHelper;
use Barryvdh\DomPDF\Facade as PDF;

class NeracaController extends Controller
{
	public function index(Request $request)
    {

        $tahun = $request->input('year');
        $action = $request->input('action');

        if($tahun=="") $tahun = date("Y");

        $no1 = FinClass::calculate_saldo_akhir($tahun-1,12);
        $no2 = 0;
        for($i=1;$i<=12;$i++)
        {
            $no2 += FinClass::total_per_month_by_type('Revenue',$tahun,$i);
        }
        $no3 = 0;
        for($i=1;$i<=12;$i++)
        {
            $no3 += FinClass::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
        }
        $no3 = $no3 * -1;

        $no4 = 0;
        for($i=1;$i<=12;$i++)
        {
            $no4 += FinClass::total_per_month_by_type('Expenses',$tahun,$i);
        }
        $no4 = $no4 * -1;

        $saldo = $no1 + $no2 + $no3 + $no4;

        if($action=="pdf")
        {
            $pdf = PDF::setOptions(['tempDir' =>  storage_path(),'fontDir' => storage_path(),'fontCache' => storage_path(),'isRemoteEnabled' => true])->loadView('fin::fin.pdf.neraca', [
                'tahun'=>$tahun,
                'no1'=>$no1,
                'no2'=>$no2,
                'no3'=>$no3,
                'no4'=>$no4,
                'saldo'=>$saldo
            ])->setPaper('a4', 'portrait');

            return $pdf->download('Neraca-'.$tahun.'.pdf');
        }

        return view('fin::fin.sales.neraca',
            [
                'tahun'=>$tahun,
                'no1'=>$no1,
                'no2'=>$no2,
                'no3'=>$no3,
                'no4'=>$no4,
                'saldo'=>$saldo
            ]);
    }

    

    
}

?>