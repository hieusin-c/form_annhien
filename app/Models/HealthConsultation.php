<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthConsultation extends Model
{
    /** @use HasFactory<\Database\Factories\HealthConsultationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'gender',
        'age',
        'phone',
        'reason',
        'medical_history',
        'status',
        'admin_notes',
    ];
}
