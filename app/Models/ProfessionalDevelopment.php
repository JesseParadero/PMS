<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalDevelopment extends Model
{
    use HasFactory;
    protected $table = 'professional_development_criterias';
    protected $fillable = [
        'criteria_description'
    ];
}
