@extends('layouts.customer_document')

@section('title')
    Reparación #{{ $repair->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($repair->date)) }}
@endsection

@push('body')
    @php
        $footerLines = [
            (object) ['text' => 'Costo de mano de obra $', 'price' => $repair->workforce_cost],
            (object) ['text' => 'Total $', 'price' => $repair->total],
        ];
    @endphp
    <x-product-details-table :products="$products" :footerLines="$footerLines" />
@endpush