<?php
namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use budisteikul\toursdk\Models\Product;
use budisteikul\toursdk\Helpers\ReportHelper;

class ReportMonthlyController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');
        $newDateTime = Carbon::parse($date."-01");
        $tahun = Str::substr($newDateTime, 0,4);
        $bulan = Str::substr($newDateTime, 5,2);

        //$tahun = $request->input('year');
        if($date=="") $tahun = date("Y");
        //$bulan = $request->input('month');
        if($date=="") $bulan = date("m");

        $products = Product::orderBy('id')->get();

        for($i=1;$i <= date("t",strtotime($tahun."-".$bulan."-01"));$i++)
        {
            $tgl[] = $i;
            $traveller[] = ReportHelper::traveller_per_day($i,$bulan,$tahun);
        }
         

        
        return view('fin::fin.report.monthly',
            [
                'bulan'=>$bulan,
                'tahun'=>$tahun,
                'products'=>$products,
                'tgl'=>$tgl,
                'traveller' => $traveller
            ]);
    }
}
?>