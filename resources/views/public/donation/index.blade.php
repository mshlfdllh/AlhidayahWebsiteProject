{{-- ============================================================ --}}
{{-- resources/views/public/donation/index.blade.php              --}}
{{-- ============================================================ --}}
@extends('layouts.public')
@section('title', 'Donasi')
 
@section('content')
<div class="bg-accent pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-display text-5xl lg:text-6xl text-white mb-4">💛 Berikan Harapan</h1>
        <p class="text-yellow-100 max-w-2xl mx-auto text-lg">Donasi Anda akan membantu kami menyediakan pendidikan berkualitas bagi anak-anak yang membutuhkan.</p>
    </div>
</div>
 
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-8">
    <div class="bg-white rounded-3xl shadow-2xl p-8">
        @livewire('public.donation-form')
    </div>
</div>
 
{{-- Impact stats --}}
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-3xl text-primary-900 mb-10">Dampak Donasi Anda</h2>
        <div class="grid grid-cols-3 gap-6 max-w-2xl mx-auto">
            @foreach([['value' => $totalConfirmed, 'label' => 'Total Donasi Terkumpul'], ['value' => $donorCount . ' Donatur', 'label' => 'Telah Berkontribusi'], ['value' => '500+', 'label' => 'Siswa Terbantu']] as $stat)
            <div class="text-center">
                <p class="text-3xl font-bold text-primary">{{ $stat['value'] }}</p>
                <p class="text-gray-500 text-sm mt-1">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
