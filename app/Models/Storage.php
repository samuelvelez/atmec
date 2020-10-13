<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
/**
 * Class DevicesInventory
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 *
 * @package App\Models
 */
class Storage extends Eloquent
{
	protected $table = 'storage';

	protected $fillable = [
		'name',
		'status',
	];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return array
     */
    

}
