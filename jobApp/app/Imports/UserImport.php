<?php

namespace App\Imports;

use App\emrecords;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

HeadingRowFormatter::default('none');

  class UserImport implements ToModel, WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            return new emrecords([
                'employee_number' => $row['Employee Number'],
                'first_name' => $row['First Name'],
                'last_name' => $row['Surname'],
                'dob' => $row['Date of Birth'],
                'position' => $row['Position'],
                'start_date' => $row['Start Date'],
                'department' => $row['Department'],
                'annual_salary' => $row['Annual Salary'],
                'manager_employee_number' => $row['Manager Employee Number'],
                'project_c1' => $row['Project Code 1'],
                'ptoject_c2' => $row['Project Code 2'],
                'project_c3' => $row['Project Code 3'],
                'email' => '',                
            ]);        
    }

    public function headingRow(): int
    {
        return 1;
    }

}




