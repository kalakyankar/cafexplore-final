@props(['icon' => 'fa-inbox', 'title' => 'No Data', 'description' => '', 'action' => null])

<div class="bg-white rounded-lg shadow-md p-12 text-center">
    <div class="mb-6">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
            <i class="fas {{ $icon }} text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $title }}</h3>
        @if($description)
            <p class="text-gray-600 mb-6">{{ $description }}</p>
        @endif
    </div>
    
    @if($action)
        {{ $action }}
    @endif
</div>