<div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Cafes -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Kafe</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_cafes'] }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-coffee text-2xl text-amber-600"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-600 font-semibold mr-2">{{ $stats['approved_cafes'] }} Approved</span>
                <span class="text-yellow-600 font-semibold">{{ $stats['pending_cafes'] }} Pending</span>
            </div>
        </div>

        <!-- Total Reviews -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Review</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_reviews'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-2xl text-blue-600"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-600 font-semibold mr-2">{{ $stats['approved_reviews'] }} Approved</span>
                <span class="text-yellow-600 font-semibold">{{ $stats['pending_reviews'] }} Pending</span>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total User</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Total Collections -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Koleksi</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_collections'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-bookmark text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Cafes -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900">Kafe Terbaru</h2>
                <a href="{{ route('admin.cafes.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-semibold">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentCafes as $cafe)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            @if($cafe->primaryPhoto)
                                <img src="{{ $cafe->primaryPhoto->url }}" alt="{{ $cafe->name }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-coffee text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-gray-900">{{ $cafe->name }}</p>
                                <p class="text-sm text-gray-500">{{ $cafe->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full {{ $cafe->status === 'approved' ? 'bg-green-100 text-green-800' : ($cafe->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($cafe->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada kafe</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900">Review Terbaru</h2>
                <a href="{{ route('admin.reviews.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-semibold">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentReviews as $review)
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="font-semibold text-gray-900">{{ $review->user->name }}</span>
                                <span class="text-sm text-gray-500">→ {{ $review->cafe->name }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm mr-1"></i>
                                <span class="font-semibold">{{ $review->rating }}</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 line-clamp-2 mb-2">{{ $review->content }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            <span class="px-2 py-1 text-xs rounded-full {{ $review->status === 'approved' ? 'bg-green-100 text-green-800' : ($review->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($review->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada review</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Popular Collections -->
    @if($popularCollections->count() > 0)
        <div class="mt-6 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900">Koleksi Populer</h2>
                <a href="{{ route('admin.collections.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-semibold">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($popularCollections as $collection)
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $collection->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $collection->cafes_count }} Kafe</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Quick Actions -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.cafes.pending') }}" class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Kafe Pending</p>
                    <p class="text-3xl font-bold">{{ $stats['pending_cafes'] }}</p>
                </div>
                <i class="fas fa-clock text-4xl opacity-50"></i>
            </div>
            <p class="mt-4 text-sm opacity-90">Klik untuk review</p>
        </a>

        <a href="{{ route('admin.reviews.pending') }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Review Pending</p>
                    <p class="text-3xl font-bold">{{ $stats['pending_reviews'] }}</p>
                </div>
                <i class="fas fa-comment-dots text-4xl opacity-50"></i>
            </div>
            <p class="mt-4 text-sm opacity-90">Klik untuk moderasi</p>
        </a>

        <a href="{{ route('admin.collections.create') }}" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Buat Koleksi</p>
                    <p class="text-3xl font-bold">+</p>
                </div>
                <i class="fas fa-plus-circle text-4xl opacity-50"></i>
            </div>
            <p class="mt-4 text-sm opacity-90">Koleksi baru</p>
        </a>
    </div>
</div>