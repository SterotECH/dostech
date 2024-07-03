<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'other_name' => $row['other_name'],
            'house_id' => $row['house_id'],
            'classes_id' => $row['classes_id'],
            'department_id' => $row['department_id'],
            'gender' => $row['gender'],
            'registration_number' => $row['registration_number'],
        ]);
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'other_name' => 'nullable',
            'house_id' => 'required',
            'classes_id' => 'required',
            'gender' => 'required',
            'department_id' => 'required',
            'registration_number' => 'required',
        ];
    }
}
