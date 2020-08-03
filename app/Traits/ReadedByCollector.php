<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ReadedByCollector
{
    public function mask_as_read()
    {
        if ($this->collector_id == Auth::user()->id) {
            $this->readed_on = Carbon::now();
            $this->save();
        }
    }
}
