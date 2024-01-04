<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgrammingLevelItem extends Model
{
    use HasFactory;

    const TYPE_INVALID = 0;
    const TYPE_PROGRAMMING_LANGUAGE = 1;
    const TYPE_FRAMEWORK = 2;

    protected $fillable = [
        'language_id',
        'language_type',
        'item_name',
        'rank_number',
        'total_score'
    ];

    public function criterias(): HasMany
    {
        return $this->hasMany(ProgrammingLevelItemCriteria::class, 'programming_level_item_id', 'id');
    }
}
