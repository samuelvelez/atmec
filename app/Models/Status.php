<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alert;

class Status extends Model
{
    protected $table = 'statuses';

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
        return $this->hasMany(Alert::class);
    }

    public function report()
    {
        return $this->hasMany(Report::class);
    }

    public function workorder()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function ost()
    {
        return $this->hasMany(ost::class);
    }

}
