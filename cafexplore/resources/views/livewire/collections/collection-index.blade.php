<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Koleksi Editor</h1>
            <p class="text-gray-600">Temukan koleksi kafe pilihan dari editor kami</p>
        </div>

        <!-- Collections Grid -->
        @if($collections->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($collections as $collection)
                    <a href="{{ route('collections.detail', $collection->slug) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-bookmark text-2xl text-amber-600"></i>
                                </div>
                                <span class="text-sm text-gray-500">{{ $collection->cafes_count }} Kafe</span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $collection->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $collection->description }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-user mr-2"></i>
                                <span>{{ $collection->admin->name }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $collections->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fas fa-bookmark text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Koleksi</h3>
                <p class="text-gray-600">Belum ada koleksi yang dipublikasikan</p>
            </div>
        @endif
    </div>
</div>