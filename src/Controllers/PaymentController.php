<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use budisteikul\toursdk\Models\ShoppingcartPayment;

class PaymentController extends Controller
{
	public function index(Request $request)
    {
        $tahun = $request->input('year');
        if($tahun=="") $tahun = date("Y");

        $bulan = date('m');

        $fin_date_start = env('FIN_DATE_START');
        $fin_date_end = date('Y-m-d') .' 23:59:00';

        $start_year = Str::substr($fin_date_start, 0,4);
        $start_month = Str::substr($fin_date_start, 5,2);

        $newDateTime = Carbon::parse($tahun."-".$bulan."-01");
        $tahun = Str::substr($newDateTime, 0,4);
        $bulan = Str::substr($newDateTime, 5,2);

        $total = 0;

        for($i=$start_year;$i<=$tahun;$i++)
        {
            $xbulan = $start_month;
            if($i!=$start_year) $xbulan = 1;

            $ybulan = $bulan;
            if($i!=date('Y')) $ybulan = 12;

            for($j=$xbulan;$j<=$ybulan;$j++)
            {
                    $date_arr[] = (object)[
                        'nama_bulan' => date('F', mktime(0, 0, 0, $j, 10)),
                        'bulan' => date('m', mktime(0, 0, 0, $j, 10)),
                        'tahun' => $tahun
                    ];
            }
        }

        $ShoppingcartPayments = ShoppingcartPayment::select(['payment_provider','currency'])->whereHas('shoppingcart', function ($query) use ($fin_date_start,$fin_date_end) {
                
                $query = $query->whereHas('shoppingcart_products', function ($query) use ($fin_date_start,$fin_date_end) {
                    return $query->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end );
                })->where('booking_status','CONFIRMED')->where('booking_channel','WEBSITE');

                return $query;

        })->where('amount','>',0)->where('payment_provider', '!=', 'none')->groupBy('currency')->groupBy('payment_provider')->orderBy('payment_provider','ASC')->get();
        
        return view('fin::fin.sales.payment',['date'=>$date_arr,'shoppingcart_payments'=>$ShoppingcartPayments]);
    }
}

?>