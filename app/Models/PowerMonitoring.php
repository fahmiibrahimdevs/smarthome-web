<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerMonitoring extends Model
{
    use HasFactory;
    protected $table = "power_monitoring";
    protected $guarded = [];
}
