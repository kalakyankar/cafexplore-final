<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Admin Dashboard' }} - Cafexplore</title>
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    @livewireStyles
</head>
<body class="bg-gray-100">
    
    <div class="min-h-screen flex" x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
        
        <!-- Overlay untuk Mobile -->
        <div 
            x-show="mobileMenuOpen" 
            @click="mobileMenuOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 lg:hidden"
            style="display: none;"
        ></div>

        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'w-64' : 'w-20'" 
            class="bg-gradient-to-b from-gray-900 to-gray-800 text-white fixed inset-y-0 left-0 z-50 transition-all duration-300 ease-in-out lg:relative"
            x-show="mobileMenuOpen || true"
            @click.away="mobileMenuOpen = false"
        >
            <!-- Header Sidebar -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <a href="/" class="flex items-center space-x-3 overflow-hidden">
                    <div class="w-10 h-10 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-coffee text-white text-xl"></i>
                    </div>
                    <div x-show="sidebarOpen" class="transition-opacity duration-300">
                        <h1 class="text-lg font-bold leading-tight">Cafexplore</h1>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Toggle Button (Desktop Only) -->
            <div class="hidden lg:block absolute -right-3 top-20 z-10">
                <button 
                    @click="sidebarOpen = !sidebarOpen"
                    class="bg-amber-500 text-white w-6 h-6 rounded-full shadow-lg hover:bg-amber-600 transition flex items-center justify-center"
                >
                    <i class="fas text-xs" :class="sidebarOpen ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
                </button>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="mt-6 px-3 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 200px);">
                
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-3 py-3 rounded-lg transition group {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-dashboard w-6 text-center"></i>
                    <span x-show="sidebarOpen" class="ml-3 transition-opacity duration-300">Dashboard</span>
                </a>

                <!-- Divider -->
                <div x-show="sidebarOpen" class="px-3 py-2">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Konten</p>
                </div>

                <!-- Kelola Kafe -->
<a href="{{ route('admin.cafes.index') }}" 
   class="flex items-center px-3 py-3 rounded-lg transition group {{ request()->routeIs('admin.cafes.index') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <i class="fas fa-coffee w-6 text-center"></i>
    <span x-show="sidebarOpen" class="ml-3">Kelola Kafe</span>
</a>

                <!-- Pending Kafe (dengan badge) -->
<a href="{{ route('admin.cafes.pending') }}" 
   class="flex items-center px-3 py-3 rounded-lg transition group {{ request()->routeIs('admin.cafes.pending') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <i class="fas fa-clock w-6 text-center"></i>
    <span x-show="sidebarOpen" class="ml-3">Pending Kafe</span>
    <span x-show="sidebarOpen" class="ml-auto bg-yellow-500 text-gray-900 text-xs font-bold px-2 py-1 rounded-full">
        {{ \App\Models\Cafe::pending()->count() }}
    </span>
</a>

                <!-- Moderasi Review -->
<a href="{{ route('admin.reviews.index') }}" 
   class="flex items-center px-3 py-3 rounded-lg transition group {{ request()->routeIs('admin.reviews.index') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <i class="fas fa-star w-6 text-center"></i>
    <span x-show="sidebarOpen" class="ml-3">Review</span>
</a>


                <!-- Pending Review (dengan badge) -->
<a href="{{ route('admin.reviews.pending') }}" 
   class="flex items-center px-3 py-3 rounded-lg transition group {{ request()->routeIs('admin.reviews.pending') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <i class="fas fa-comment-dots w-6 text-center"></i>
    <span x-show="sidebarOpen" class="ml-3">Pending Review</span>
    <span x-show="sidebarOpen" class="ml-auto bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">
        {{ \App\Models\Review::pending()->count() }}
    </span>
</a>

                <!-- Koleksi -->
                <a href="{{ route('admin.collections.index') }}" 
                   class="flex items-center px-3 py-3 rounded-lg transition group {{ request()->routeIs('admin.collections.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-bookmark w-6 text-center"></i>
                    <span x-show="sidebarOpen" class="ml-3">Koleksi</span>
                </a>

                <!-- Divider -->
                <div x-show="sidebarOpen" class="px-3 py-2">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengaturan</p>
                </div>

                <!-- Fasilitas -->
                <a href="{{ route('admin.facilities.index') }}" 
                   class="flex items-center px-3 py-3 rounded-lg transition group {{ request()->routeIs('admin.facilities.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-plug w-6 text-center"></i>
                    <span x-show="sidebarOpen" class="ml-3">Fasilitas</span>
                </a>

                <!-- Vibes -->
                <a href="{{ route('admin.vibes.index') }}" 
                   class="flex items-center px-3 py-3 rounded-lg transition group {{ request()->routeIs('admin.vibes.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-heart w-6 text-center"></i>
                    <span x-show="sidebarOpen" class="ml-3">Vibes</span>
                </a>
            </nav>

            <!-- Bottom Section -->
            <div class="absolute bottom-0 left-0 right-0 border-t border-gray-700 bg-gray-800">
                <a href="{{ route('home') }}" 
                   class="flex items-center px-6 py-4 text-gray-300 hover:bg-gray-700 hover:text-white transition">
                    <i class="fas fa-home w-6 text-center"></i>
                    <span x-show="sidebarOpen" class="ml-3">Ke Halaman Utama</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen">
            
            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="px-4 lg:px-6 py-4 flex justify-between items-center">
                    
                    <!-- Mobile Menu Button -->
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none"
                    >
                        <i class="fas fa-bars text-2xl"></i>
                    </button>

                    <!-- Page Title -->
                    <h1 class="text-xl lg:text-2xl font-semibold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>
                    
                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications (Optional) -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-gray-600 hover:text-gray-900 relative">
                                <i class="fas fa-bell text-xl"></i>
                                @if(\App\Models\Cafe::pending()->count() + \App\Models\Review::pending()->count() > 0)
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                                        {{ \App\Models\Cafe::pending()->count() + \App\Models\Review::pending()->count() }}
                                    </span>
                                @endif
                            </button>
                            
                            <!-- Dropdown Notif -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition
                                 class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl py-2 border"
                                 style="display: none;">
                                <div class="px-4 py-2 border-b">
                                    <p class="font-semibold text-gray-900">Notifikasi</p>
                                </div>
                                @if(\App\Models\Cafe::pending()->count() > 0)
                                    <a href="{{ route('admin.cafes.pending') }}" class="block px-4 py-3 hover:bg-gray-50">
                                        <p class="text-sm font-medium text-gray-900">{{ \App\Models\Cafe::pending()->count() }} Kafe Pending</p>
                                        <p class="text-xs text-gray-500">Perlu direview</p>
                                    </a>
                                @endif
                                @if(\App\Models\Review::pending()->count() > 0)
                                    <a href="{{ route('admin.reviews.pending') }}" class="block px-4 py-3 hover:bg-gray-50">
                                        <p class="text-sm font-medium text-gray-900">{{ \App\Models\Review::pending()->count() }} Review Pending</p>
                                        <p class="text-xs text-gray-500">Perlu dimoderasi</p>
                                    </a>
                                @endif
                                @if(\App\Models\Cafe::pending()->count() == 0 && \App\Models\Review::pending()->count() == 0)
                                    <div class="px-4 py-8 text-center">
                                        <i class="fas fa-check-circle text-4xl text-green-500 mb-2"></i>
                                        <p class="text-sm text-gray-500">Tidak ada notifikasi</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-amber-600">
                                <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-amber-600"></i>
                                </div>
                                <span class="hidden lg:block font-medium">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border"
                                 style="display: none;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-edit mr-2"></i> Profile
                                </a>
                                <div class="border-t"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mx-4 lg:mx-6 mt-4">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded shadow-sm" 
                         x-data="{ show: true }" 
                         x-show="show"
                         x-transition>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-3"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                            <button @click="show = false" class="text-green-700 hover:text-green-900">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-4 lg:mx-6 mt-4">
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded shadow-sm" 
                         x-data="{ show: true }" 
                         x-show="show"
                         x-transition>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-3"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                            <button @click="show = false" class="text-red-700 hover:text-red-900">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t px-4 lg:px-6 py-4">
                <div class="flex flex-col lg:flex-row justify-between items-center text-sm text-gray-600">
                    <p>&copy; {{ date('Y') }} Cafexplore Admin Panel. All rights reserved.</p>
                    <p>Version 1.0.0</p>
                </div>
            </footer>
        </div>
    </div>

    @livewireScripts
</body>
</html>