<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_dtls',
        'date',
        'user_id'
    ];
}
