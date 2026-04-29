<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->first();

        if (!$user) {
            $this->command?->warn('No user found. Skipping projects.');
            return;
        }

        $projects = [
            [
                'title' => 'Portfolio Website',
                'description' => 'Personal portfolio built with Laravel and Blade.',
                'long_description' => 'A clean portfolio website showcasing projects, skills, and contact information.',
                'github_url' => 'https://github.com/example/portfolio',
                'live_url' => null,
                'technologies' => ['Laravel', 'Blade', 'SQLite', 'Tailwind CSS'],
                'status' => 'completed',
            ],
            [
                'title' => 'Projects Showcase',
                'description' => 'Projects listing with filters and search.',
                'long_description' => 'Includes pagination, technology filter, and full project details page.',
                'github_url' => 'https://github.com/example/projects-showcase',
                'live_url' => null,
                'technologies' => ['Laravel', 'Eloquent', 'Pagination'],
                'status' => 'in_progress',
            ],
            [
                'title' => 'Contact Form',
                'description' => 'Contact form with validation and persistence.',
                'long_description' => 'A simple contact form that stores messages and can be extended to send emails.',
                'github_url' => null,
                'live_url' => null,
                'technologies' => ['Laravel', 'Validation'],
                'status' => 'planning',
            ],
        ];

        foreach ($projects as $i => $project) {
            Project::query()->updateOrCreate(
                [
                    'user_id' => $user->id,
                    'title' => $project['title'],
                ],
                [
                    'description' => $project['description'],
                    'long_description' => $project['long_description'],
                    'image' => null,
                    'github_url' => $project['github_url'],
                    'live_url' => $project['live_url'],
                    'technologies' => $project['technologies'],
                    'status' => $project['status'],
                    'published' => true,
                    'order' => $i + 1,
                ]
            );
        }
    }
}

