{{-- ============================================================ --}}
{{-- resources/views/public/gallery/index.blade.php               --}}
{{-- ============================================================ --}}
@extends('layouts.public')
@section('title', 'Galeri')
 
@section('content')
<div class="bg-primary-900 pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-accent font-semibold text-sm uppercase tracking-widest">Dokumentasi</span>
        <h1 class="font-display text-5xl text-white mt-2 mb-4">Galeri Kegiatan</h1>
        <p class="text-blue-200">Momen-momen berharga dari berbagai kegiatan dan program yayasan.</p>
    </div>
</div>
 
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ activeCategory: '' }">
 
    {{-- Category filter --}}
    @if($categories->count() > 0)
    <div class="flex flex-wrap gap-2 mb-8">
        <button @click="activeCategory = ''"
                :class="activeCategory === '' ? 'bg-primary text-white' : 'bg-white text-gray-600 border hover:border-primary hover:text-primary'"
                class="px-4 py-2 rounded-xl text-sm font-medium transition-colors">
            Semua
        </button>
        @foreach($categories as $category)
        <button @click="activeCategory = '{{ $category }}'"
                :class="activeCategory === '{{ $category }}' ? 'bg-primary text-white' : 'bg-white text-gray-600 border hover:border-primary hover:text-primary'"
                class="px-4 py-2 rounded-xl text-sm font-medium transition-colors">
            {{ $category }}
        </button>
        @endforeach
    </div>
    @endif
 
    {{-- Masonry Grid --}}
    <div class="columns-2 sm:columns-3 lg:columns-4 gap-4 space-y-4">
        @forelse($galleries as $item)
        <div x-show="activeCategory === '' || activeCategory === '{{ $item->category }}'"
             class="break-inside-avoid rounded-2xl overflow-hidden group cursor-pointer relative"
             x-transition>
            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                 class="w-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                <div>
                    <p class="text-white font-medium text-sm">{{ $item->title }}</p>
                    @if($item->category)
                    <p class="text-white/70 text-xs">{{ $item->category }}</p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center py-20 text-gray-400">
            <div class="text-6xl mb-4">🖼️</div>
            <p class="text-lg">Belum ada foto di galeri</p>
        </div>
        @endforelse
    </div>
 
    {{ $galleries->links() }}
</div>
@endsection