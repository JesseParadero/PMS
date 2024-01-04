<?php

namespace Database\Seeders;

use App\Models\ProgrammingLevelItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammingLevelItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levelList = [
            ['1', '1', 'BEGINNER', '1', '100'],
            ['1', '1', 'INTERMEDIATE', '2', '120'],
            ['1', '1', 'ADVANCED', '3', '130'],
            ['2', '1', 'BEGINNER', '4', '150'],
            ['2', '1', 'EXPERT', '5', '50'],
            ['2', '1', 'MASTER', '6', '70'],
            ['3', '1', 'BEGINNER', '7', '80'],
            ['3', '1', 'MASTER', '8', '90'],
            ['3', '1', 'EXPERT', '9', '100'],

        ];

        $levels = [];

        foreach ($levelList as $level) {
            $levels[] = [
                'language_id' => $level[0],
                'language_type' => $level[1],
                'item_name' => $level[2],
                'rank_number' => $level[3],
                'total_score' => $level[4],
            ];
        }

        ProgrammingLevelItem::inserting($levels);
    }
}
