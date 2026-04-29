<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchGitHubProjects extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'projects:fetch-github
        {--username= : GitHub username (defaults to env GITHUB_USERNAME)}
        {--limit=30 : Max repos to fetch}
        {--include-forks : Include forked repositories}';

    /**
     * The description of the console command.
     *
     * @return string
     */
    protected $description = 'Fetch and sync public repos from GitHub user Mohammedkatoun';


    /**
     * Execute the console command.
     */
    public function handle(): int

    {
        $username = (string) ($this->option('username') ?: config('services.github.username', 'Mohammedkatoun'));
        $limit = (int) $this->option('limit');
        $includeForks = (bool) $this->option('include-forks');

        $this->info("Fetching public repos from github.com/{$username}...");

        // Fetch repos via GitHub API (60 req/hr unauth limit)
        $request = Http::acceptJson()
            ->withHeaders([
                'User-Agent' => config('app.name', 'Laravel'),
            ])
            ->withOptions([
                'verify' => (bool) config('services.github.verify_ssl', true),
            ]);

        $token = (string) config('services.github.token', '');
        if ($token !== '') {
            $request = $request->withToken($token);
        }

        $response = $request->get("https://api.github.com/users/{$username}/repos", [
            'per_page' => $limit,
            'sort' => 'updated',
            'direction' => 'desc',
        ]);

        if ($response->failed()) {
            $this->error('GitHub API request failed: ' . $response->status());
            return 1;
        }

        $repos = $response->json();
        $this->info("Found " . count($repos) . " repos.");

        $bar = $this->output->createProgressBar(count($repos));
        $bar->start();

        foreach ($repos as $repo) {
            $isFork = (bool) ($repo['fork'] ?? false);
            $language = $repo['language'] ?? null;

            // Skip non-code repos and forks (unless requested)
            if (empty($language) || (!$includeForks && $isFork)) {
                $bar->advance();
                continue;
            }

            $htmlUrl = (string) ($repo['html_url'] ?? '');
            $name = (string) ($repo['name'] ?? 'repo');
            $description = $repo['description'] ?? null;

            // Prefer human-ish title for portfolio cards
            $title = Str::of($name)
                ->replace('-', ' ')
                ->replace('_', ' ')
                ->title()
                ->toString();

            // Upsert based on github_id (unique)
            Project::updateOrCreate(
                ['github_id' => $repo['id']],
                [
                    'title' => $title,
                    'name' => $repo['name'],
                    'html_url' => $htmlUrl,
                    'description' => Str::limit($description ?: 'No description provided.', 200),
                    'github_url' => $htmlUrl,
                    'technologies' => array_values(array_filter([$language])),
                    'status' => 'completed',
                    'published' => true,
                    'language' => $language,
                    'stargazers_count' => $repo['stargazers_count'],
                    'forks_count' => $repo['forks_count'],
                ]
            );

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Synced successfully! Check /projects.');

        return 0;
    }
}
