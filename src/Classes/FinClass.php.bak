<?php
namespace budisteikul\fin\Classes;

use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;
use Illuminate\Database\Eloquent\Builder;

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
}
?>