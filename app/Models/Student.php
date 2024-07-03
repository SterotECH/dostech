<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'first_name',
        'other_name',
        'last_name',
        'date_of_birth',
        'gender',
        'dues_owed',
        'is_active',
        'has_completed',
        'valid_until',
        'house_id',
        'department_id',
        'classes_id',
        'registration_number'
    ];

    /**
     * Get the house that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    /**
     * Get the department that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the classes that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    /**
     * Get all of the payments for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the full name of the student
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return trim(
            $this->first_name . ' ' .
                ($this->other_name ? $this->other_name . ' ' : '') .
                $this->last_name
        );
    }

    /**
     * Get the dues owed attribute
     *
     * @param  string  $value
     * @return string
     */
    public function getDuesOwedAttribute($value)
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($value, 'GHS');
    }
}
