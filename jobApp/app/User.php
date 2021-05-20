<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // public function setDateFormat($value)
    // {
    //    $this->attributes['dob'] = date_format($valu, "Y/m/d");
    // }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
