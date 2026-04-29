<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Backend Developer Portfolio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wdth,wght@75..100,400..700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>

<body class="min-h-screen bg-zinc-950 text-zinc-100 antialiased">
    <a href="#content"
        class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-zinc-900 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white focus:ring-2 focus:ring-sky-400">
        Skip to content
    </a>

    <header class="sticky top-0 z-50 border-b border-white/10 bg-zinc-950/70 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
            <a class="group inline-flex items-center gap-3" href="{{ route('home') }}">
                <span
                    class="grid h-10 w-10 place-items-center rounded-2xl bg-gradient-to-br from-sky-400 to-indigo-500 text-zinc-950 shadow-lg shadow-sky-500/20">
                    <i class="fas fa-code"></i>
                </span>
                <span class="text-sm font-semibold tracking-wide text-white/90 group-hover:text-white">
                    Dev Portfolio
                </span>
            </a>

            <button type="button"
                class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm font-semibold text-white/90 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-sky-400 sm:hidden"
                data-mobile-menu-button aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open menu</span>
                <i class="fas fa-bars"></i>
            </button>

            <nav class="hidden items-center gap-2 sm:flex" aria-label="Primary">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
                <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
                <a class="nav-link" href="{{ route('about') }}">About</a>
                <a class="nav-link" href="{{ route('contact.create') }}">Contact</a>

                @auth
                    <a class="nav-link" href="{{ route('dashboard') }}">Admin</a>
                @endauth
            </nav>
        </div>

        <div id="mobile-menu" class="hidden border-t border-white/10 sm:hidden" data-mobile-menu>
            <nav class="mx-auto max-w-6xl space-y-1 px-4 py-4" aria-label="Mobile">
                <a class="nav-link block" href="{{ route('home') }}">Home</a>
                <a class="nav-link block" href="{{ route('projects.index') }}">Projects</a>
                <a class="nav-link block" href="{{ route('about') }}">About</a>
                <a class="nav-link block" href="{{ route('contact.create') }}">Contact</a>
                @auth
                    <a class="nav-link block" href="{{ route('dashboard') }}">Admin</a>
                @endauth
            </nav>
        </div>
    </header>

    <main id="content">
        @yield('content')
    </main>

    <footer class="border-t border-white/10 bg-zinc-950">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
            <div class="grid gap-10 md:grid-cols-2 md:items-start">
                <div>
                    <h3 class="text-sm font-semibold tracking-wide text-white/90">About</h3>
                    <p class="mt-3 max-w-prose text-sm leading-6 text-white/70">
                        Backend Laravel/PHP developer focused on building reliable APIs, clean architectures, and fast
                        web apps.
                    </p>
                </div>

                <div class="md:text-right">
                    <h3 class="text-sm font-semibold tracking-wide text-white/90">Links</h3>
                    <div class="mt-3 inline-flex items-center gap-3">
                        <a class="social-link" href="https://github.com/Mohammedkatoun" target="_blank" rel="noreferrer"
                            aria-label="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a class="social-link" href="https://linkedin.com" target="_blank" rel="noreferrer"
                            aria-label="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a class="social-link" href="https://twitter.com" target="_blank" rel="noreferrer"
                            aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="mt-10 flex flex-col gap-3 border-t border-white/10 pt-8 text-xs text-white/50 md:flex-row md:items-center md:justify-between">
                <p>&copy; {{ now()->year }} Dev Portfolio. All rights reserved.</p>
                <p class="text-white/40">Built with Laravel.</p>
            </div>
        </div>
    </footer>
    @yield('scripts')
</body>

</html>
