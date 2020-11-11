<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MaterialReport
 * 
 * @property int $id
 * @property int $report_id
 * @property int $material_id
 * @property int $metric_id
 * @property int $amount
 * 
 * @property \App\Models\DevicesInventory $devices_inventory
 * @property \App\Models\MetricUnit $metric_unit
 * @property \App\Models\Report $report
 *
 * @package App\Models
 */
class MaterialReport extends Eloquent
{
	protected $table = 'material_report';
	public $timestamps = false;

	protected $casts = [
		'report_id' => 'int',
		'material_id' => 'int',
		'metric_id' => 'int',
		'amount' => 'int',
		'bodega'	=>'int'
	];

	protected $fillable = [
		'report_id',
		'material_id',
		'metric_id',
		'amount',
		'bodega'
	];

	public function material()
	{
		return $this->belongsTo(DevicesInventory::class, 'material_id');
	}

	public function metric_unit()
	{
		return $this->belongsTo(MetricUnit::class, 'metric_id');
	}

	public function report()
	{
		return $this->belongsTo(Report::class);
	}
}
