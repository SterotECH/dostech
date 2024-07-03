<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Semester>
 */
class SemesterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $academicYear = \App\Models\AcademicYear::inRandomOrder()->first();
        $startDate = $academicYear->start_date;

        // Calculate the end date of the first semester (4 months after start date)
        $firstSemesterEndDate = Carbon::parse($startDate)->addMonths(4)->format('Y-m-d');

        // Get the current date
        $currentDate = Carbon::now();

        if ($currentDate->gte(Carbon::parse($startDate)) && $currentDate->lte(Carbon::parse($firstSemesterEndDate))) {
            // If current date is within the first semester period
            $semesterName = 'first_semester';
            $semesterStartDate = $startDate;
            $semesterEndDate = $firstSemesterEndDate;
        } else {
            // If current date is after the first semester period, create second semester
            $secondSemesterStartDate = Carbon::parse($firstSemesterEndDate)->addMonths(rand(1, 2))->format('Y-m-d');
            $secondSemesterEndDate = Carbon::parse($secondSemesterStartDate)->addMonths(rand(4, 5))->format('Y-m-d');

            $semesterName = 'second_semester';
            $semesterStartDate = $secondSemesterStartDate;
            $semesterEndDate = $secondSemesterEndDate;
        }

        return [
            'name' => $semesterName,
            'start_date' => $semesterStartDate,
            'end_date' => $semesterEndDate,
            'academic_year_id' => $academicYear->id,
        ];
    }
}
