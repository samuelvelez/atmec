<?php

namespace App\Models;

use App\Traits\ReadedByOperator;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Report
 * 
 * @property int $id
 * @property int $alert_id
 * @property int $status_id
 * @property int $novelty_id
 * @property int $subnovelty_id
 * @property string $worktype
 * @property string $pictures
 * @property string $description
 * @property \Carbon\Carbon $readed_on
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Alert $alert
 * @property \App\Models\Novelty $novelty
 * @property \App\Models\Status $status
 *
 * @package App\Models
 */
class Material extends Eloquent
{
    use ReadedByOperator;

    const STATUS_PENDING = 'Pendiente';
    const STATUS_POSTPONED = 'Aplazado';

	protected $casts = [
		'alert_id' => 'int',
		'status_id' => 'int',
		'novelty_id' => 'int',
		'subnovelty_id' => 'int',
		'worktype_id' => 'int'
	];

	protected $dates = [
		'readed_on'
	];

	protected $fillable = [
		'alert_id',
		'status_id',
		'novelty_id',
		'subnovelty_id',
		'worktype_id',
		'pictures',
		'description',
		'readed_on'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'signals'   => 'array',
                'regulators'   => 'array',
                'devices'   => 'array',
                'poles'   => 'array',
                'tensors'   => 'array',
                'lights'   => 'array',
                'alert'   => 'required|exists:alerts,id',
                'novelty'   => 'required|exists:novelties,id',
                'subnovelty'  => 'required|exists:novelties,id',
                'worktype'  => 'required|exists:novelties,id',
                'description' => 'required',
            ],
            $merge);
    }

	public function workorder()
	{
		return $this->hasOne(Workorder::class);
	}

	public function alert()
	{
		return $this->belongsTo(Alert::class);
	}

	public function novelty()
	{
		return $this->belongsTo(Novelty::class, 'novelty_id');
	}

	public function subnovelty()
	{
		return $this->belongsTo(Novelty::class, 'subnovelty_id');
	}

	public function worktype()
	{
		return $this->belongsTo(Novelty::class, 'worktype_id');
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}

	public function materials()
    {
        return $this->hasMany(MaterialReport::class, 'report_id');
    }

    public function vertical_signals()
    {
        return $this->morphedByMany(VerticalSignal::class, 'repairable');
    }

    public function regulator_boxes()
    {
        return $this->morphedByMany(RegulatorBox::class, 'repairable');
    }

    public function traffic_devices()
    {
        return $this->morphedByMany(TrafficDevice::class, 'repairable');
    }

    public function traffic_poles()
    {
        return $this->morphedByMany(TrafficPole::class, 'repairable');
    }

    public function traffic_tensors()
    {
        return $this->morphedByMany(TrafficTensor::class, 'repairable');
    }

    public function traffic_lights()
    {
        return $this->morphedByMany(TrafficLight::class, 'repairable');
    }
}
