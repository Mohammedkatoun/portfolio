<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class SampleGitHubProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $repos = [
            [
                'github_id' => 1000001,
                'name' => 'laravel-portfolio',
                'html_url' => 'https://github.com/example/laravel-portfolio',
                'language' => 'PHP',
                'stargazers_count' => 12,
                'forks_count' => 3,
                'description' => 'A sample GitHub project seeded locally.',
            ],
            [
                'github_id' => 1000002,
                'name' => 'api-starter',
                'html_url' => 'https://github.com/example/api-starter',
                'language' => 'PHP',
                'stargazers_count' => 25,
                'forks_count' => 6,
                'description' => 'A sample API starter project.',
            ],
        ];

        foreach ($repos as $i => $repo) {
            Project::query()->updateOrCreate(
                ['github_id' => $repo['github_id']],
                [
                    'user_id' => null,
                    'title' => null,
                    'name' => $repo['name'],
                    'html_url' => $repo['html_url'],
                    'description' => $repo['description'],
                    'long_description' => null,
                    'image' => null,
                    'github_url' => $repo['html_url'],
                    'live_url' => null,
                    'technologies' => null,
                    'status' => 'completed',
                    'order' => 100 + $i,
                    'language' => $repo['language'],
                    'stargazers_count' => $repo['stargazers_count'],
                    'forks_count' => $repo['forks_count'],
                    'published' => true,
                ]
            );
        }
    }
}

