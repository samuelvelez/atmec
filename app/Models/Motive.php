<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alert;

class Motive extends Model
{
    protected $table = 'motives';

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

    public function alert()
    {
        return $this->hasOne(Alert::class);
    }
}
