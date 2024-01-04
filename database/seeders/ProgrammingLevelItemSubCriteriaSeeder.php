<?php

namespace Database\Seeders;

use App\Models\ProgrammingLevelItemSubCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammingLevelItemSubCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcriterialist = [
            ['1', 'PHP'],
            ['1', 'PHP Syntax and Concepts'],
            ['1', 'MySQL Fundamentals'],
            ['1', 'HTML and CSS Basics'],
            ['1', 'JavaScript Basics'],
            ['2', 'PHP'],
            ['2', 'PHP Syntax and Concepts'],
            ['2', 'MySQL Fundamentals'],
            ['2', 'HTML and CSS Basics'],
            ['2', 'JavaScript Basics'],
            ['3', 'PHP'],
            ['3', 'PHP Syntax and Concepts'],
            ['3', 'MySQL Fundamentals'],
            ['3', 'HTML and CSS Basics'],
            ['3', 'JavaScript Basics'],
            ['4', 'PHP'],
            ['4', 'PHP Syntax and Concepts'],
            ['4', 'MySQL Fundamentals'],
            ['4', 'HTML and CSS Basics'],
            ['4', 'JavaScript Basics'],
            ['5', 'PHP'],
            ['5', 'PHP Syntax and Concepts'],
            ['5', 'MySQL Fundamentals'],
            ['5', 'HTML and CSS Basics'],
            ['5', 'JavaScript Basics'],
            ['6', 'PHP'],
            ['6', 'PHP Syntax and Concepts'],
            ['6', 'MySQL Fundamentals'],
            ['6', 'HTML and CSS Basics'],
            ['6', 'JavaScript Basics'],
            ['7', 'PHP'],
            ['7', 'PHP Syntax and Concepts'],
            ['7', 'MySQL Fundamentals'],
            ['7', 'HTML and CSS Basics'],
            ['7', 'JavaScript Basics'],
            ['8', 'PHP'],
            ['8', 'PHP Syntax and Concepts'],
            ['8', 'MySQL Fundamentals'],
            ['8', 'HTML and CSS Basics'],
            ['8', 'JavaScript Basics'],
            ['9', 'PHP'],
            ['9', 'PHP Syntax and Concepts'],
            ['9', 'MySQL Fundamentals'],
            ['9', 'HTML and CSS Basics'],
            ['9', 'JavaScript Basics'],
        ];

        $subcriterias = [];

        foreach ($subcriterialist as $subcriteria) {
            $subcriterias[] = [
                'programming_level_item_criteria_id' => $subcriteria[0],
                'criteria_description' => $subcriteria[1],
            ];
        }

        ProgrammingLevelItemSubCriteria::inserting($subcriterias);
    }
}
