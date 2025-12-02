<div>
    <!-- Filter Bar -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Kafe</label>
                <input 
                    type="text" 
                    wire:model.live.debounce.500ms="search"
                    placeholder="Nama atau alamat kafe..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select 
                    wire:model.live="statusFilter"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                >
                    <option value="">Semua Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Cafes Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kafe</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Review</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($cafes as $cafe)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($cafe->primaryPhoto)
                                    <img src="{{ $cafe->primaryPhoto->url }}" alt="{{ $cafe->name }}" class="w-12 h-12 object-cover rounded mr-3">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                        <i class="fas fa-coffee text-gray-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $cafe->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $cafe->price_range }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-700 line-clamp-2">{{ $cafe->address }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs rounded-full {{ $cafe->status === 'approved' ? 'bg-green-100 text-green-800' : ($cafe->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($cafe->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span class="font-semibold">{{ number_format($cafe->averageRating(), 1) }}</span>
                                <span class="text-gray-500 text-sm ml-1">({{ $cafe->reviews->count() }})</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('cafes.detail', $cafe->id) }}" target="_blank" class="text-blue-600 hover:text-blue-800 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button 
                                wire:click="deleteCafe({{ $cafe->id }})"
                                wire:confirm="Yakin ingin menghapus kafe ini?"
                                class="text-red-600 hover:text-red-800"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            Tidak ada kafe ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            {{ $cafes->links() }}
        </div>
    </div>
</div>