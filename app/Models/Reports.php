<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $table = 'report_table';
    protected $fillable = [
        'user_id',
        'daily_log_id',
        'date',
        'start_time',
        'end_time',
        'work_type',
        'work_title',
        'work_details',
        'day_start_time',
        'day_end_time'
    ];

    public $timestamps = false;
}
