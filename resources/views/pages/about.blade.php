@extends('layouts.app')

@section('title', 'About - Backend Developer')

@section('content')
<section class="relative overflow-hidden border-b border-white/10">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-56 left-[-120px] h-[520px] w-[520px] rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute -bottom-56 right-[-120px] h-[520px] w-[520px] rounded-full bg-sky-500/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.08),transparent_52%)]"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-18">
        <div class="max-w-2xl">
            <h1 class="text-balance text-3xl font-semibold tracking-tight text-white sm:text-5xl">About me</h1>
            <p class="mt-4 text-pretty text-sm leading-6 text-white/70 sm:text-base">
                Backend developer specialized in Laravel/PHP—building clean, scalable systems with thoughtful database design and production-ready practices.
            </p>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
    <div class="grid gap-6 lg:grid-cols-12">
        <div class="lg:col-span-7">
            <div class="card p-7">
                <h2 class="text-base font-semibold text-white/90">What I do</h2>
                <div class="mt-4 space-y-4 text-sm leading-7 text-white/70">
                    <p>
                        I build backend features end-to-end: database schema, APIs, validation, authentication, background jobs, and integrations.
                        My goal is a codebase that stays understandable as it grows.
                    </p>
                    <p>
                        I care about performance (indexes, caching, query optimization) and reliability (logging, error handling, consistent standards).
                    </p>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-5">
                        <p class="text-xs font-semibold tracking-wide text-white/60">Strength</p>
                        <p class="mt-2 text-sm font-semibold text-white/90">Laravel</p>
                        <p class="mt-2 text-sm text-white/60">REST APIs, services, queues, auth.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-5">
                        <p class="text-xs font-semibold tracking-wide text-white/60">Focus</p>
                        <p class="mt-2 text-sm font-semibold text-white/90">Database</p>
                        <p class="mt-2 text-sm text-white/60">Migrations, relations, optimization.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-5">
                        <p class="text-xs font-semibold tracking-wide text-white/60">Mindset</p>
                        <p class="mt-2 text-sm font-semibold text-white/90">Quality</p>
                        <p class="mt-2 text-sm text-white/60">Testing basics, clean architecture.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="card p-7">
                <h2 class="text-base font-semibold text-white/90">Quick facts</h2>
                <dl class="mt-4 space-y-4 text-sm text-white/70">
                    <div class="flex items-start justify-between gap-6">
                        <dt class="text-white/60">Primary stack</dt>
                        <dd class="text-right font-semibold text-white/85">PHP • Laravel • MySQL</dd>
                    </div>
                    <div class="flex items-start justify-between gap-6">
                        <dt class="text-white/60">Also used</dt>
                        <dd class="text-right font-semibold text-white/85">Redis • Docker • Git</dd>
                    </div>
                    <div class="flex items-start justify-between gap-6">
                        <dt class="text-white/60">Working style</dt>
                        <dd class="text-right font-semibold text-white/85">Clear communication</dd>
                    </div>
                </dl>

                <div class="mt-7">
                    <a href="{{ route('contact.create') }}" class="btn btn-primary w-full">
                        <i class="fas fa-envelope"></i> Let’s work together
                    </a>
                </div>
            </div>

            <div class="mt-6 card p-7">
                <h2 class="text-base font-semibold text-white/90">Download</h2>
                <p class="mt-3 text-sm leading-6 text-white/60">
                    Add your CV in <span class="font-semibold text-white/80">public/cv.pdf</span> and this button will be ready.
                </p>
                <div class="mt-5">
                    <a class="btn btn-ghost w-full" href="{{ asset('cv.pdf') }}" target="_blank" rel="noreferrer">
                        <i class="fas fa-file-arrow-down"></i> View CV
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

