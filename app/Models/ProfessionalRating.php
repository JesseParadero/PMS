<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalRating extends Model
{
    use HasFactory;

    protected $table = 'professional_development_ratings';
    protected $fillable = [
        'description',
        'score',
    ];
}
