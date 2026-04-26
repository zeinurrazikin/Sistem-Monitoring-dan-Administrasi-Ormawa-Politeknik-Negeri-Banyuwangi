<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ORMAWA Hub</title>

        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; }
            #sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s ease; }
            #main-content { transition: margin-left 0.3s ease; }
            
            @media (min-width: 1024px) {
                #sidebar.collapsed { width: 85px; }
                #sidebar.collapsed .nav-text { display: none; }
                #sidebar.collapsed .nav-item { justify-content: center; }
                #main-content.expanded { margin-left: 85px; }
            }

            @media (max-width: 1023px) {
                #sidebar { transform: translateX(-100%); width: 280px; }
                #sidebar.open { transform: translateX(0); }
                #main-content { margin-left: 0 !important; }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex">
            <!-- Sidebar Overlay (Mobile) -->
            <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-[45] hidden opacity-0 transition-opacity duration-300"></div>

            <!-- Sidebar -->
            <aside id="sidebar" class="fixed left-0 top-0 h-full w-[260px] bg-white border-r border-slate-200 z-50 flex flex-col p-4 shadow-sm">
                <div class="flex items-center justify-end mb-6">
                    <button onclick="toggleSidebar()" class="p-2 text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
                
                <nav class="flex-1 space-y-1">
                    <a href="{{ route('administrasi.index') }}" class="nav-item flex items-center gap-3 px-4 py-3.5 {{ request()->routeIs('administrasi.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-slate-600 hover:bg-slate-50' }} rounded-2xl transition-all group">
                        <span class="material-symbols-outlined flex-shrink-0">description</span>
                        <span class="font-bold text-sm whitespace-nowrap nav-text">Pengajuan Surat</span>
                    </a>
                    <a href="#" class="nav-item flex items-center gap-3 px-4 py-3.5 text-slate-600 hover:bg-slate-50 rounded-2xl transition-all group">
                        <span class="material-symbols-outlined flex-shrink-0">analytics</span>
                        <span class="font-bold text-sm whitespace-nowrap nav-text">Monitoring Sarpras</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="nav-item flex items-center gap-3 px-4 py-3.5 text-slate-600 hover:bg-slate-50 rounded-2xl transition-all group">
                        <span class="material-symbols-outlined flex-shrink-0">account_circle</span>
                        <span class="font-bold text-sm whitespace-nowrap nav-text">Profil</span>
                    </a>
                </nav>

                <div class="pt-4 border-t border-slate-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3.5 text-red-500 hover:bg-red-50 rounded-2xl transition-all">
                            <span class="material-symbols-outlined flex-shrink-0 text-[20px]">logout</span>
                            <span class="font-bold text-sm whitespace-nowrap nav-text">Keluar Akun</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div id="main-content" class="flex-1 lg:ml-[260px] min-w-0">
                {{ $slot }}
            </div>
        </div>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const content = document.getElementById('main-content');
                const overlay = document.getElementById('sidebar-overlay');
                const isMobile = window.innerWidth < 1024;

                if (isMobile) {
                    const isOpen = sidebar.classList.toggle('open');
                    if (isOpen) {
                        overlay.classList.remove('hidden');
                        setTimeout(() => overlay.classList.add('opacity-100'), 10);
                        document.body.style.overflow = 'hidden';
                    } else {
                        overlay.classList.remove('opacity-100');
                        setTimeout(() => overlay.classList.add('hidden'), 300);
                        document.body.style.overflow = '';
                    }
                } else {
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('expanded');
                }
            }
        </script>
    </body>
</html>
