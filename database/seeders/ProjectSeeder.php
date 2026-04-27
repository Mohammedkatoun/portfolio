<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->first();
        if (!$user) {
            return;
        }

        $projects = [
            [
                'title' => 'E‑Commerce API (Laravel)',
                'description' => 'REST API for products, carts, orders, payments, and admin management with clean validation & auth.',
                'long_description' => "Built a production-style e‑commerce backend with order lifecycle, stock handling, and role-based admin endpoints.\n\nIncludes pagination, filtering, request validation, and consistent error responses.",
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'REST', 'Sanctum'],
                'status' => 'completed',
            ],
            [
                'title' => 'Booking System Dashboard',
                'description' => 'Admin dashboard for booking management: availability, reservations, invoices, and customer messages.',
                'long_description' => "Designed database schema for bookings and time slots, and implemented admin workflows.\n\nFocused on clean UI, reliable validations, and easy management.",
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Blade', 'Tailwind'],
                'status' => 'completed',
            ],
            [
                'title' => 'Inventory & POS Backend',
                'description' => 'Backend services for inventory tracking, purchases, sales, and reporting with optimized queries.',
                'long_description' => "Implemented stock movements, audit logs, and reporting queries with indexes for speed.\n\nAdded export-ready endpoints and clear data integrity rules.",
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Redis'],
                'status' => 'completed',
            ],
            [
                'title' => 'Multi‑Tenant SaaS Starter',
                'description' => 'Multi-tenant foundation: organizations, users, roles/permissions, and tenant-scoped data access.',
                'long_description' => "Created a starter template for SaaS applications with tenant isolation.\n\nIncludes policies, middleware-based tenant context, and structured services.",
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Policies'],
                'status' => 'in_progress',
            ],
            [
                'title' => 'Background Jobs & Queue System',
                'description' => 'Async processing for emails, reports, imports, and scheduled tasks with retries and logging.',
                'long_description' => "Added queue-based pipelines for long-running tasks.\n\nFocused on reliability: retry policies, idempotency considerations, and clear observability.",
                'technologies' => ['Laravel', 'Queues', 'Redis', 'Cron'],
                'status' => 'completed',
            ],
            [
                'title' => 'Authentication & Authorization Kit',
                'description' => 'Reusable auth module with role/permission checks, policies, rate limiting, and secure endpoints.',
                'long_description' => "A small internal kit for standardizing authentication patterns across projects.\n\nIncludes policies, middleware, and consistent access control.",
                'technologies' => ['Laravel', 'Sanctum', 'Policies', 'Security'],
                'status' => 'completed',
            ],
            [
                'title' => 'CSV Importer with Validation',
                'description' => 'Robust CSV import flow with preview, validation errors, and async processing for big files.',
                'long_description' => "Implemented a safe import pipeline with validation, error reporting, and background processing.\n\nDesigned for large files and consistent data quality.",
                'technologies' => ['Laravel', 'Queues', 'Validation'],
                'status' => 'completed',
            ],
            [
                'title' => 'API Monitoring & Logging Setup',
                'description' => 'Structured logs, request tracing, and practical error reporting for Laravel apps.',
                'long_description' => "Added structured logging, correlation IDs, and actionable error messages.\n\nImproves debugging and operational visibility.",
                'technologies' => ['Laravel', 'Logging', 'Monitoring'],
                'status' => 'planning',
            ],
            [
                'title' => 'Portfolio CMS (Admin)',
                'description' => 'Admin CRUD for projects and skills with publishing status, ordering, and images.',
                'long_description' => "Built a simple CMS-like admin area to manage portfolio content.\n\nIncludes image uploads, ordering, and published listings.",
                'technologies' => ['Laravel', 'CRUD', 'Blade', 'MySQL'],
                'status' => 'completed',
            ],
        ];

        foreach ($projects as $i => $p) {
            Project::query()->updateOrCreate(
                ['user_id' => $user->id, 'title' => $p['title']],
                [
                    'description' => $p['description'],
                    'long_description' => $p['long_description'],
                    'technologies' => $p['technologies'],
                    'status' => $p['status'],
                    'order' => $i + 1,
                ]
            );
        }
    }
}

