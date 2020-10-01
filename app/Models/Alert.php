<?php

namespace App\Models;

use App\Traits\ReadedByCollector;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Alert
 * 
 * @property int $id
 * @property int $operator_id
 * @property int $collector_id
 * @property int $status_id
 * @property float $latitude
 * @property float $longitude
 * @property string $google_address
 * @property string $priority
 * @property string $motive
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\Status $status
 *
 * @package App\Models
 */
class Alert extends Eloquent
{
    use ReadedByCollector;

    const STATUS_UNATTENDED = 'No atendido';
    const STATUS_ATTENDED = 'atendido';

	protected $casts = [
		'owner_id' => 'int',
		'collector_id' => 'int',
		'status_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float'
	];

    protected $dates = [
        'readed_on'
    ];

	protected $fillable = [
		'owner_id',
		'collector_id',
		'status_id',
		'latitude',
		'longitude',
		'google_address',
		'priority_id',
		'reason',
		'description'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'collector'   => 'numeric',
                'latitude'   => 'required|numeric',
                'longitude'  => 'required|numeric',
                'google_address' => 'required:max:100',
            ],
            $merge);
    }

	public function collector()
	{
		return $this->belongsTo(User::class, 'collector_id');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}

	public function report()
    {
        return $this->hasOne(Report::class);
    }
}
