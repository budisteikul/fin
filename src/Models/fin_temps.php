<?php

namespace budisteikul\fin\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use budisteikul\fin\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;

class fin_temps extends Model
{
    use Uuid;
	
	protected $table = 'fin_temps';
	public $incrementing = false;
	protected $keyType = 'string';
	
}
