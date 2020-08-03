<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priorities';

    protected $fillable = [
        'name',
        'description'
    ];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'name' => 'required|max:50',
            ],
            $merge);
    }

    public function workorder()
    {
        return $this->hasMany(WorkOrder::class);
    }

}
