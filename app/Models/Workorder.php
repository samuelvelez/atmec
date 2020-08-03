<?php

namespace App\Models;

use Carbon\Carbon;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Workorder
 * 
 * @property int $id
 * @property int $report_id
 * @property int $collector_id
 * @property int $status_id
 * @property int $priority_id
 * @property string $pictures
 * @property string $description
 * @property \Carbon\Carbon $started_on
 * @property \Carbon\Carbon $finished_on
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\Priority $priority
 * @property \App\Models\Report $report
 * @property \App\Models\Status $status
 *
 * @package App\Models
 */
class Workorder extends Eloquent
{
    const STATUS_OPEN = 'Abierto';
    const STATUS_CLOSED = 'Cerrado';
    const STATUS_COMPLETED = 'Finalizado';

	protected $casts = [
		'report_id' => 'int',
		'collector_id' => 'int',
		'status_id' => 'int',
		'priority_id' => 'int'
	];

	protected $dates = [
		'started_on',
		'completed_on'
	];

	protected $fillable = [
		'report_id',
		'collector_id',
		'status_id',
		'priority_id',
		'pictures',
		'description',
		'complete_description',
		'started_on',
		'completed_on'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'collector'   => 'required|exists:users,id',
                'priority'   => 'required|exists:priorities,id',
                'description' => 'required',
            ],
            $merge);
    }

    public function begin()
    {
        $this->started_on = Carbon::now();
        $this->save();
    }

    public function close()
    {
        $this->status_id = Status::where('name', Workorder::STATUS_CLOSED)->first()->id;
        $this->completed_on = Carbon::now();
        $this->save();
    }

    public function complete()
    {
        $this->status_id = Status::where('name', Workorder::STATUS_COMPLETED)->first()->id;
        $this->save();
    }

	public function collector()
	{
		return $this->belongsTo(User::class, 'collector_id');
	}

	public function priority()
	{
		return $this->belongsTo(Priority::class);
	}

	public function report()
	{
		return $this->belongsTo(Report::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}
}
