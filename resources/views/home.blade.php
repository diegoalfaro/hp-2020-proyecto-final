@extends('layouts.main')

@section('title', $title ?? __('sections.home.title'))

@section('main')
  <div class="container pt-5">
      <div class="row justify-content-center">
          <div class="col-md-8">
            <h1>{{ $title ?? __('sections.home.title') }}</h1>
            <example-component text="" />
          </div>
      </div>
  </div>
@endsection