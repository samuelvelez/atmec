<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Itorder
 * 
 * @property int $id
 * @property int $collector_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $material_itorders
 *
 * @package App\Models
 */
class Itorder extends Eloquent
{
	protected $casts = [
		'collector_id' => 'int'
	];

	protected $fillable = [
		'collector_id'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'collector'   => 'required|numeric',
            ],
            $merge);
    }

	public function collector()
	{
		return $this->belongsTo(User::class, 'collector_id');
	}

	public function materials()
	{
		return $this->hasMany(ItorderMaterial::class);
	}
}
