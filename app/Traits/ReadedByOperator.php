<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ReadedByOperator
{
    public function mask_as_read()
    {
        if (Auth::user()->hasRole('atmoperator')) {
            $this->readed_on = Carbon::now();
            $this->save();
        }
    }
}
