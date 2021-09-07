@extends('layouts.main')

@section('title', __('sections.customers.title'))

@section('main')
  <div class="container pt-5 pb-5">
      <div class="row justify-content-center">
          <div class="col-md-12">
            <h1>{{ __('sections.customers.title') }}</h1>
            <customer-crud />
          </div>
      </div>
  </div>
@endsection