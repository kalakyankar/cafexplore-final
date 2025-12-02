<div>
    <div class="max-w-4xl mx-auto">
        <form wire:submit.prevent="submit" class="bg-white rounded-lg shadow-md p-6 space-y-6">
            
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Koleksi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    wire:model="title"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                    placeholder="Contoh: Kafe Terbaik untuk Working"
                >
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea 
                    wire:model="description"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                    placeholder="Ceritakan tentang koleksi ini..."
                ></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Publish Status -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" wire:model="isPublished" class="mr-2">
                    <span class="text-sm font-medium text-gray-700">Publish koleksi ini</span>
                </label>
            </div>

            <!-- Select Cafes -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Pilih Kafe <span class="text-red-500">*</span>
                </label>
                @error('selectedCafes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto border border-gray-200 rounded-lg p-4">
                    @foreach($cafes as $cafe)
                        <div 
                            wire:click="toggleCafe({{ $cafe->id }})"
                            class="flex items-center p-3 border rounded-lg cursor-pointer transition {{ in_array($cafe->id, $selectedCafes) ? 'border-amber-600 bg-amber-50' : 'border-gray-200 hover:border-amber-300' }}"
                        >
                            @if($cafe->primaryPhoto)
                                <img src="{{ $cafe->primaryPhoto->url }}" alt="{{ $cafe->name }}" class="w-12 h-12 object-cover rounded mr-3">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                    <i class="fas fa-coffee text-gray-400"></i>
                                </div>
                            @endif
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">{{ $cafe->name }}</p>
                                <p class="text-xs text-gray-500">{{ Str::limit($cafe->address, 40) }}</p>
                            </div>
                            @if(in_array($cafe->id, $selectedCafes))
                                <i class="fas fa-check-circle text-amber-600 text-xl"></i>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                @if(count($selectedCafes) > 0)
                    <p class="text-sm text-gray-600 mt-2">
                        {{ count($selectedCafes) }} kafe dipilih
                    </p>
                @endif
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4">
                <button 
                    type="submit"
                    class="flex-1 bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 transition font-semibold"
                >
                    <i class="fas fa-save mr-2"></i> Simpan Koleksi
                </button>
                <a 
                    href="{{ route('admin.collections.index') }}"
                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>