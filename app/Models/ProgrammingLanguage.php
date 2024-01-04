<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgrammingLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_name'
    ];

    /*======================================================================
    .* RELATIONSHIPS
    .*======================================================================*/

    public function levels(): HasMany
    {
        return $this->hasMany(ProgrammingLevelItem::class, 'language_id', 'id');
    }
}
