<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li><a href="/" class="hover:text-amber-600">Home</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li><a href="{{ route('collections.index') }}" class="hover:text-amber-600">Koleksi</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li class="text-gray-900 font-medium">{{ $collection->title }}</li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl shadow-xl p-8 md:p-12 mb-8 text-white">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-flex items-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-4 py-2 mb-4">
                        <i class="fas fa-bookmark mr-2"></i>
                        <span class="text-sm font-semibold">Koleksi Editor</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $collection->title }}</h1>
                    <p class="text-lg text-white text-opacity-90 mb-6 leading-relaxed">
                        {{ $collection->description }}
                    </p>
                    <div class="flex flex-wrap items-center gap-4 text-sm">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-amber-600"></i>
                            </div>
                            <div>
                                <p class="text-white text-opacity-70 text-xs">Dibuat oleh</p>
                                <p class="font-semibold">{{ $collection->admin->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-coffee text-amber-600"></i>
                            </div>
                            <div>
                                <p class="text-white text-opacity-70 text-xs">Total Kafe</p>
                                <p class="font-semibold">{{ $collection->cafes->count() }} Kafe</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="w-32 h-32 bg-white rounded-2xl flex items-center justify-center shadow-2xl">
                        <i class="fas fa-bookmark text-7xl text-amber-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cafes Grid -->
        @if($collection->cafes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($collection->cafes as $cafe)
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
                            @endif
                        </div>

                        <div class="p-4">
                            <a href="{{ route('cafes.detail', $cafe->id) }}" class="block">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2 hover:text-amber-600 transition">
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

                            <!-- View Detail Button -->
                            <a href="{{ route('cafes.detail', $cafe->id) }}" class="block w-full text-center bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fas fa-coffee text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Kafe</h3>
                <p class="text-gray-600">Koleksi ini belum memiliki kafe</p>
            </div>
        @endif
    </div>
</div>