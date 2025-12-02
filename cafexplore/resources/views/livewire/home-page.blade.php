<div>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-amber-600 to-orange-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-4">Temukan Kafe Impianmu</h1>
                <p class="text-xl mb-8">Jelajahi ribuan kafe dengan WiFi, stopkontak, dan vibes yang kamu cari</p>
                
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto">
                    <form action="{{ route('cafes.index') }}" method="GET" class="flex gap-2">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari nama kafe atau lokasi..."
                            class="flex-1 px-6 py-4 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500"
                        >
                        <button type="submit" class="bg-gray-900 text-white px-8 py-4 rounded-lg hover:bg-gray-800 font-semibold">
                            <i class="fas fa-search mr-2"></i> Cari
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Filters -->
    <section class="bg-white shadow-sm py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('cafes.index', ['facility' => 1]) }}" class="px-6 py-3 bg-gray-100 hover:bg-amber-100 rounded-full text-gray-700 hover:text-amber-700 transition">
                    <i class="fas fa-wifi mr-2"></i> WiFi
                </a>
                <a href="{{ route('cafes.index', ['facility' => 2]) }}" class="px-6 py-3 bg-gray-100 hover:bg-amber-100 rounded-full text-gray-700 hover:text-amber-700 transition">
                    <i class="fas fa-plug mr-2"></i> Stopkontak
                </a>
                <a href="{{ route('cafes.index', ['price' => 'cheap']) }}" class="px-6 py-3 bg-gray-100 hover:bg-amber-100 rounded-full text-gray-700 hover:text-amber-700 transition">
                    <i class="fas fa-dollar-sign mr-2"></i> Murah
                </a>
                <a href="{{ route('cafes.index', ['open' => 1]) }}" class="px-6 py-3 bg-gray-100 hover:bg-amber-100 rounded-full text-gray-700 hover:text-amber-700 transition">
                    <i class="fas fa-clock mr-2"></i> Buka Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Cafes -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Kafe Pilihan</h2>
                <a href="{{ route('cafes.index') }}" class="text-amber-600 hover:text-amber-700 font-semibold">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($featuredCafes as $cafe)
                    <a href="{{ route('cafes.detail', $cafe->id) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
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
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs px-3 py-1 rounded-full">
                                    Buka
                                </span>
                            @else
                                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-3 py-1 rounded-full">
                                    Tutup
                                </span>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $cafe->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $cafe->address }}</p>

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
                            <div class="flex flex-wrap gap-2">
                                @foreach($cafe->facilities->take(3) as $facility)
                                    <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                        <i class="fas fa-{{ $facility->icon }} mr-1"></i>{{ $facility->name }}
                                    </span>
                                @endforeach
                                @if($cafe->facilities->count() > 3)
                                    <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                        +{{ $cafe->facilities->count() - 3 }} lainnya
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <i class="fas fa-coffee text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada kafe tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Collections -->
    @if($collections->count() > 0)
    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Koleksi Editor</h2>
                <a href="{{ route('collections.index') }}" class="text-amber-600 hover:text-amber-700 font-semibold">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($collections as $collection)
                    <a href="{{ route('collections.detail', $collection->slug) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $collection->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $collection->description }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-coffee mr-2"></i>
                                {{ $collection->cafes->count() }} Kafe
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="bg-amber-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Punya Rekomendasi Kafe?</h2>
            <p class="text-xl mb-8">Bantu komunitas dengan menambahkan kafe favoritmu</p>
            <a href="{{ route('cafes.submit') }}" class="bg-white text-amber-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 inline-block">
                <i class="fas fa-plus mr-2"></i> Submit Kafe Baru
            </a>
        </div>
    </section>
</div>