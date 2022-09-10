<?php
namespace budisteikul\fin\Classes;

use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;
use Illuminate\Database\Eloquent\Builder;
use budisteikul\toursdk\Models\Shoppingcart;
use budisteikul\toursdk\Models\ShoppingcartProduct;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FinClass {

    public static function last_month_saldo($tahun,$bulan)
    {
        $newDateTime = Carbon::parse($tahun."-".$bulan."-01")->subMonths(1);
        $tahun = Str::substr($newDateTime, 0,4);
        $bulan = Str::substr($newDateTime, 5,2);

        
        
            $revenue_per = self::total_all_channel_per_month($tahun,$bulan);
            $cogs_per = self::total_per_month_by_type('Cost of Goods Sold',$tahun,$bulan);
            $gross_margin = $revenue_per - $cogs_per;
        
            $expenses_per = self::total_per_month_by_type('Expenses',$tahun,$bulan);
            $total_expenses = $expenses_per + self::total_tax_per_month($tahun,$bulan);
        
            $profit_loss = $gross_margin - $total_expenses;
        
        return round($profit_loss);
    }

	public static function total_per_month($category_id,$year,$month){
			$total = fin_transactions::where('category_id',$category_id)->whereYear('date',$year)->whereMonth('date',$month)->sum('amount');
		return $total;
	}
	
	public static function total_per_month_by_type($type,$year,$month){
			$total = 0;
			$fin_categories = fin_categories::where('type',$type)->get();
			foreach($fin_categories as $fin_categorie)
			{
				$total += fin_transactions::where('category_id',$fin_categorie->id)->whereYear('date',$year)->whereMonth('date',$month)->sum('amount');
			}
		return $total;
	}

    public static function total_all_channel_per_month($year,$month){

            $total = 0;
            $sub_totals = ShoppingcartProduct::whereHas('shoppingcart', function ($query) use ($booking_channel) {
                            return $query->where('booking_status','CONFIRMED');
                         })->whereYear('date',$year)->whereMonth('date',$month)->get();
            foreach($sub_totals as $sub_total)
            {
                $total += $sub_total->total;
            }
            
            $total += self::total_per_month_by_type('Revenue',$year,$month);

            return $total;
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

    public static function total_all_channel_per_day($year,$month,$day){

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

	public static function total_shoppingcart_per_month($booking_channel,$year,$month){
            $total = 0;
            $sub_totals = ShoppingcartProduct::whereHas('shoppingcart', function ($query) use ($booking_channel) {
                            return $query->where('booking_status','CONFIRMED')->where('booking_channel',$booking_channel);
                         })->whereYear('date',$year)->whereMonth('date',$month)->get();
            foreach($sub_totals as $sub_total)
            {
            	$total += $sub_total->total;
            }
            
        	return $total;
    }

    



    public static function total_tax_per_month($year,$month){

            $sales = self::total_all_channel_per_month($year,$month);
            $tax = $sales * 0.5 / 100;

        	return $tax;
    }

    public static function total_expenses_per_month($year,$month){

            $total = 0;
            $total = self::total_per_month_by_type('Expenses',$year,$month);
            $total = $total + self::total_tax_per_month($year,$month);
        	return $total;
    }
}
?>