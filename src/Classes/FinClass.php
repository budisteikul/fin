<?php
namespace budisteikul\fin\Classes;

use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;
use Illuminate\Database\Eloquent\Builder;
use budisteikul\toursdk\Models\Shoppingcart;
use budisteikul\toursdk\Models\ShoppingcartProduct;

class FinClass {

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

	/*
	public static function total_shoppingcart_per_month($booking_channel,$year,$month){
            $total = Shoppingcart::where('booking_channel',$booking_channel)->where('booking_status','CONFIRMED')->whereYear('created_at',$year)->whereMonth('created_at',$month)->sum('total');
        	return $total;
    }
    */

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
}
?>