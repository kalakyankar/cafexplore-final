<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Jelajahi Kafe</h1>
            <p class="text-gray-600">Temukan kafe dengan fasilitas dan vibes yang kamu cari</p>
        </div>

        <!-- Search & Filter Bar -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                <!-- Search -->
                <div class="lg:col-span-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Kafe</label>
                    <input 
                        type="text" 
                        wire:model.live.debounce.500ms="search" 
                        placeholder="Nama kafe atau lokasi..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                    >
                </div>

                <!-- Sort -->
                <div class="lg:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                    <select wire:model.live="sortBy" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        <option value="latest">Terbaru</option>
                        <option value="rating">Rating Tertinggi</option>
                        <option value="name">Nama (A-Z)</option>
                    </select>
                </div>

                <!-- Filter Toggle -->
                <div class="lg:col-span-4 flex items-end">
                    <button 
                        wire:click="$toggle('showFilters')" 
                        class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition"
                    >
                        <i class="fas fa-filter mr-2"></i>
                        {{ $showFilters ? 'Sembunyikan Filter' : 'Tampilkan Filter' }}
                    </button>
                </div>
            </div>

            <!-- Advanced Filters -->
            @if($showFilters)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <!-- Price Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Harga</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="priceRange" value="" class="mr-2">
                                    <span>Semua</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="priceRange" value="cheap" class="mr-2">
                                    <span>Murah (Rp)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="priceRange" value="moderate" class="mr-2">
                                    <span>Sedang (Rp Rp)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="priceRange" value="expensive" class="mr-2">
                                    <span>Mahal (Rp Rp Rp)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Status</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="isOpen" value="" class="mr-2">
                                    <span>Semua</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="isOpen" value="1" class="mr-2">
                                    <span class="flex items-center">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Buka
                                    </span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="isOpen" value="0" class="mr-2">
                                    <span class="flex items-center">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                        Tutup
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Facilities -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Fasilitas</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($facilities as $facility)
                                    <button 
                                        wire:click="toggleFacility({{ $facility->id }})"
                                        class="px-3 py-1 rounded-full text-sm transition {{ in_array($facility->id, $selectedFacilities) ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                                    >
                                        <i class="fas fa-{{ $facility->icon }} mr-1"></i>
                                        {{ $facility->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Vibes -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Vibes</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($vibes as $vibe)
                                <button 
                                    wire:click="toggleVibe({{ $vibe->id }})"
                                    class="px-4 py-2 rounded-full text-sm transition {{ in_array($vibe->id, $selectedVibes) ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                                >
                                    {{ $vibe->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    @if($search || $priceRange || $isOpen !== '' || !empty($selectedFacilities) || !empty($selectedVibes))
                        <div class="mt-6">
                            <button 
                                wire:click="clearFilters" 
                                class="text-red-600 hover:text-red-700 font-semibold"
                            >
                                <i class="fas fa-times mr-1"></i> Hapus Semua Filter
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Results Count -->
        <div class="mb-4">
            <p class="text-gray-600">
                Menampilkan <span class="font-semibold">{{ $cafes->total() }}</span> kafe
                @if($search)
                    untuk "<span class="font-semibold">{{ $search }}</span>"
                @endif
            </p>
        </div>

<div wire:loading.delay class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @for($i = 0; $i < 6; $i++)
        <x-cafe-card-skeleton />
    @endfor
</div>

<div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @forelse($cafes as $cafe)
        <!-- ... existing cafe card code ... -->
    @empty
        <!-- ... -->
    @endforelse
</div>

        <!-- Cafe Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($cafes as $cafe)
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

                        <!-- Bookmark Button -->
                        @auth
                            <button 
                                wire:click="toggleBookmark({{ $cafe->id }})"
                                class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 transition"
                            >
                                <i class="fas fa-bookmark {{ auth()->user()->hasBookmarked($cafe->id) ? 'text-amber-600' : 'text-gray-400' }}"></i>
                            </button>
                        @endauth
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
            @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Kafe Ditemukan</h3>
                    <p class="text-gray-500 mb-4">Coba ubah filter atau kata kunci pencarian Anda</p>
                    @if($search || $priceRange || $isOpen !== '' || !empty($selectedFacilities) || !empty($selectedVibes))
                        <button 
                            wire:click="clearFilters" 
                            class="bg-amber-600 text-white px-6 py-2 rounded-lg hover:bg-amber-700"
                        >
                            Hapus Semua Filter
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $cafes->links() }}
        </div>
    </div>
</div>