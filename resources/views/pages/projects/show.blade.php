@extends('layouts.app')

@section('title', $project->title . ' - Project')

@section('content')
<section class="relative overflow-hidden border-b border-white/10">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-56 left-[-120px] h-[520px] w-[520px] rounded-full bg-sky-500/20 blur-3xl"></div>
        <div class="absolute -bottom-56 right-[-120px] h-[520px] w-[520px] rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.08),transparent_52%)]"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-18">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
            <div class="max-w-2xl">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-white/60 hover:text-white/80">
                    <span aria-hidden="true">←</span> Back to projects
                </a>
                <h1 class="mt-4 text-balance text-3xl font-semibold tracking-tight text-white sm:text-5xl">
                    {{ $project->title }}
                </h1>
                <p class="mt-4 text-pretty text-sm leading-6 text-white/70 sm:text-base">
                    {{ $project->description }}
                </p>

                <div class="mt-6 flex flex-wrap items-center gap-2">
                    <span class="chip">
                        @if($project->status === 'completed')
                            <i class="fas fa-circle-check text-emerald-300"></i> Completed
                        @elseif($project->status === 'in_progress')
                            <i class="fas fa-spinner text-amber-300"></i> In progress
                        @else
                            <i class="fas fa-lightbulb text-sky-300"></i> Planning
                        @endif
                    </span>
                    <span class="chip"><i class="fas fa-calendar"></i> {{ $project->created_at?->format('M Y') }}</span>
                    @if($project->language)
                        <span class="chip"><i class="fas fa-code"></i> {{ $project->language }}</span>
                    @endif
                    @if($project->stargazers_count)
                        <span class="chip"><i class="fas fa-star text-amber-300"></i> {{ number_format($project->stargazers_count) }}</span>
                    @endif
                    @if($project->forks_count)
                        <span class="chip"><i class="fas fa-code-branch"></i> {{ number_format($project->forks_count) }}</span>
                    @endif
                </div>

                @if(is_array($project->technologies) && count($project->technologies))
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach($project->technologies as $tech)
                            <a class="chip hover:border-white/20 hover:bg-white/10" href="{{ route('projects.index', ['tech' => $tech]) }}">
                                {{ $tech }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <aside class="card w-full p-6 lg:w-[360px]">
                <h2 class="text-sm font-semibold tracking-wide text-white/90">Links</h2>
                <div class="mt-4 grid gap-2">
                    @php($repoUrl = $project->github_url ?: $project->html_url)
                    @if($repoUrl)
                        <a href="{{ $repoUrl }}" class="btn btn-ghost w-full" target="_blank" rel="noreferrer">
                            <i class="fab fa-github"></i> GitHub repository
                        </a>
                    @endif
                    @if($project->live_url)
                        <a href="{{ $project->live_url }}" class="btn btn-primary w-full" target="_blank" rel="noreferrer">
                            <i class="fas fa-arrow-up-right-from-square"></i> Live demo
                        </a>
                    @endif
                    @if(!$project->github_url && !$project->live_url)
                        <p class="text-sm text-white/60">No public links for this project yet.</p>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
    <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-7">
            <div class="card overflow-hidden">
                <div class="relative aspect-[16/9] w-full bg-white/[0.04]">
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
                                <i class="fas fa-image"></i>
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 card p-6">
                <h2 class="text-base font-semibold text-white/90">Overview</h2>
                <div class="mt-4 space-y-4 text-sm leading-7 text-white/70">
                    @if($project->long_description)
                        {!! nl2br(e($project->long_description)) !!}
                    @else
                        <p>
                            Add a longer description in the admin panel to make this page more informative (problem, solution, stack, and results).
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="card p-6">
                <h2 class="text-base font-semibold text-white/90">Highlights</h2>
                <ul class="mt-4 space-y-3 text-sm text-white/70">
                    <li class="flex gap-3">
                        <span class="mt-0.5 text-sky-300"><i class="fas fa-check"></i></span>
                        <span>Clean code structure with scalable patterns.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-0.5 text-sky-300"><i class="fas fa-check"></i></span>
                        <span>Secure request validation and sane error handling.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-0.5 text-sky-300"><i class="fas fa-check"></i></span>
                        <span>Database performance and data integrity in mind.</span>
                    </li>
                </ul>
            </div>

            <div class="mt-6 card p-6">
                <h2 class="text-base font-semibold text-white/90">Want something similar?</h2>
                <p class="mt-3 text-sm leading-6 text-white/60">
                    If you want a backend like this (APIs, dashboards, automation), I can help.
                </p>
                <div class="mt-5">
                    <a href="{{ route('contact.create') }}" class="btn btn-primary w-full">
                        <i class="fas fa-envelope"></i> Contact me
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

