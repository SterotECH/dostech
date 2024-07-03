<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'student_id',
        'semester_id',
        'house_master_id',
        'classes_id',
        'amount_paid',
        'remaining_balance',
        'payment_date',
        'payment_method',
        'reference_number',
    ];

    /**
     * Get the Student that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the houseMaster that accepted the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function houseMaster(): BelongsTo
    {
        return $this->belongsTo(HouseMaster::class);
    }

    /**
     * Get the class that the student was in when making the payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    /**
     * Get the semester that the was in during Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }
}
