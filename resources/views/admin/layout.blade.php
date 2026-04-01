<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSECSA Admin — @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            color: #6b4a44;
            text-decoration: none;
            transition: all 0.15s ease;
            margin-bottom: 2px;
        }
        .nav-item:hover {
            background: #fdf0ed;
            color: #831C09;
        }
        .nav-item.active {
            background: #f5e0db;
            color: #831C09;
            font-weight: 600;
        }
        .nav-item.active svg { color: #831C09; }
        .nav-item svg { flex-shrink: 0; opacity: 0.7; }
        .nav-item.active svg, .nav-item:hover svg { opacity: 1; }
    </style>
</head>
<body class="bg-[#F5EDE8] min-h-screen">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-60 bg-white border-r border-[#ecddd8] flex flex-col fixed h-full shadow-sm">

        <!-- Logo -->
        <div class="px-5 py-5">
            <div class="flex items-center gap-3 mb-1">
                <img src="{{ asset('images/Cosecsa Logo.png') }}" alt="COSECSA"
                    class="flex-shrink-0" style="height:36px;width:auto;object-fit:contain;">
                <div>
                    <div class="text-[14px] font-bold text-[#1a0a08] leading-tight tracking-tight">COSECSA</div>
                    <div class="text-[10px] font-semibold text-[#b08a83] tracking-widest uppercase">Admin Console</div>
                </div>
            </div>
        </div>

        <!-- Gold divider -->
        <div class="mx-5 mb-4" style="height:2px;background:linear-gradient(90deg,#F0C129,transparent);border-radius:2px;"></div>

        <!-- Nav -->
        <nav class="flex-1 px-3 overflow-y-auto">
            <div class="text-[10px] font-semibold uppercase tracking-widest text-[#c4a09a] px-2 mb-2">Overview</div>

            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.submissions') }}" class="nav-item {{ request()->routeIs('admin.submissions*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Submissions
            </a>

            <div class="text-[10px] font-semibold uppercase tracking-widest text-[#c4a09a] px-2 mt-4 mb-2">People</div>

            <a href="{{ route('admin.trainers') }}" class="nav-item {{ request()->routeIs('admin.trainers*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Trainers
            </a>
            <a href="{{ route('admin.trainees') }}" class="nav-item {{ request()->routeIs('admin.trainees*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m0 0a4 4 0 118 0m-8 0A4 4 0 019 12a4 4 0 014 4"/>
                </svg>
                Trainees
            </a>

            <div class="text-[10px] font-semibold uppercase tracking-widest text-[#c4a09a] px-2 mt-4 mb-2">Data</div>

            <a href="{{ route('admin.specialties') }}" class="nav-item {{ request()->routeIs('admin.specialties*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Specialties
            </a>
            <a href="{{ route('admin.hospitals') }}" class="nav-item {{ request()->routeIs('admin.hospitals*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Hospitals
            </a>
            <a href="{{ route('admin.export') }}" class="nav-item">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export CSV
            </a>
        </nav>

        <!-- User -->
        <div class="px-4 py-4 border-t border-[#f0e4e0]">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                    style="background:#831C09;">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <div class="text-[13px] font-semibold text-[#1a0a08] truncate">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="text-[11px] text-[#b08a83] truncate">{{ Auth::user()->email ?? '' }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-[13px] text-[#9e7b73] hover:text-[#831C09] transition-colors w-full px-1 py-1 rounded font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 ml-60 p-8 min-w-0">
        @yield('content')
    </main>

</div>
</body>
</html>
