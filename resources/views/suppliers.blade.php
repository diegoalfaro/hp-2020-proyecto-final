@extends('layouts.main')

@section('title', __('sections.suppliers.title'))

@section('main')
  <div class="container pt-5 pb-5">
      <div class="row justify-content-center">
          <div class="col-md-12">
            <h1>{{ __('sections.suppliers.title') }}</h1>
            <supplier-crud />
          </div>
      </div>
  </div>
@endsection