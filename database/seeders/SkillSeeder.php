<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->first();
        if (!$user) {
            return;
        }

        $skills = [
            // Backend
            ['name' => 'PHP', 'category' => 'Backend', 'proficiency' => 90],
            ['name' => 'Laravel', 'category' => 'Backend', 'proficiency' => 90],
            ['name' => 'REST APIs', 'category' => 'Backend', 'proficiency' => 88],
            ['name' => 'Auth (Sanctum)', 'category' => 'Backend', 'proficiency' => 82],
            ['name' => 'Validation & Policies', 'category' => 'Backend', 'proficiency' => 80],

            // Database
            ['name' => 'MySQL', 'category' => 'Database', 'proficiency' => 88],
            ['name' => 'Query Optimization', 'category' => 'Database', 'proficiency' => 78],
            ['name' => 'Database Design', 'category' => 'Database', 'proficiency' => 80],
            ['name' => 'Redis (Caching)', 'category' => 'Database', 'proficiency' => 70],

            // DevOps
            ['name' => 'Docker', 'category' => 'DevOps', 'proficiency' => 70],
            ['name' => 'Linux Basics', 'category' => 'DevOps', 'proficiency' => 72],
            ['name' => 'CI/CD Basics', 'category' => 'DevOps', 'proficiency' => 62],
            ['name' => 'Nginx/Apache', 'category' => 'DevOps', 'proficiency' => 60],

            // Tools
            ['name' => 'Git', 'category' => 'Tools', 'proficiency' => 82],
            ['name' => 'Postman', 'category' => 'Tools', 'proficiency' => 78],
            ['name' => 'Composer & NPM', 'category' => 'Tools', 'proficiency' => 75],
            ['name' => 'Debugging', 'category' => 'Tools', 'proficiency' => 80],

            // Frontend (basic)
            ['name' => 'Blade', 'category' => 'Frontend', 'proficiency' => 76],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'proficiency' => 68],
            ['name' => 'HTML/CSS', 'category' => 'Frontend', 'proficiency' => 75],
        ];

        foreach ($skills as $i => $s) {
            Skill::query()->updateOrCreate(
                ['user_id' => $user->id, 'name' => $s['name']],
                [
                    'category' => $s['category'],
                    'proficiency' => $s['proficiency'],
                    'order' => $i + 1,
                ]
            );
        }
    }
}

