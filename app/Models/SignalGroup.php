<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SignalGroup
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $signal_subgroups
 *
 * @package App\Models
 */
class SignalGroup extends Eloquent
{
    protected $table = 'signal_groups';

    protected $fillable = [
        'code',
        'name',
        'description'
    ];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'code' => 'max:50|unique:signal_groups,code',
                'name' => 'required|max:50',
                'description' => 'max:50',
            ],
            $merge);
    }

    public function subgroups()
    {
        return $this->hasMany(SignalSubgroup::class, 'group_id');
    }
}
