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
class SignalSubgroup extends Eloquent
{
    protected $table = 'signal_subgroups';

	protected $casts = [
		'group_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'code',
		'name',
		'shape',
		'colors',
		'description'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'code' => 'max:50|unique:signal_groups,code',
                'name' => 'required|max:50',
                'group' => 'required|numeric',
                'shape' => 'required|max:50',
                'description' => 'max:50',
            ],
            $merge);
    }

	public function group()
	{
		return $this->belongsTo(SignalGroup::class, 'group_id');
	}

	public function signals_types()
	{
		return $this->hasMany(SignalInventory::class, 'subgroup_id');
	}
}
