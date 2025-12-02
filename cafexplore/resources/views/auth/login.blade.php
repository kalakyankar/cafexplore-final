<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-center text-gray-900">Login</h2>
    </div>
    
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input 
                type="email" 
                name="email" 
                value="{{ old('email') }}"
                required 
                autofocus
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
        <button 
            type="submit" 
            class="w-full bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 font-semibold transition"
        >
            Login
        </button>
    </form>
    
    <p class="text-center text-sm text-gray-600 mt-4">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-amber-600 hover:underline font-semibold">Daftar</a>
    </p>
</x-guest-layout>