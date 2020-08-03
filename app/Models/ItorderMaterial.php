<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MaterialItorder
 * 
 * @property int $id
 * @property int $itorder_id
 * @property int $material_id
 * @property int $metric_id
 * @property string $code
 * @property int $amount
 * 
 * @property \App\Models\Itorder $itorder
 * @property \App\Models\DevicesInventory $devices_inventory
 * @property \App\Models\MetricUnit $metric_unit
 *
 * @package App\Models
 */
class ItorderMaterial extends Eloquent
{
	protected $table = 'itorder_material';
	public $timestamps = false;

	protected $casts = [
		'itorder_id' => 'int',
		'material_id' => 'int',
		'metric_id' => 'int',
		'amount' => 'int'
	];

	protected $fillable = [
		'itorder_id',
		'material_id',
		'metric_id',
		'code',
		'amount'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'itorder_id'   => 'required|numeric',
                'material_id'   => 'required|numeric',
                'metric_id'   => 'required|numeric',
                'amount'   => 'required|numeric',
                'code'   => 'required|max:20',
            ],
            $merge);
    }

	public function itorder()
	{
		return $this->belongsTo(Itorder::class);
	}

	public function material()
	{
		return $this->belongsTo(DevicesInventory::class, 'material_id');
	}

	public function metric_unit()
	{
		return $this->belongsTo(MetricUnit::class, 'metric_id');
	}
}
