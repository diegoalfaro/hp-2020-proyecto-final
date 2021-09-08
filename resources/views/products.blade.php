@extends('layouts.main')

@section('title', __('sections.products.title'))

@section('main')
  <div class="container pt-5 pb-5">
      <div class="row justify-content-center">
          <div class="col-md-12">
            <h1>{{ __('sections.products.title') }}</h1>
            <product-crud />
          </div>
      </div>
  </div>
@endsection