<?php
namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ReportGuideController extends Controller
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

        
        return view('fin::fin.report.guide',
            [
                'bulan'=>$bulan,
                'tahun'=>$tahun
            ]);
    }
}
?>