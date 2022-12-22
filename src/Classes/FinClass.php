<?php
namespace budisteikul\fin\Classes;

use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;
use budisteikul\toursdk\Helpers\GeneralHelper;
use budisteikul\toursdk\Models\Shoppingcart;
use budisteikul\toursdk\Models\ShoppingcartProduct;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class FinClass {

    public static function payment_total($tahun,$bulan,$payment_provider,$currency)
    {
        $fin_date_start = env('FIN_DATE_START');
        $fin_date_end = date('Y-m-d') .' 23:59:00';

        $total = fin_transactions::where('category_id',$category_id)->whereYear('date',$year)->whereMonth('date',$month)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end )->sum('amount');

        $ShoppingcartProduct = ShoppingcartProduct::whereHas('shoppingcart', function ($query) use ($payment_provider,$currency) {
                $query = $query->whereHas('shoppingcart_payment', function ($query) use ($payment_provider,$currency) {
                    return $query->where('payment_provider',$payment_provider)->where('currency',$currency);
                })->where('booking_status','CONFIRMED')->where('booking_channel','WEBSITE');
                return $query;
        })->whereYear('date',$tahun)->whereMonth('date',$bulan)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end )->get();

        $value = 0;

        foreach($ShoppingcartProduct as $id)
        {
            if(isset($id->shoppingcart->shoppingcart_payment->amount) && isset($id->shoppingcart->shoppingcart_payment->currency) && $id->shoppingcart->shoppingcart_payment->payment_provider==$payment_provider)
            {
                $amount = $id->due_now;
                $amount = $amount / $id->shoppingcart->shoppingcart_payment->rate;
                $value += $amount;
            }
        }
        
        return number_format((float)$value, 2, '.', '');
    }

    public static function select_banking_form($tahun,$bulan)
    {
        //print($tahun.'-'. $bulan);
        $fin_date_start = env('FIN_DATE_START');
        
        $start_year = Str::substr($fin_date_start, 0,4);
        $start_month = Str::substr($fin_date_start, 5,2);

        //$newDateTime = Carbon::parse($tahun."-".$bulan."-01")->subMonths(1);
        $tahun_now = date('Y');
        $bulan_now = date('m');

        $option = '';
        for($i=$tahun_now;$i>=$start_year;$i--)
        {
            $xbulan = $start_month;
            if($i!=$start_year) $xbulan = 1;

            $ybulan = $bulan_now;
            if($i!=date('Y')) $ybulan = 12;

            for($j=$ybulan;$j>=$xbulan;$j--)
            {
                $jbulan = GeneralHelper::digitFormat($j,2);
                if($i .'-'. GeneralHelper::digitFormat($jbulan,2) == $tahun .'-'. $bulan)
                {
                    $option .= '<option value="'.$i .'-'. $jbulan.'" selected>'.date('F', mktime(0, 0, 0, $jbulan, 10)).' '.$i.'</option>';
                }
                else
                {
                    $option .= '<option value="'.$i .'-'. $jbulan.'">'. date('F', mktime(0, 0, 0, $jbulan, 10)) .' '.$i.'</option>';
                }
                
            }
        }

        $string = '
                   <form class="form-inline mb-4" method="GET">
                    <div class="form-group">
                        <label class="mr-2" for="date">Date</label>
                        <select name="date" class="form-control mr-2" id="date">'.$option.'</select>
                        <button id="submit" type="submit" class="btn btn-primary"> Apply</button>
                    </div>
                   </form>
                   ';
        return $string;
    }

    public static function select_profitloss_form($tahun)
    {
        //print($tahun.'-'. $bulan);
        $fin_date_start = env('FIN_DATE_START');
        
        $start_year = Str::substr($fin_date_start, 0,4);

        //$newDateTime = Carbon::parse($tahun."-".$bulan."-01")->subMonths(1);
        $tahun_now = date('Y');

        $option = '';
        for($i=$tahun_now;$i>=$start_year;$i--)
        {
            $option .= '<option value="'.$i .'" selected>'.$i.'</option>';
        }

        $string = '
                   <form class="form-inline mb-4" method="GET">
                    <div class="form-group">
                        <label class="mr-2" for="date">Year</label>
                        <select name="year" class="form-control mr-2" id="year">'.$option.'</select>
                        <button id="submit" type="submit" class="btn btn-primary"> Apply</button>
                    </div>
                   </form>
                   ';
        return $string;
    }

    
    
    

    public static function last_month_saldo($tahun,$bulan)
    {
        
                $fin_date_start = env('FIN_DATE_START');

                $start_year = Str::substr($fin_date_start, 0,4);
                $start_month = Str::substr($fin_date_start, 5,2);

                $newDateTime = Carbon::parse($tahun."-".$bulan."-01")->subMonths(1);
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
                
                            $jbulan = GeneralHelper::digitFormat($j,2);
                            $revenue_per = self::total_revenue_per_month($i,$jbulan);
                            $cogs_per = self::total_per_month_by_type('Cost of Goods Sold',$i,$jbulan);
                            $gross_margin = $revenue_per - $cogs_per;
                            $total_expenses = self::total_per_month_by_type('Expenses',$i,$jbulan);
                    
                            $profit_loss = $gross_margin - $total_expenses;
                            $total += $profit_loss;

                    }

                    
                }

                
                

                return round($total);
               
    }

	public static function total_per_month($category_id,$year,$month){

        //$total = Cache::rememberForever('total_per_month'. $category_id .'_'. $year .'_'. $month, function() use ($category_id,$year,$month) 
        //{
            $fin_date_start = env('FIN_DATE_START');
            $fin_date_end = date('Y-m-d') .' 23:59:00';

            $total = fin_transactions::where('category_id',$category_id)->whereYear('date',$year)->whereMonth('date',$month)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end )->sum('amount');
		  return $total;
        //});
        //return $total;
	}
	
	public static function total_per_month_by_type($type,$year,$month){
		
            //$total = Cache::rememberForever('_total_per_month_by_type_'. $type .'_'. $year .'_'. $month, function() use ($type,$year,$month) 
            //{
                $fin_date_start = env('FIN_DATE_START');
                $fin_date_end = date('Y-m-d') .' 23:59:00';

                $total = 0;
                $fin_categories = fin_categories::where('type',$type)->get();
                foreach($fin_categories as $fin_categorie)
                {
                    $total += fin_transactions::where('category_id',$fin_categorie->id)->whereYear('date',$year)->whereMonth('date',$month)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end )->sum('amount');
                }
                return $total;
            //});

            
		//return $total;
	}

    public static function total_shoppingcart_per_month($booking_channel,$year,$month){
            
            $fin_date_start = env('FIN_DATE_START');
            $fin_date_end = date('Y-m-d') .' 23:59:00';

            $total = 0;

            $sub_totals = ShoppingcartProduct::whereHas('shoppingcart', function ($query) use ($booking_channel) {
                            return $query->where('booking_status','CONFIRMED')->where('booking_channel',$booking_channel);
                         })->whereYear('date',$year)->whereMonth('date',$month)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end )->get();

            foreach($sub_totals as $sub_total)
            {
                $total += $sub_total->total;
            }
            
            return $total;
    }
    
    public static function total_revenue_per_month($year,$month){
            
            //$total = Cache::rememberForever('_total_revenue_per_month_'. $year .'_'. $month, function() use ($year,$month) 
            //{
                $fin_date_start = env('FIN_DATE_START');
                $fin_date_end = date('Y-m-d') .' 23:59:00';

                $total = 0;
                $sub_totals = ShoppingcartProduct::whereHas('shoppingcart', function ($query) use ($booking_channel) {
                            return $query->where('booking_status','CONFIRMED');
                         })->whereYear('date',$year)->whereMonth('date',$month)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end )->get();
                foreach($sub_totals as $sub_total)
                {
                    $total += $sub_total->total;
                }
            
                $total += self::total_per_month_by_type('Revenue',$year,$month);
                return $total;
            //});
            

            //return $total;
    }

	public static function total_per_day_by_type($type,$year,$month,$day){
            $total = 0;
            $fin_categories = fin_categories::where('type',$type)->get();
            foreach($fin_categories as $fin_categorie)
            {
                $total += fin_transactions::where('category_id',$fin_categorie->id)->whereYear('date',$year)->whereMonth('date',$month)->whereDay('date',$day)->sum('amount');
            }
        return $total;
    }

    public static function total_revenue_per_day($year,$month,$day){

            $total = 0;
            $sub_totals = ShoppingcartProduct::whereHas('shoppingcart', function ($query) use ($booking_channel) {
                            return $query->where('booking_status','CONFIRMED');
                         })->whereYear('date',$year)->whereMonth('date',$month)->whereDay('date',$day)->get();
            foreach($sub_totals as $sub_total)
            {
                $total += $sub_total->total;
            }
            
            $total += self::total_per_day_by_type('Revenue',$year,$month,$day);

            return $total;
    }

	

}
?>