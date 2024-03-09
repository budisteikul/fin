<?php
namespace budisteikul\fin\Helpers;

use budisteikul\toursdk\Helpers\GeneralHelper;

use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class FinHelper {
    
    public static function initial_capital()
    {
        return env('FIN_MODAL',0);
    }

    public static function first_date_transaction()
    {
        $fin_transactions = fin_transactions::first();
        return $fin_transactions->date;
    }
	
    public static function getChild($id)
    {
        $array = array();
        array_push($array,$id);
        $array = self::getChild_($id,$array);
        return $array;
    }

    public static function getChild_($id,$array)
    {
        $categories = fin_categories::where('parent_id',$id)->get();
        foreach($categories as $category)
        {
             array_push($array,$category->id);
             $a = array();
             if(count($category->child))
             {
                $a = self::getChild_($category->id,$a);
                $array = array_merge($array,$a);
             }
        }
        return $array;
    }

    public static function select_year_form($tahun)
    {
        
        $fin_date_start = self::first_date_transaction();
        $start_year = Str::substr($fin_date_start, 0,4);
        $tahun_now = date('Y');

        $option = '';
        for($i=$tahun_now;$i>=$start_year;$i--)
        {
            if($i==$tahun)
            {
                $option .= '<option value="'.$i .'" selected>'.$i.'</option>';
            }
            else 
            {
                $option .= '<option value="'.$i .'">'.$i.'</option>';
            }
            
        }

        $string = '
                   <form class="form-inline mb-4" method="GET">
                    <div class="form-group">
                        <label class="mr-2" for="date">Year</label>
                        <select name="year" class="form-control mr-2" id="year_filter">'.$option.'</select>
                        <button id="filter" type="submit" class="btn btn-primary"> Apply</button>
                    </div>
                   </form>
                   ';
        return $string;
    }

    public static function total_per_month_by_id($id,$year,$month)
    {
          $total = 0;
          $categories = self::getChild($id);
          foreach($categories as $category)
          {
                $total += fin_transactions::where('category_id',$category)->whereYear('date',$year)->whereMonth('date',$month)->sum('amount');
          }
          return $total;
    }
}
?>