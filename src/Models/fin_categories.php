<?php

namespace budisteikul\fin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use budisteikul\fin\Traits\Uuid;

class fin_categories extends Model
{
    use Uuid;
	
	protected $table = 'fin_categories';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function transactions()
    {
        return $this->hasMany('budisteikul\fin\Models\fin_transactions','category_id','id');
    }
}
