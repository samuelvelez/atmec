<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SignalSubgroup
 * 
 * @property int $id
 * @property int $group_id
 * @property string $code
 * @property string $name
 * @property string $shape
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SignalGroup $signal_group
 * @property \Illuminate\Database\Eloquent\Collection $signal_colors
 * @property \Illuminate\Database\Eloquent\Collection $vertical_signals
 *
 * @package App\Models
 */
class DeviceTypes extends Eloquent
{
    protected $table = 'device_types';

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'id',
		'description',
            'brands_type_fk',
		'created_at',
		'updated_at'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'description' => 'required|max:200',
//                'created_at' => 'required|max:50',
//                'updated_at' => 'required|datetime',                
            ],
            $merge);
    }

	public function group()
	{
		return $this->belongsTo(Brand::class, 'id');
	}

	public function signals_types()
	{
		return $this->hasMany(Brand::class, 'id');
	}
}
