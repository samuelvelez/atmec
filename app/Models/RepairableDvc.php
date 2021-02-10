<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairableDvc extends Model
{
    protected $table = 'repairables';

    protected $fillable = [
        'report_id',
        'repairable_type',
        'repairable_id'
    ];


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
