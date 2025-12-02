<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Cafexplore' }} - Temukan Kafe Terbaik</title>
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js (untuk interaksi UI) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome (untuk icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    @livewireStyles
</head>
<body class="bg-gray-50">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <i class="fas fa-coffee text-amber-600 text-2xl"></i>
                        <span class="text-xl font-bold text-gray-900">Cafexplore</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cafes.index') }}" class="text-gray-700 hover:text-amber-600">Jelajah Kafe</a>
                    <a href="{{ route('collections.index') }}" class="text-gray-700 hover:text-amber-600">Koleksi</a>
                    
                    @auth
                        <a href="{{ route('bookmarks.index') }}" class="text-gray-700 hover:text-amber-600">
                            <i class="fas fa-bookmark"></i>
                        </a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-amber-600">
                                <i class="fas fa-user-circle text-xl"></i>
                                <span>{{ auth()->user()->name }}</span>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" x-data="{ show: true }" x-show="show">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                    <i class="fas fa-times"></i>
                </span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" x-data="{ show: true }" x-show="show">
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                    <i class="fas fa-times"></i>
                </span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

@auth
    @if(auth()->user()->isAdmin())
        <!-- Floating Admin Button (hanya terlihat di halaman user) -->
        <a href="{{ route('admin.dashboard') }}" 
           class="fixed bottom-6 right-6 bg-purple-600 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center hover:bg-purple-700 transition z-50"
           title="Admin Panel">
            <i class="fas fa-shield-alt text-xl"></i>
        </a>
    @endif
@endauth

    <!-- Footer -->
    <footer class="bg-white mt-12 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-coffee text-amber-600 text-2xl"></i>
                        <span class="text-xl font-bold text-gray-900">Cafexplore</span>
                    </div>
                    <p class="text-gray-600">Temukan kafe terbaik dengan fasilitas yang Anda butuhkan</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Link Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('cafes.index') }}" class="text-gray-600 hover:text-amber-600">Jelajah Kafe</a></li>
                        <li><a href="{{ route('collections.index') }}" class="text-gray-600 hover:text-amber-600">Koleksi</a></li>
                        <li><a href="{{ route('cafes.submit') }}" class="text-gray-600 hover:text-amber-600">Submit Kafe Baru</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-amber-600"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-600 hover:text-amber-600"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-600 hover:text-amber-600"><i class="fab fa-facebook text-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t mt-8 pt-8 text-center text-gray-600">
                <p>&copy; {{ date('Y') }} Cafexplore. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Toast Container -->
<div 
    x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        init() {
            @if(session('success'))
                this.showToast('{{ session('success') }}', 'success');
            @endif
            @if(session('error'))
                this.showToast('{{ session('error') }}', 'error');
            @endif
        },
        showToast(msg, t) {
            this.message = msg;
            this.type = t;
            this.show = true;
            setTimeout(() => this.show = false, 5000);
        }
    }"
    x-show="show"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-6 right-6 z-50 max-w-sm"
    style="display: none;"
>
    <div :class="{
        'bg-green-500': type === 'success',
        'bg-red-500': type === 'error',
        'bg-blue-500': type === 'info',
        'bg-yellow-500': type === 'warning'
    }" class="text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3">
        <i :class="{
            'fa-check-circle': type === 'success',
            'fa-exclamation-circle': type === 'error',
            'fa-info-circle': type === 'info',
            'fa-exclamation-triangle': type === 'warning'
        }" class="fas text-2xl"></i>
        <span x-text="message" class="flex-1"></span>
        <button @click="show = false" class="text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
    @livewireScripts
</body>
</html>