<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skilldata = [
            ['name_skill' => 'Dr'],
            ['name_skill' => 'Dra'],
        ];

        foreach ($skilldata as $data) {
            Skill::create($data);
        }
    }
}
