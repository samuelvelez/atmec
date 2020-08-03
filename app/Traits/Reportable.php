<?php

namespace App\Traits;

use App\Models\Report;

trait Reportable
{
    protected $tags = [];

    public function set_report(Report $report)
    {
        $this->tags[] = 'report_' . $report->id;
    }
}
