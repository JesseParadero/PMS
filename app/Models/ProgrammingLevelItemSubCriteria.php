<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgrammingLevelItemSubCriteria extends Model
{
    use HasFactory;

    protected $table = 'programming_level_item_sub_criterias';
    protected $fillable = [
        'programming_level_item_criteria_id',
        'criteria_description',
    ];
}
