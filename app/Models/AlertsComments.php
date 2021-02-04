<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alert;

class AlertsComments extends Model
{
    protected $table = 'alerts_comments';

    protected $fillable = [
        'alert_id',
        'comment_old',
        'user_create'
    ];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'comment_old' => 'required',
            ],
            $merge);
    }

//    public function alert()
//    {
//        return $this->hasMany(Alert::class);
//    }
//
//    public function report()
//    {
//        return $this->hasMany(Report::class);
//    }
//
//    public function workorder()
//    {
//        return $this->hasMany(WorkOrder::class);
//    }
//
//    public function ost()
//    {
//        return $this->hasMany(ost::class);
//    }

}
