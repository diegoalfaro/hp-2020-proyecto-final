@extends('base.app')

@push('class', 'main-layout')

@push('content')
    <header>
        @section('header')
            <navbar/>
        @show
    </header>

    <aside>
        @section('aside')
            <sidebar/>
        @show
    </aside>

    <main>
        @yield('main')
    </main>
@endpush