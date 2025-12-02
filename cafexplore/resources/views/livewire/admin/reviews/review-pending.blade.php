<div>
    @if($reviews->count() > 0)
        <div class="space-y-4">
            @foreach($reviews as $review)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $review->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="{{ route('cafes.detail', $review->cafe->id) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">
                                <i class="fas fa-coffee mr-1"></i> {{ $review->cafe->name }}
                            </a>
                        </div>
                        <div class="flex items-center bg-yellow-100 px-4 py-2 rounded-lg">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>
                            <span class="text-xl font-bold text-gray-900">{{ $review->rating }}</span>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <p class="text-gray-700 leading-relaxed">{{ $review->content }}</p>
                    </div>

                    <div class="flex gap-3">
                        <button 
                            wire:click="approveReview({{ $review->id }})"
                            wire:confirm="Approve review ini?"
                            class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition"
                        >
                            <i class="fas fa-check mr-2"></i> Approve
                        </button>
                        <button 
                            wire:click="rejectReview({{ $review->id }})"
                            wire:confirm="Reject review ini?"
                            class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition"
                        >
                            <i class="fas fa-times mr-2"></i> Reject
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $reviews->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Semua Review Sudah Direview</h3>
            <p class="text-gray-600">Tidak ada review pending yang perlu di-approve</p>
        </div>
    @endif
</div>