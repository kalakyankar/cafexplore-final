<div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ $editMode ? 'Edit Vibe' : 'Tambah Vibe Baru' }}
            </h2>
            
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Vibe</label>
                    <input 
                        type="text" 
                        wire:model="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500"
                        placeholder="Cozy, Modern, etc."
                    >
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-2">
                    <button 
                        type="submit"
                        class="flex-1 bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700"
                    >
                        {{ $editMode ? 'Update' : 'Tambah' }}
                    </button>
                    @if($editMode)
                        <button 
                            type="button"
                            wire:click="cancelEdit"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300"
                        >
                            Batal
                        </button>
                    @endif
                </div>
            </form>
        </div>

        <!-- List -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Daftar Vibes</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @forelse($vibes as $vibe)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $vibe->name }}</p>
                            <p class="text-sm text-gray-500">{{ $vibe->cafes_count }} kafe</p>
                        </div>
                        <div class="flex gap-2">
                            <button 
                                wire:click="edit({{ $vibe->id }})"
                                class="text-blue-600 hover:text-blue-800"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                            <button 
                                wire:click="delete({{ $vibe->id }})"
                                wire:confirm="Yakin ingin menghapus vibe ini?"
                                class="text-red-600 hover:text-red-800"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-8 col-span-2">Belum ada vibes</p>
                @endforelse
            </div>
        </div>
    </div>
</div>