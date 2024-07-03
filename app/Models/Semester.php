<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'academic_year_id'
    ];

    /**
     * Get the AcademicYear that owns the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function AcademicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Get the account that owns the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get all of the payments for the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get all of the semesterDues for the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function semesterDues(): HasMany
    {
        return $this->hasMany(SemesterDues::class);
    }
}
