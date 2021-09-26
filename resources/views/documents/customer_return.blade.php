@extends('layouts.customer_document')

@section('title')
    Devolución a cliente #{{ $customerReturn->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($customerReturn->date)) }}
@endsection

@push('body')
    @php
        $footerLines = [
            (object) ['text' => 'Total $', 'price' => $customerReturn->total],
        ];
    @endphp
    <x-product-details-table :products="$products" :footerLines="$footerLines" />
@endpush