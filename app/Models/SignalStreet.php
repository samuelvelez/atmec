<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class VerticalSignal
 * 
 * @property int $id
 * @property int $subgroup_id
 * @property int $dimension_id
 * @property string $code
 * @property string $variation
 * @property string $name
 * @property string $usage
 * @property string $description
 * @property string $picture
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SignalDimension $signal_dimension
 * @property \App\Models\SignalSubgroup $signal_subgroup
 * @property \Illuminate\Database\Eloquent\Collection $signals_inventories
 *
 * @package App\Models
 */
class SignalStreet extends Eloquent
{
    protected $table = 'signal_streets';

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'id',
		'DIRECCION_UNIFICADA',				
	];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return array
     */
    public static function rules($merge = [])
    {
        return array_merge(
            [
                'id'   => 'required|min:1|max:50|unique:signal_streets,id',         
                'DIRECCION_UNIFICADA'   => 'required|text'
            ],
            $merge);
    }

	
	
}