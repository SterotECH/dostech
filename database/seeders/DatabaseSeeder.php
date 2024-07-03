<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Account;
use App\Models\Classes;
use App\Models\Department;
use App\Models\House;
use App\Models\HouseMaster;
use App\Models\Payment;
use App\Models\Semester;
use App\Models\SemesterDues;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Builder\Class_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AcademicYear::factory(3)->create();
        Semester::factory(6)->create();
        SemesterDues::factory(6)->create();

        House::factory(5)->create();
        HouseMaster::factory(10)->create();

        User::factory(2)->admin()->create();
        Department::factory(7)->create();
        Classes::factory(39)->create();

        Student::factory(1000)->create();

        Payment::factory(1000)->create();
        Account::factory(2)->create();
    }
}
