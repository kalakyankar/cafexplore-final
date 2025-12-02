<?php

use App\Livewire\Admin\Collections\CollectionCreate;
use App\Livewire\Admin\Collections\CollectionEdit;
use App\Livewire\Admin\Collections\CollectionIndex as AdminCollectionIndex;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\HomePage;
use App\Livewire\Cafes\CafeIndex;
use App\Livewire\Cafes\CafeDetail;
use App\Livewire\Cafes\CafeSubmit;
use App\Livewire\Collections\CollectionIndex; // PUBLIC
use App\Livewire\Collections\CollectionDetail;
use App\Livewire\Bookmarks\BookmarkIndex;

// Public Routes
Route::get('/', HomePage::class)->name('home');
Route::get('/cafes', CafeIndex::class)->name('cafes.index');
Route::get('/cafes/{cafe:id}', CafeDetail::class)->name('cafes.detail');

// COLLECTION ROUTES (PUBLIC) - PASTIKAN INI ADA
Route::get('/collections', CollectionIndex::class)->name('collections.index');
Route::get('/collections/{collection:slug}', CollectionDetail::class)->name('collections.detail');

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Illuminate\Http\Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->withErrors(['email' => 'Invalid credentials']);
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'member',
    ]);

    Auth::login($user);
    
    return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang ' . $user->name);
});

Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/bookmarks', BookmarkIndex::class)->name('bookmarks.index');
    Route::get('/cafes/submit', CafeSubmit::class)->name('cafes.submit');
    
    // Profile Routes
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    
    Route::patch('/profile', function (Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
        ]);
        
        $request->user()->update($validated);
        
        return back()->with('success', 'Profile berhasil diupdate');
    })->name('profile.update');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
    
    // Cafes Management
    Route::get('/cafes', \App\Livewire\Admin\Cafes\CafeIndex::class)->name('cafes.index');
    Route::get('/cafes/pending', \App\Livewire\Admin\Cafes\CafePending::class)->name('cafes.pending');
    
    // Reviews Management
    Route::get('/reviews', \App\Livewire\Admin\Reviews\ReviewIndex::class)->name('reviews.index');
    Route::get('/reviews/pending', \App\Livewire\Admin\Reviews\ReviewPending::class)->name('reviews.pending');
    
    // Collections Management (ADMIN)
    Route::get('/collections', AdminCollectionIndex::class)->name('collections.index');
    Route::get('/collections/create', CollectionCreate::class)->name('collections.create');
    Route::get('/collections/{collection}/edit', CollectionEdit::class)->name('collections.edit');

    // Facilities & Vibes
    Route::get('/facilities', \App\Livewire\Admin\Facilities\FacilityIndex::class)->name('facilities.index');
    Route::get('/vibes', \App\Livewire\Admin\Vibes\VibeIndex::class)->name('vibes.index');
});