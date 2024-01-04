<?php

namespace Database\Seeders;

use App\Models\ProgrammingLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammingLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languagelist = [
            'PHP',
            'Python',
            'Java',
            'C',
            'C++',
            'C#',
        ];

        foreach ($languagelist as $language) {
            ProgrammingLanguage::create([
                'language_name' => $language,
            ]);
        }
    }
}
