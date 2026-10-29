<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SITANI - Mengelola Hasil Bumi' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sitani-bg font-sans text-sitani-text-main min-h-screen flex flex-col antialiased selection:bg-sitani-primary selection:text-white">
    <!-- ================= NAVBAR ================= -->
    <header class="w-full bg-sitani-bg border-b border-sitani-border/60 py-4 px-6 md:px-12 sticky top-0 z-50">
        <div class="max-w-content mx-auto flex items-center justify-between">
            <!-- Brand Logo + Wordmark -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-8 h-8 rounded-lg bg-sitani-primary flex items-center justify-center text-white relative">
                    <!-- Sprout icon -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22v-9" />
                        <path d="M12 13c0-3 3-4.5 5-2s-1 5-5 4" />
                        <path d="M12 15c0-2-3-3.5-5-1s1 4 5 3" />
                    </svg>
                    <span class="w-1.5 h-1.5 rounded-full bg-sitani-accent absolute top-1.5 right-1.5"></span>
                </div>
                <span class="font-extrabold text-xl tracking-tight text-sitani-primary">SITANI</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-1.5 text-sm font-medium">
                @php
                $navItems = [
                    ['route' => 'home', 'label' => 'Beranda'],
                    ['route' => 'about', 'label' => 'Tentang'],
                    ['route' => 'program', 'label' => 'Program'],
                    ['route' => 'gallery', 'label' => 'Galeri'],
                    ['route' => 'contact', 'label' => 'Kontak'],
                ];
                @endphp
                @foreach($navItems as $item)
                @php
                $isActive = request()->routeIs($item['route']);
                @endphp
                <a href="{{ route($item['route']) }}" class="px-4 py-2 rounded-md transition-colors {{ $isActive ? 'bg-sitani-primary text-white font-semibold' : 'text-sitani-text-muted hover:text-sitani-primary hover:bg-sitani-primary/10' }}">
                    {{ $item['label'] }}
                </a>
                @endforeach
            </nav>

            <!-- User/Account Avatar Placeholder / Mobile Menu button -->
            <div class="flex items-center gap-4">
                <button class="md:hidden text-sitani-text-main focus:outline-none" id="mobile-menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="hidden md:flex w-9 h-9 rounded-full bg-sitani-primary text-white items-center justify-center text-sm shadow-sm cursor-pointer">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel (Hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 flex flex-col gap-2 border-t border-sitani-border/60 pt-4">
            @foreach($navItems as $item)
            @php
            $isActive = request()->routeIs($item['route']);
            @endphp
            <a href="{{ route($item['route']) }}" class="px-4 py-2 rounded-md transition-colors {{ $isActive ? 'bg-sitani-primary text-white font-semibold' : 'text-sitani-text-muted hover:text-sitani-primary hover:bg-sitani-primary/10' }}">
                {{ $item['label'] }}
            </a>
            @endforeach
        </div>
    </header>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-grow w-full max-w-content mx-auto px-6 md:px-12 py-12 md:py-16">
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="w-full py-8 border-t border-sitani-border/60 text-center text-xs text-sitani-text-muted">
        <div class="max-w-content mx-auto px-6">
            &copy; {{ date('Y') }} Yayasan SITANI. Mengelola hasil bumi untuk kesejahteraan bersama.
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>