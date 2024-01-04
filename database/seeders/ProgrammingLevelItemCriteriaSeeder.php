<?php

namespace Database\Seeders;

use App\Models\ProgrammingLevelItemCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammingLevelItemCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criterialist = [
            ['1', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['1', 'Another Criteria Description'],
            ['1', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
            ['2', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['2', 'Another Criteria Description'],
            ['2', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
            ['3', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['3', 'Another Criteria Description'],
            ['3', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
            ['4', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['4', 'Another Criteria Description'],
            ['4', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
            ['5', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['5', 'Another Criteria Description'],
            ['5', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
            ['6', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['6', 'Another Criteria Description'],
            ['6', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
            ['7', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['7', 'Another Criteria Description'],
            ['7', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
            ['8', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['8', 'Another Criteria Description'],
            ['8', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
            ['9', 'Basic understanding of PHP, MySQL and web development fundamentals.'],
            ['9', 'Another Criteria Description'],
            ['9', 'Another basic understanding of PHP, MySQL and web development fundamentals.'],
        ];

        $criterias = [];

        foreach ($criterialist as $criteria) {
            $criterias[] = [
                'programming_level_item_id' => $criteria[0],
                'criteria_description' => $criteria[1],
            ];
        }

        ProgrammingLevelItemCriteria::inserting($criterias);
    }
}
