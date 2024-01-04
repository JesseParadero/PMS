<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgrammingLevelItemCriteria extends Model
{
    use HasFactory;

    protected $table = 'programming_level_item_criterias';
    protected $fillable = [
        'programming_level_item_id',
        'criteria_description',
    ];

    public function subCriterias(): HasMany
    {
        return $this->hasMany(ProgrammingLevelItemSubCriteria::class, 'programming_level_item_criteria_id', 'id');
    }
}
