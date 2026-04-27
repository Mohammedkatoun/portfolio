@extends('layouts.app')

@section('title', 'Home - Backend Developer')

@section('content')
@php
    $featuredProjects = \App\Models\Project::published()->take(6)->get();
    $skillCategories = [
        'Backend' => ['icon' => 'fa-server'],
        'Database' => ['icon' => 'fa-database'],
        'DevOps' => ['icon' => 'fa-gears'],
        'Tools' => ['icon' => 'fa-wrench'],
        'Frontend' => ['icon' => 'fa-layer-group'],
    ];
@endphp

<section class="relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-40 left-1/2 h-[520px] w-[520px] -translate-x-1/2 rounded-full bg-sky-500/20 blur-3xl"></div>
        <div class="absolute -bottom-56 right-[-120px] h-[520px] w-[520px] rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.08),transparent_52%)]"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-24">
        <div class="max-w-2xl">
            <div class="inline-flex flex-wrap items-center gap-2">
                <span class="chip"><i class="fas fa-bolt"></i> Backend • Laravel • APIs</span>
                <span class="chip"><i class="fas fa-shield-halved"></i> Clean architecture</span>
                <span class="chip"><i class="fas fa-gauge-high"></i> Performance</span>
            </div>

            <h1 class="mt-6 text-balance text-4xl font-semibold tracking-tight text-white sm:text-6xl">
                I build reliable backend systems with Laravel & PHP.
            </h1>
            <p class="mt-5 max-w-prose text-pretty text-base leading-7 text-white/70 sm:text-lg">
                I design APIs, databases, and scalable services with a focus on maintainability, security, and speed.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                <a href="{{ route('projects.index') }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i>
                    View projects
                </a>
                <a href="{{ route('contact.create') }}" class="btn btn-ghost">
                    <i class="fas fa-envelope"></i>
                    Contact me
                </a>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-3">
                <div class="card p-5">
                    <p class="text-xs font-semibold tracking-wide text-white/60">Focus</p>
                    <p class="mt-2 text-sm font-semibold text-white/90">APIs & business logic</p>
                    <p class="mt-2 text-sm text-white/60">REST, auth, validation, jobs/queues.</p>
                </div>
                <div class="card p-5">
                    <p class="text-xs font-semibold tracking-wide text-white/60">Strength</p>
                    <p class="mt-2 text-sm font-semibold text-white/90">Database design</p>
                    <p class="mt-2 text-sm text-white/60">Indexes, relations, migrations, caching.</p>
                </div>
                <div class="card p-5">
                    <p class="text-xs font-semibold tracking-wide text-white/60">Delivery</p>
                    <p class="mt-2 text-sm font-semibold text-white/90">Production readiness</p>
                    <p class="mt-2 text-sm text-white/60">Logging, monitoring, CI/CD basics.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
    <div class="flex items-end justify-between gap-6">
        <div>
            <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Featured projects</h2>
            <p class="mt-2 text-sm text-white/60">A few things I’ve built recently.</p>
        </div>
        <a href="{{ route('projects.index') }}" class="hidden text-sm font-semibold text-sky-300 hover:text-sky-200 sm:inline-flex">
            View all <span aria-hidden="true">→</span>
        </a>
    </div>

    <div class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        @forelse($featuredProjects as $project)
            <article class="card card-hover overflow-hidden">
                <div class="relative h-44 w-full overflow-hidden bg-white/[0.04]">
                    @if($project->image)
                        <img
                            src="{{ asset('storage/' . $project->image) }}"
                            alt="{{ $project->title }}"
                            class="h-full w-full object-cover"
                            loading="lazy"
                        >
                    @else
                        <div class="grid h-full w-full place-items-center">
                            <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white/5 text-white/70">
                                <i class="fas fa-laptop"></i>
                            </span>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-white/90">{{ $project->title }}</h3>
                        <span class="chip">
                            @if($project->status === 'completed')
                                <i class="fas fa-circle-check text-emerald-300"></i> Completed
                            @elseif($project->status === 'in_progress')
                                <i class="fas fa-spinner text-amber-300"></i> In progress
                            @else
                                <i class="fas fa-lightbulb text-sky-300"></i> Planning
                            @endif
                        </span>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-white/65">{{ \Illuminate\Support\Str::limit($project->description, 120) }}</p>

                    @if(is_array($project->technologies) && count($project->technologies))
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach(array_slice($project->technologies, 0, 4) as $tech)
                                <span class="chip">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-5">
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-ghost w-full">
                            View details <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="card p-10 text-center text-white/70 md:col-span-2 lg:col-span-3">
                No projects yet. After seeding, you’ll see a full grid here.
            </div>
        @endforelse
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 pb-16 sm:px-6">
    <div class="flex items-end justify-between gap-6">
        <div>
            <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Skills</h2>
            <p class="mt-2 text-sm text-white/60">My toolkit, grouped by category.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-5 md:grid-cols-2">
        @foreach($skillCategories as $category => $meta)
            @php
                $skills = \App\Models\Skill::byCategory($category)->get();
            @endphp

            <div class="card p-6">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-2xl bg-white/5 text-white/80">
                            <i class="fas {{ $meta['icon'] }}"></i>
                        </span>
                        <h3 class="text-sm font-semibold tracking-wide text-white/90">{{ $category }}</h3>
                    </div>
                    <span class="text-xs font-semibold text-white/50">{{ $skills->count() }} skills</span>
                </div>

                <div class="mt-5 space-y-3">
                    @forelse($skills as $skill)
                        <div>
                            <div class="flex items-center justify-between gap-4">
                                <p class="text-sm font-semibold text-white/80">{{ $skill->name }}</p>
                                <p class="text-xs font-semibold text-white/50">{{ $skill->proficiency }}%</p>
                            </div>
                            <div class="mt-2 h-2 w-full rounded-full bg-white/5">
                                <div class="h-2 rounded-full bg-gradient-to-r from-sky-400 to-indigo-500" style="width: {{ max(10, min(100, (int) $skill->proficiency)) }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-white/60">
                            Add skills for <span class="font-semibold text-white/80">{{ $category }}</span> (or run the seeders I’m adding).
                        </p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
