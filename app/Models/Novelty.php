<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novelty extends Model
{
    protected $table = 'novelties';
    protected $fillable = [
        'name', 
        'subcategory',
        'group'
    ];

    public function report() {
        return $this->hasMany(Report::class);
    }

}
