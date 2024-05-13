<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'date' ,'entryTime', 'exitTime', 'remarks'];

    public function user()

    {
        return $this->belongsTo(User::class);
    }
}
