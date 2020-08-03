<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetricUnit extends Model
{
    protected $table = 'metric_units';
    protected $fillable = [
        'name',
        'abbreviation',
        'description',
    ];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'name' => 'required|max:50',
                'abbreviation' => 'required|max:5',
            ],
            $merge);
    }

    public function material() {
        return $this->hasMany(Material::class);
    }
    
    public function ost() {
        return $this->hasMany(Stock_personal::class);
    }
    
}
