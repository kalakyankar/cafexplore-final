<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li><a href="/" class="hover:text-amber-600">Home</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li><a href="{{ route('cafes.index') }}" class="hover:text-amber-600">Kafe</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li class="text-gray-900 font-medium">{{ $cafe->name }}</li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6">
                <!-- Left: Image Gallery -->
                <div>
                    @if($cafe->photos->count() > 0)
                        <!-- Primary Image -->
                        <div class="mb-4">
                            @php
                                $primary = $cafe->photos->where('is_primary', true)->first() ?? $cafe->photos->first();
                            @endphp
                            <img src="{{ $primary->url }}" alt="{{ $cafe->name }}" class="w-full h-96 object-cover rounded-lg">
                        </div>

                        <!-- Thumbnail Gallery -->
                        @if($cafe->photos->count() > 1)
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($cafe->photos->take(4) as $photo)
                                    <img src="{{ $photo->url }}" alt="{{ $photo->caption ?? $cafe->name }}" class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75 transition">
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-coffee text-8xl text-gray-400"></i>
                        </div>
                    @endif
                </div>

                <!-- Right: Cafe Info -->
                <div>
                    <!-- Status Badge -->
                    <div class="mb-4">
                        @if(!$cafe->is_closed)
                            <span class="inline-flex items-center bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                Buka Sekarang
                            </span>
                        @else
                            <span class="inline-flex items-center bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-semibold">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                Tutup
                            </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $cafe->name }}</h1>

                    <!-- Rating & Reviews -->
                    <div class="flex items-center mb-4">
                        <div class="flex items-center bg-yellow-100 px-4 py-2 rounded-lg mr-4">
                            <i class="fas fa-star text-yellow-500 text-xl mr-2"></i>
                            <span class="text-2xl font-bold text-gray-900">{{ number_format($cafe->averageRating(), 1) }}</span>
                        </div>
                        <span class="text-gray-600">{{ $cafe->totalReviews() }} Review</span>
                    </div>

                    <!-- Price Range -->
                    <div class="flex items-center mb-4">
                        <span class="text-gray-600 mr-2">Harga:</span>
                        <span class="text-2xl font-bold text-amber-600">{{ $cafe->getPriceRangeLabel() }}</span>
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <div class="flex items-start text-gray-700">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-amber-600"></i>
                            <div>
                                <p class="font-medium">Alamat</p>
                                <p>{{ $cafe->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="space-y-2 mb-6">
                        @if($cafe->phone)
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-phone w-6 text-amber-600"></i>
                                <a href="tel:{{ $cafe->phone }}" class="hover:text-amber-600">{{ $cafe->phone }}</a>
                            </div>
                        @endif
                        @if($cafe->website)
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-globe w-6 text-amber-600"></i>
                                <a href="{{ $cafe->website }}" target="_blank" class="hover:text-amber-600">{{ $cafe->website }}</a>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        @auth
                            <button 
                                wire:click="toggleBookmark"
                                class="flex-1 flex items-center justify-center px-6 py-3 {{ auth()->user()->hasBookmarked($cafe->id) ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg transition"
                            >
                                <i class="fas fa-bookmark mr-2"></i>
                                {{ auth()->user()->hasBookmarked($cafe->id) ? 'Tersimpan' : 'Simpan' }}
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="flex-1 flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg transition">
                                <i class="fas fa-bookmark mr-2"></i>
                                Simpan
                            </a>
                        @endauth

                        @if($cafe->latitude && $cafe->longitude)
                            <a 
                                href="https://www.google.com/maps?q={{ $cafe->latitude }},{{ $cafe->longitude }}" 
                                target="_blank"
                                class="flex-1 flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                            >
                                <i class="fas fa-directions mr-2"></i>
                                Petunjuk Arah
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Description -->
                @if($cafe->description)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Tentang</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $cafe->description }}</p>
                    </div>
                @endif

                <!-- Facilities -->
                @if($cafe->facilities->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Fasilitas</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($cafe->facilities as $facility)
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-{{ $facility->icon }} text-amber-600 text-xl mr-3"></i>
                                    <span class="text-gray-700">{{ $facility->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Vibes -->
                @if($cafe->vibes->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Vibes</h2>
                        <div class="flex flex-wrap gap-3">
                            @foreach($cafe->vibes as $vibe)
                                <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full font-medium">
                                    {{ $vibe->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Map -->
                @if($cafe->latitude && $cafe->longitude)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Lokasi</h2>
                        <div class="aspect-video rounded-lg overflow-hidden">
                            <iframe 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                style="border:0"
                                src="https://www.google.com/maps?q={{ $cafe->latitude }},{{ $cafe->longitude }}&output=embed"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <p class="text-sm text-gray-600 mt-3">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            {{ $cafe->address }}
                        </p>
                    </div>
                @endif

                <!-- Reviews Section -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Review ({{ $cafe->totalReviews() }})</h2>
                        
                        @auth
                            @if(!$userHasReviewed)
                                <button 
                                    wire:click="$toggle('showReviewForm')"
                                    class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition"
                                >
                                    <i class="fas fa-plus mr-2"></i> Tulis Review
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition">
                                <i class="fas fa-plus mr-2"></i> Tulis Review
                            </a>
                        @endauth
                    </div>

                    <!-- Review Form -->
                    @auth
                        @if($showReviewForm && !$userHasReviewed)
                            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                                <form wire:submit.prevent="submitReview">
                                    <!-- Rating -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                        <div class="flex gap-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <button 
                                                    type="button"
                                                    wire:click="$set('rating', {{ $i }})"
                                                    class="text-3xl {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition"
                                                >
                                                    <i class="fas fa-star"></i>
                                                </button>
                                            @endfor
                                        </div>
                                        @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Review Content -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Review Anda</label>
                                        <textarea 
                                            wire:model="reviewContent"
                                            rows="4"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                                            placeholder="Ceritakan pengalaman Anda di kafe ini..."
                                        ></textarea>
                                        @error('reviewContent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="flex gap-2">
                                        <button 
                                            type="submit"
                                            class="bg-amber-600 text-white px-6 py-2 rounded-lg hover:bg-amber-700 transition"
                                        >
                                            Submit Review
                                        </button>
                                        <button 
                                            type="button"
                                            wire:click="$set('showReviewForm', false)"
                                            class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition"
                                        >
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        @if($userHasReviewed)
                            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-blue-800">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Anda sudah memberikan review untuk kafe ini
                                </p>
                            </div>
                        @endif
                    @endauth

                    <!-- Reviews List -->
                    <div class="space-y-4">
                        @forelse($cafe->reviews as $review)
                            <div class="border-b border-gray-200 pb-4 last:border-0">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-gray-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $review->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center bg-yellow-100 px-3 py-1 rounded-full">
                                        <i class="fas fa-star text-yellow-500 text-sm mr-1"></i>
                                        <span class="font-semibold text-gray-900">{{ $review->rating }}</span>
                                    </div>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $review->content }}</p>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-comment-slash text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">Belum ada review untuk kafe ini</p>
                                <p class="text-sm text-gray-400">Jadilah yang pertama memberikan review!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-6">
                
                <!-- Operating Hours -->
                @if($cafe->cafe_operating_hours)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Jam Operasional</h3>
                        <div class="space-y-2">
                            @php
                                $days = [
                                    'monday' => 'Senin',
                                    'tuesday' => 'Selasa',
                                    'wednesday' => 'Rabu',
                                    'thursday' => 'Kamis',
                                    'friday' => 'Jumat',
                                    'saturday' => 'Sabtu',
                                    'sunday' => 'Minggu',
                                ];
                                $today = strtolower(now()->format('l'));
                            @endphp
                            @foreach($days as $key => $label)
                                <div class="flex justify-between {{ $key === $today ? 'font-bold text-amber-600' : 'text-gray-700' }}">
                                    <span>{{ $label }}</span>
                                    <span>{{ $cafe->cafe_operating_hours[$key] ?? 'Tutup' }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Share -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Bagikan</h3>
                    <div class="flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="flex-1 bg-blue-600 text-white py-2 rounded text-center hover:bg-blue-700 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($cafe->name) }}" target="_blank" class="flex-1 bg-sky-500 text-white py-2 rounded text-center hover:bg-sky-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($cafe->name . ' - ' . request()->url()) }}" target="_blank" class="flex-1 bg-green-600 text-white py-2 rounded text-center hover:bg-green-700 transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
