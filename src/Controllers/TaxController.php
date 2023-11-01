<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use budisteikul\fin\Classes\FinClass;
use budisteikul\toursdk\Helpers\GeneralHelper;

class TaxController extends Controller
{
	public function index(Request $request)
    {

        $tahun = $request->input('year');
        if($tahun=="") $tahun = date("Y");

        $data = new \stdClass();

        $data->month = [];
        $data->month_text = [];
        $data->revenue = [];
        $data->tax = [];

        for($i=1;$i <= 12; $i++)
        {

            $revenue = FinClass::total_per_month_by_type('Revenue',$tahun,$i);
            $data->month[$i] = $tahun .'-'. GeneralHelper::digitFormat($i,2) .'-01';
            $data->month_text[$i] = date('F', mktime(0, 0, 0, $i, 10)) .' '. $tahun;
            $data->revenue[$i] = number_format($revenue, 0, ',', '.');

            $pp23 = $revenue * 0.5 / 100;
            if(date('Y-m-01',strtotime($data->month[$i])) >= date('Y-m-01')) $pp23 = 0;
            $data->tax[$i] = number_format($pp23, 0, ',', '.');
        }

        
        return view('fin::fin.sales.tax',
            [
                'tahun'=>$tahun,
                'data'=>$data
            ]);
    }
}

?>