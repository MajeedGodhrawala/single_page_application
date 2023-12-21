<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast;

class TempAttendanceDetails extends Model
{
    use HasFactory;
    protected $table = 'temp_attendance_details';
    protected $guarded = [];
    protected $casts = [
        'VDateTime' => 'date'
    ];
}
