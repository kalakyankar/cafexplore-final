<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Bookmark Saya</h1>
            <p class="text-gray-600">Kafe-kafe favorit yang Anda simpan</p>
        </div>

        <!-- Bookmarks Grid -->
        @if($bookmarks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($bookmarks as $cafe)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <!-- Image -->
                        <div class="h-48 bg-gray-200 relative">
                            @if($cafe->primaryPhoto)
                                <img src="{{ $cafe->primaryPhoto->url }}" alt="{{ $cafe->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-coffee text-6xl text-gray-400"></i>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            @if(!$cafe->is_closed)
                                <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-3 py-1 rounded-full">
                                    <i class="fas fa-circle text-xs mr-1"></i> Buka
                                </span>
                            @else
                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-3 py-1 rounded-full">
                                    <i class="fas fa-circle text-xs mr-1"></i> Tutup
                                </span>
                            @endif

                            <!-- Remove Bookmark Button -->
                            <button 
                                wire:click="removeBookmark({{ $cafe->id }})"
                                wire:confirm="Hapus kafe ini dari bookmark?"
                                class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 transition"
                            >
                                <i class="fas fa-trash text-red-600"></i>
                            </button>
                        </div>

                        <div class="p-4">
                            <!-- Title -->
                            <a href="{{ route('cafes.detail', $cafe->id) }}" class="block">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2 hover:text-amber-600">
                                    {{ $cafe->name }}
                                </h3>
                            </a>
                            
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                {{ $cafe->address }}
                            </p>

                            <!-- Rating & Price -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-semibold">{{ number_format($cafe->averageRating(), 1) }}</span>
                                    <span class="text-gray-500 text-sm ml-1">({{ $cafe->reviews_count }})</span>
                                </div>
                                <span class="text-amber-600 font-semibold">{{ $cafe->getPriceRangeLabel() }}</span>
                            </div>

                            <!-- Facilities -->
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($cafe->facilities->take(4) as $facility)
                                    <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                        <i class="fas fa-{{ $facility->icon }}"></i>
                                    </span>
                                @endforeach
                                @if($cafe->facilities->count() > 4)
                                    <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                        +{{ $cafe->facilities->count() - 4 }}
                                    </span>
                                @endif
                            </div>

                            <!-- Vibes -->
                            @if($cafe->vibes->count() > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach($cafe->vibes->take(2) as $vibe)
                                        <span class="text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded">
                                            {{ $vibe->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- View Detail -->
                        <div class="px-4 pb-4">
                            <a href="{{ route('cafes.detail', $cafe->id) }}" class="block w-full text-center bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $bookmarks->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fas fa-bookmark text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Bookmark</h3>
                <p class="text-gray-600 mb-6">Mulai simpan kafe favorit Anda untuk akses cepat</p>
                <a href="{{ route('cafes.index') }}" class="inline-block bg-amber-600 text-white px-6 py-3 rounded-lg hover:bg-amber-700 transition">
                    <i class="fas fa-search mr-2"></i> Jelajahi Kafe
                </a>
            </div>
        @endif
    </div>
</div>