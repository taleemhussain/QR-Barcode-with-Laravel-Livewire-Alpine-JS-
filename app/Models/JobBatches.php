<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobBatches extends Model
{
    protected $table = 'job_batches';
    protected $fillable = [
        'name',
        'total_jobs',
        'pending_jobs',
        'total_records',
        'total_added',
        'failed_jobs',
        'failed_job_ids',
        'options',
        'cancelled_at',
        'created_at',
        'finished_at'
    ];
}
