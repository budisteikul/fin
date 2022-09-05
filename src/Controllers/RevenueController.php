<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
	public function index(Request $request)
    {
    	$tahun = $request->input('year');
        if($tahun=="") $tahun = date("Y");
        $bulan = $request->input('month');
        if($bulan=="") $bulan = date("m");

        return view('fin::fin.sales.revenue',
            [
                'bulan'=>$bulan,
                'tahun'=>$tahun
            ]);
    }
}

?>