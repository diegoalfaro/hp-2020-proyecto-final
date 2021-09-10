@extends('base.root')

@push('head')
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @stack('metas')
  <title>{{ __('app.title') }}</title>
  <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
  @stack('styles')
@endpush

@push('body')
  <div id="app" class="@stack('class')">
    @stack('content')
  </div>
  <script src="{{ asset(mix('js/app.js')) }}"></script>
  @stack('scripts')
@endpush