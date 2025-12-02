<div>
    @if($cafes->count() > 0)
        <div class="space-y-6">
            @foreach($cafes as $cafe)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
                        <!-- Image -->
                        <div>
                            @if($cafe->primaryPhoto)
                                <img src="{{ $cafe->primaryPhoto->url }}" alt="{{ $cafe->name }}" class="w-full h-48 object-cover rounded-lg">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-coffee text-6xl text-gray-400"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="lg:col-span-2">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $cafe->name }}</h3>
                                    <p class="text-gray-600 mb-2">
                                        <i class="fas fa-map-marker-alt mr-2"></i>{{ $cafe->address }}
                                    </p>
                                    <span class="inline-block px-3 py-1 text-sm rounded-full bg-amber-100 text-amber-800 font-semibold">
                                        {{ $cafe->getPriceRangeLabel() }}
                                    </span>
                                </div>
                            </div>

                            @if($cafe->description)
                                <p class="text-gray-700 mb-4">{{ $cafe->description }}</p>
                            @endif

                            <!-- Contact -->
                            <div class="mb-4 space-y-1">
                                @if($cafe->phone)
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-phone w-5"></i> {{ $cafe->phone }}
                                    </p>
                                @endif
                                @if($cafe->website)
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-globe w-5"></i> 
                                        <a href="{{ $cafe->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $cafe->website }}</a>
                                    </p>
                                @endif
                            </div>

                            <!-- Facilities -->
                            @if($cafe->facilities->count() > 0)
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Fasilitas:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($cafe->facilities as $facility)
                                            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                                <i class="fas fa-{{ $facility->icon }} mr-1"></i>{{ $facility->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Vibes -->
                            @if($cafe->vibes->count() > 0)
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Vibes:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($cafe->vibes as $vibe)
                                            <span class="text-xs bg-amber-100 text-amber-800 px-3 py-1 rounded-full">
                                                {{ $vibe->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex gap-3 mt-6">
                                <button 
                                    wire:click="approveCafe({{ $cafe->id }})"
                                    wire:confirm="Approve kafe ini?"
                                    class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition"
                                >
                                    <i class="fas fa-check mr-2"></i> Approve
                                </button>
                                <button 
                                    wire:click="rejectCafe({{ $cafe->id }})"
                                    wire:confirm="Reject kafe ini?"
                                    class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition"
                                >
                                    <i class="fas fa-times mr-2"></i> Reject
                                </button>
                                <a 
                                    href="{{ route('cafes.detail', $cafe->id) }}"
                                    target="_blank"
                                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $cafes->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Semua Kafe Sudah Direview</h3>
            <p class="text-gray-600">Tidak ada kafe pending yang perlu di-approve</p>
        </div>
    @endif
</div>