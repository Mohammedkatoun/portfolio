@extends('layouts.app')

@section('title', 'Contact - Backend Developer')

@section('content')
<section class="relative overflow-hidden border-b border-white/10">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-56 left-[-120px] h-[520px] w-[520px] rounded-full bg-sky-500/20 blur-3xl"></div>
        <div class="absolute -bottom-56 right-[-120px] h-[520px] w-[520px] rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.08),transparent_52%)]"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-18">
        <div class="max-w-2xl">
            <h1 class="text-balance text-3xl font-semibold tracking-tight text-white sm:text-5xl">Contact</h1>
            <p class="mt-4 text-pretty text-sm leading-6 text-white/70 sm:text-base">
                Have a project in mind? Tell me what you’re building and I’ll reply as soon as possible.
            </p>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
    <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-7">
            @if($errors->any())
                <div class="card p-6 border border-rose-500/30 bg-rose-500/5">
                    <p class="text-sm font-semibold text-rose-200">Please fix the following errors:</p>
                    <ul class="mt-3 list-disc pl-5 text-sm text-rose-200/80">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="card p-6 border border-emerald-500/30 bg-emerald-500/5">
                    <p class="text-sm font-semibold text-emerald-200">{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="card p-7 mt-6">
                @csrf

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <label for="name" class="text-sm font-semibold text-white/80">Full name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="mt-2 h-11 w-full rounded-2xl border border-white/10 bg-white/5 px-4 text-sm text-white placeholder:text-white/35 outline-none focus:ring-2 focus:ring-sky-400 @error('name') border-rose-500/50 @enderror"
                            placeholder="Your name"
                        >
                        @error('name')
                            <p class="mt-2 text-xs font-semibold text-rose-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="email" class="text-sm font-semibold text-white/80">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="mt-2 h-11 w-full rounded-2xl border border-white/10 bg-white/5 px-4 text-sm text-white placeholder:text-white/35 outline-none focus:ring-2 focus:ring-sky-400 @error('email') border-rose-500/50 @enderror"
                            placeholder="you@email.com"
                        >
                        @error('email')
                            <p class="mt-2 text-xs font-semibold text-rose-200">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-5">
                    <label for="subject" class="text-sm font-semibold text-white/80">Subject</label>
                    <input
                        type="text"
                        id="subject"
                        name="subject"
                        value="{{ old('subject') }}"
                        required
                        class="mt-2 h-11 w-full rounded-2xl border border-white/10 bg-white/5 px-4 text-sm text-white placeholder:text-white/35 outline-none focus:ring-2 focus:ring-sky-400 @error('subject') border-rose-500/50 @enderror"
                        placeholder="What do you need help with?"
                    >
                    @error('subject')
                        <p class="mt-2 text-xs font-semibold text-rose-200">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="message" class="text-sm font-semibold text-white/80">Message</label>
                    <textarea
                        id="message"
                        name="message"
                        rows="7"
                        required
                        class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-white/35 outline-none focus:ring-2 focus:ring-sky-400 @error('message') border-rose-500/50 @enderror"
                        placeholder="A short description, goals, and timeframe…"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-2 text-xs font-semibold text-rose-200">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit" class="btn btn-primary w-full h-11">
                        <i class="fas fa-paper-plane"></i> Send message
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-5">
            <div class="card p-7">
                <h2 class="text-base font-semibold text-white/90">What to include</h2>
                <ul class="mt-4 space-y-3 text-sm text-white/70">
                    <li class="flex gap-3">
                        <span class="mt-0.5 text-sky-300"><i class="fas fa-check"></i></span>
                        <span>Project idea + main features</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-0.5 text-sky-300"><i class="fas fa-check"></i></span>
                        <span>Tech stack (if you have one)</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-0.5 text-sky-300"><i class="fas fa-check"></i></span>
                        <span>Deadline + budget range</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
