<?php

namespace budisteikul\fin\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use budisteikul\fin\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;

class fin_transactions extends Model
{
    use Uuid;
	
	protected $table = 'fin_transactions';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function categories()
    {
        return $this->belongsTo('budisteikul\fin\Models\fin_categories','category_id');
    }
	
}
