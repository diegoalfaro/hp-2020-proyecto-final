@extends('base.app')

@push('class', 'main-layout')

@push('content')
    <header>
        @section('header')
            <x-navbar/>
        @show
    </header>

    <aside>
        @section('aside')
            <x-sidebar/>
        @show
    </aside>

    <main>
        @yield('main')
    </main>
@endpush