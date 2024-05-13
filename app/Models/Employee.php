<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'employee_id',
        'full_name',
        'image',
        'address',
        'contact_number',
        'nid_number',
        'email',
        'date_of_birth',

        'position_title',
        'department',
        'start_date',
        'employment_status',
        'work_location',
        'salary',
        'site_manager_name',
        'manager_contact',
    ];
    
    public function salaries()
    {   
        return $this->hasMany(Salary::class);
    }

    
    
}
