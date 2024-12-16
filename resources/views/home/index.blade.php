@extends('templates.top-nav')

@section('content')

<style>
    body {
        background-image: url('{{ asset('/images/lgu-building.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
</style>

<div class="title flex flex-col items-center lg:flex-row lg:justify-center lg:items-center py-2 mt-[50px]">
    <div class="img-logo lg:w-1/4 mb-4 lg:mb-0">
        <img class="rounded-full w-32 h-32 lg:w-[100%] lg:h-[100%]" src="{{ asset('images/bims-logo.png') }}" alt="LGU logo">
    </div>
    <div class="logo-title font-bold text-center lg:text-left">
        <header class="text-4xl md:text-5xl">B<span class="text-2xl md:text-3xl text-blue-300">ARANGAY</span></header>
        <header class="text-4xl md:text-5xl">I<span class="text-2xl md:text-3xl text-blue-300">NFORMATION</span></header>
        <header class="text-4xl md:text-5xl">M<span class="text-2xl md:text-3xl text-blue-300">ANAGEMENT</span></header>
        <header class="text-4xl md:text-5xl">S<span class="text-2xl md:text-3xl text-blue-300">YSTEM</span></header>
    </div>
</div>

{{-- <div class="login-form text-center lg:text-left mt-6">
    <label for="lgu" class="text-lg lg:text-xl font-semibold">LGU Tubigon</label>
    <div>
        <a href="/lgu-login" class="hover:text-blue-900 font-bold lg:text-xl">Log in</a>
    </div>
</div> --}}

@endsection
