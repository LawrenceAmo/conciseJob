<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emrecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_number',
        'first_name',
        'last_name',
        'dob',
        'position',
        'start_date',
        'department',
        'annual_salary',
        'manager_employee_number',
        'project_c1',
        'ptoject_c2',
        'project_c3',
        'email',
    ];
}
