<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Submit Kafe Baru</h1>
            <p class="text-gray-600">Bantu komunitas dengan menambahkan kafe favorit Anda</p>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <i class="fas fa-info-circle text-blue-600 text-xl mr-3"></i>
                <div class="text-sm text-blue-800">
                    <p class="font-semibold mb-1">Perhatian:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Kafe yang Anda submit akan direview oleh admin terlebih dahulu</li>
                        <li>Pastikan informasi yang Anda berikan akurat dan lengkap</li>
                        <li>Foto yang diupload maksimal 2MB per file</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form wire:submit.prevent="submit" class="bg-white rounded-lg shadow-md p-6 space-y-6">
            
            <!-- Basic Info -->
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Dasar</h2>
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kafe <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            wire:model="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="Contoh: Kopi Kenangan"
                        >
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            wire:model="address"
                            rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Pusat"
                        ></textarea>
                        @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                            placeholder="Ceritakan tentang kafe ini..."
                        ></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Price Range -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Range Harga <span class="text-red-500">*</span>
                        </label>
                        <select 
                            wire:model="priceRange"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        >
                            <option value="cheap">Murah (< Rp 50.000)</option>
                            <option value="moderate">Sedang (Rp 50.000 - 150.000)</option>
                            <option value="expensive">Mahal (> Rp 150.000)</option>
                        </select>
                        @error('priceRange') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Kontak</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon
                        </label>
                        <input 
                            type="text" 
                            wire:model="phone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="081234567890"
                        >
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Website -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Website
                        </label>
                        <input 
                            type="url" 
                            wire:model="website"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="https://example.com"
                        >
                        @error('website') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Lokasi (Opsional)</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Latitude -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Latitude
                        </label>
                        <input 
                            type="text" 
                            wire:model="latitude"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="-6.208763"
                        >
                        @error('latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Longitude -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Longitude
                        </label>
                        <input 
                            type="text" 
                            wire:model="longitude"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="106.845599"
                        >
                        @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-2">
                    <i class="fas fa-lightbulb mr-1"></i>
                    Tip: Anda bisa mendapatkan koordinat dari Google Maps
                </p>
            </div>

            <!-- Operating Hours -->
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Jam Operasional</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(['monday' => 'Senin', 'tuesday' => 'Selasa', 'wednesday' => 'Rabu', 'thursday' => 'Kamis', 'friday' => 'Jumat', 'saturday' => 'Sabtu', 'sunday' => 'Minggu'] as $day => $label)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
                            <input 
                                type="text" 
                                wire:model="{{ $day }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                                placeholder="08:00-22:00"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Facilities -->
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Fasilitas</h2>
                <div class="flex flex-wrap gap-3">
                    @foreach($facilities as $facility)
                        <button 
                            type="button"
                            wire:click="toggleFacility({{ $facility->id }})"
                            class="px-4 py-2 rounded-lg transition {{ in_array($facility->id, $selectedFacilities) ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                        >
                            <i class="fas fa-{{ $facility->icon }} mr-2"></i>
                            {{ $facility->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Vibes -->
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Vibes</h2>
                <div class="flex flex-wrap gap-3">
                    @foreach($vibes as $vibe)
                        <button 
                            type="button"
                            wire:click="toggleVibe({{ $vibe->id }})"
                            class="px-4 py-2 rounded-full transition {{ in_array($vibe->id, $selectedVibes) ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                        >
                            {{ $vibe->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Photos -->
<!-- Photos -->
<div>
    <h2 class="text-xl font-bold text-gray-900 mb-4">Foto Kafe</h2>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Upload Foto (Maksimal 5 foto, 2MB per foto)
        </label>
        
        <!-- Upload Button -->
        <div class="mb-4">
            <label for="photo-upload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                <i class="fas fa-camera mr-2"></i>
                Pilih Foto
            </label>
            <input 
                id="photo-upload"
                type="file" 
                wire:model="photos"
                multiple
                accept="image/*"
                class="hidden"
            >
        </div>

        @error('photos.*') 
            <span class="text-red-500 text-sm block mb-2">{{ $message }}</span> 
        @enderror
        
        <!-- Loading Indicator -->
        <div wire:loading wire:target="photos" class="mb-4">
            <div class="flex items-center text-amber-600">
                <i class="fas fa-spinner fa-spin mr-2"></i>
                <span class="text-sm">Uploading...</span>
            </div>
        </div>

        <!-- Preview Grid -->
        @if ($photos && count($photos) > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                @foreach($photos as $index => $photo)
                    <div class="relative group">
                        <img 
                            src="{{ $photo->temporaryUrl() }}" 
                            class="w-full h-32 object-cover rounded-lg border-2 {{ $index === 0 ? 'border-amber-500' : 'border-gray-200' }}"
                        >
                        
                        <!-- Primary Badge -->
                        @if($index === 0)
                            <span class="absolute top-2 left-2 bg-amber-500 text-white text-xs px-2 py-1 rounded">
                                <i class="fas fa-star mr-1"></i>Utama
                            </span>
                        @endif
                        
                        <!-- Remove Button -->
                        <button 
                            type="button"
                            wire:click="removePhoto({{ $index }})"
                            class="absolute top-2 right-2 bg-red-500 text-white w-7 h-7 rounded-full opacity-0 group-hover:opacity-100 transition flex items-center justify-center"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <!-- Image Info -->
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 text-center rounded-b-lg">
                            {{ number_format($photo->getSize() / 1024, 0) }} KB
                        </div>
                    </div>
                @endforeach
            </div>
            
            <p class="text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Foto pertama akan menjadi foto utama. Total: {{ count($photos) }} foto
            </p>
        @else
            <!-- Empty State -->
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                <p class="text-gray-500 text-sm">Belum ada foto yang dipilih</p>
            </div>
        @endif
    </div>
</div>
            <!-- Submit Button -->
            <div class="flex gap-4">
                <button 
                    type="submit"
                    class="flex-1 bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 transition font-semibold"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>
                        <i class="fas fa-paper-plane mr-2"></i> Submit Kafe
                    </span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...
                    </span>
                </button>
                <a 
                    href="{{ route('cafes.index') }}"
                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>