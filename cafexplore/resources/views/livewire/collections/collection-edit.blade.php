<div>
    <div class="max-w-4xl mx-auto">
        <form wire:submit.prevent="update" class="bg-white rounded-lg shadow-md p-6 space-y-6">
            
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Koleksi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    wire:model="title"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
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
                ></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Publish Status -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" wire:model="isPublished" class="mr-2">
                    <span class="text-sm font-medium text-gray-700">Publish