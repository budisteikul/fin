<?php

namespace budisteikul\fin\Models;

use Illuminate\Database\Eloquent\Model;

class fin_categories extends Model
{
	protected $table = 'fin_categories';
	
	public function transactions()
    {
        return $this->hasMany('budisteikul\fin\Models\fin_transactions','category_id','id');
    }
}
