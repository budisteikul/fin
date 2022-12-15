<?php

namespace budisteikul\fin\Models;

use Illuminate\Database\Eloquent\Model;

class fin_transactions extends Model
{
    
	
	protected $table = 'fin_transactions';
	
	
	public function categories()
    {
        return $this->belongsTo('budisteikul\fin\Models\fin_categories','category_id');
    }
	
}
