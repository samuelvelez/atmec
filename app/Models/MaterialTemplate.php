<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class DeviceTemplate
 * 
 * @property int $id
 * @property int $device_id
 * @property int $itotemplate_id
 * @property int $amount
 * 
 * @property \App\Models\DevicesInventory $devices_inventory
 * @property \App\Models\ItorderTemplate $ito_template
 *
 * @package App\Models
 */
class MaterialTemplate extends Eloquent
{
	protected $table = 'material_template';
	public $timestamps = false;

	protected $casts = [
		'template_id' => 'int',
        'material_id' => 'int',
        'metric_id' => 'int',
		'amount' => 'int'
	];

	protected $fillable = [
		'template_id',
        'material_id',
        'metric_id',
        'code',
		'amount'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'template_id'  => 'required|numeric',
                'material_id'   => 'required|numeric',
                'metric_id'   => 'required|numeric',
                'code'  => 'required|max:20',
                'amount'  => 'required|numeric',
            ],
            $merge);
    }

    public function metric_unit()
    {
        return $this->belongsTo(MetricUnit::class, 'metric_id');
    }

	public function material()
	{
		return $this->belongsTo(DevicesInventory::class, 'material_id');
	}

	public function template()
	{
		return $this->belongsTo(ItorderTemplate::class, 'template_id');
	}
}
