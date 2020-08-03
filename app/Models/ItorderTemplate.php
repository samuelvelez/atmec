<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ItoTemplate
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $device_templates
 *
 * @package App\Models
 */
class ItorderTemplate extends Eloquent
{
    protected $table = 'itorder_templates';

	protected $fillable = [
		'name',
		'description'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'name'   => 'required|max:50',
            ],
            $merge);
    }

	public function materials()
	{
		return $this->hasMany(MaterialTemplate::class, 'template_id');
	}
}
