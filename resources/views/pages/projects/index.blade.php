@extends('layouts.app')

@section('title', 'Projects - Backend Developer')

@section('content')
<section class="relative overflow-hidden border-b border-white/10">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-56 left-[-120px] h-[520px] w-[520px] rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute -bottom-56 right-[-120px] h-[520px] w-[520px] rounded-full bg-sky-500/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.08),transparent_52%)]"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-18">
        <div class="max-w-2xl">
            <h1 class="text-balance text-3xl font-semibold tracking-tight text-white sm:text-5xl">Projects</h1>
            <p class="mt-4 text-pretty text-sm leading-6 text-white/70 sm:text-base">
                Real-world work: APIs, dashboards, integrations, and clean backend systems.
            </p>
        </div>

        <form method="GET" action="{{ route('projects.index') }}" class="mt-8 grid gap-3 sm:grid-cols-12">
            <div class="sm:col-span-7">
                <label class="sr-only" for="q">Search</label>
                <div class="relative">
                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-white/40">
                        <i class="fas fa-magnifying-glass"></i>
                    </span>
                    <input
                        id="q"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search projects (title, description...)"
                        class="h-11 w-full rounded-2xl border border-white/10 bg-white/5 pl-11 pr-4 text-sm text-white placeholder:text-white/35 outline-none focus:ring-2 focus:ring-sky-400"
                    >
                </div>
            </div>

            <div class="sm:col-span-3">
                <label class="sr-only" for="tech">Technology</label>
                <select
                    id="tech"
                    name="tech"
                    class="h-11 w-full rounded-2xl border border-white/10 bg-white/5 px-4 text-sm text-white outline-none focus:ring-2 focus:ring-sky-400"
                >
                    <option value="">All technologies</option>
                    @foreach(($availableTechs ?? collect()) as $tech)
                        <option value="{{ $tech }}" @selected(request('tech') === $tech)>{{ $tech }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2 flex gap-2">
                <button type="submit" class="btn btn-primary h-11 w-full">Filter</button>
                <a href="{{ route('projects.index') }}" class="btn btn-ghost h-11 w-full">Reset</a>
            </div>
        </form>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        @forelse($projects as $project)
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
                        <h2 class="text-base font-semibold text-white/90">{{ $project->title }}</h2>
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

                    <p class="mt-3 text-sm leading-6 text-white/65">{{ \Illuminate\Support\Str::limit($project->description, 140) }}</p>

                    @if(is_array($project->technologies) && count($project->technologies))
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach(array_slice($project->technologies, 0, 6) as $tech)
                                <a class="chip hover:border-white/20 hover:bg-white/10" href="{{ route('projects.index', array_filter(['tech' => $tech, 'q' => request('q')])) }}">
                                    {{ $tech }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-5 grid grid-cols-2 gap-2">
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" class="btn btn-ghost" target="_blank" rel="noreferrer">
                                <i class="fab fa-github"></i> GitHub
                            </a>
                        @else
                            <span class="btn btn-ghost opacity-40 cursor-not-allowed" aria-disabled="true">
                                <i class="fab fa-github"></i> GitHub
                            </span>
                        @endif

                        @if($project->live_url)
                            <a href="{{ $project->live_url }}" class="btn btn-ghost" target="_blank" rel="noreferrer">
                                <i class="fas fa-arrow-up-right-from-square"></i> Live
                            </a>
                        @else
                            <span class="btn btn-ghost opacity-40 cursor-not-allowed" aria-disabled="true">
                                <i class="fas fa-arrow-up-right-from-square"></i> Live
                            </span>
                        @endif
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-primary w-full">
                            View details <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="card p-10 text-center text-white/70 md:col-span-2 lg:col-span-3">
                No projects found for these filters.
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $projects->links() }}
    </div>
</section>
@endsection
