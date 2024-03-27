<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeReport extends Model
{
    use HasFactory;
    protected $table = 'daily_report_logs';
    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'date',
        'is_closed'
    ];
    public $timestamps = false;
}
