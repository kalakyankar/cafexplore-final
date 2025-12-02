<x-layout title="Edit Profile">
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Profile</h1>
                <p class="text-gray-600">Update informasi profil Anda</p>
            </div>

            <!-- Profile Form -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Profil</h2>
                
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', auth()->user()->name) }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        >
                        @error('name') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Email (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            value="{{ auth()->user()->email }}"
                            disabled
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500"
                        >
                        <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah</p>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea 
                            name="bio" 
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="Ceritakan tentang diri Anda..."
                        >{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Role Badge -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            <i class="fas {{ auth()->user()->isAdmin() ? 'fa-shield-alt' : 'fa-user' }} mr-2"></i>
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex gap-4">
                        <button 
                            type="submit"
                            class="flex-1 bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 transition font-semibold"
                        >
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                        <a 
                            href="{{ url()->previous() }}"
                            class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold"
                        >
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Account Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Akun</h2>
                <div class="space-y-3">
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-600">Bergabung sejak</span>
                        <span class="font-semibold text-gray-900">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-600">Total Review</span>
                        <span class="font-semibold text-gray-900">{{ auth()->user()->reviews->count() }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Total Bookmark</span>
                        <span class="font-semibold text-gray-900">{{ auth()->user()->bookmarks->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>