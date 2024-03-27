<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReportDetails extends Model
{
    use HasFactory;

    protected $table = 'daily_report_details';
    protected $fillable = [
        'user_id',
        'daily_log_id',
        'start_time',
        'end_time',
        'work_title',
        'work_details'
    ];

    public $timestamps = false;
}
