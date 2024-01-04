<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeEvaluation extends Model
{
    use HasFactory;

    protected $table = 'employee_evaluations';

    protected $fillable = [
        'employee_id',
        'programming_id',
        'programming_type',
        'evaluation_date',
        'total_score',
    ];
}
