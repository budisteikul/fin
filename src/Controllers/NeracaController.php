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

        $capital = FinClass::capital();
        $debt = FinClass::debt();
        $retained_earnings = FinClass::calculate_saldo_akhir($tahun-1,12);

        $revenue = 0;
        for($i=1;$i<=12;$i++)
        {
            $revenue += FinClass::total_per_month_by_type('Revenue',$tahun,$i);
        }
        
        $cogs = 0;
        for($i=1;$i<=12;$i++)
        {
            $cogs += FinClass::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
        }

        $expenses = 0;
        for($i=1;$i<=12;$i++)
        {
            $expenses += FinClass::total_per_month_by_type('Expenses',$tahun,$i);
        }
        
        $cash = 0;
        $accounts_receivable = 0;
        $earning = $revenue - $cogs - $expenses;

        $cash = $capital + $debt + $retained_earnings + $earning;
        if($earning<0)
        {
            $accounts_receivable = $earning * -1;
            $earning = 0;
        }
        

        $total_asset = $cash + $accounts_receivable;
        $total_liabilities_and_equity =  $capital+$earning+$retained_earnings;

        if($action=="pdf")
        {
            $pdf = PDF::setOptions(['tempDir' =>  storage_path(),'fontDir' => storage_path(),'fontCache' => storage_path(),'isRemoteEnabled' => true])->loadView('fin::fin.pdf.neraca', [
                'tahun'=>$tahun,
                'cash'=>$cash,
                'retained_earnings'=>$retained_earnings,
                'capital'=>$capital,
                'debt'=>$debt,
                'accounts_receivable'=>$accounts_receivable,
                'earning'=>$earning,
                'total_asset'=>$total_asset,
                'total_liabilities_and_equity'=>$total_liabilities_and_equity,
            ])->setPaper('a4', 'portrait');

            return $pdf->download('Neraca-'.$tahun.'.pdf');
        }

        return view('fin::fin.sales.neraca',
            [
                'tahun'=>$tahun,
                'cash'=>$cash,
                'retained_earnings'=>$retained_earnings,
                'capital'=>$capital,
                'debt'=>$debt,
                'accounts_receivable'=>$accounts_receivable,
                'earning'=>$earning,
                'total_asset'=>$total_asset,
                'total_liabilities_and_equity'=>$total_liabilities_and_equity,
            ]);
    }

    

    
}

?>