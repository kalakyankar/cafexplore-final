<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-center text-gray-900">Daftar</h2>
    </div>
    
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
        @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <p class="font-bold mb-2">Error:</p>
        <ul class="text-sm list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="/register" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
            <input 
                type="text" 
                name="name" 
                value="{{ old('name') }}"
                required 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
            >
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input 
                type="email" 
                name="email" 
                value="{{ old('email') }}"
                required 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
            >
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input 
                type="password" 
                name="password" 
                required 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
            >
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                required 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
            >
        </div>
        <button 
            type="submit" 
            class="w-full bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 font-semibold transition"
        >
            Daftar
        </button>
    </form>
    
    <p class="text-center text-sm text-gray-600 mt-4">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-amber-600 hover:underline font-semibold">Login</a>
    </p>
    
</x-guest-layout>