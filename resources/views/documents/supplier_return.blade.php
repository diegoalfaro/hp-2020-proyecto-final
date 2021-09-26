@extends('layouts.supplier_document')

@section('title')
    Devolución a proveedor #{{ $supplierReturn->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($supplierReturn->date)) }}
@endsection

@push('body')
    @php
        $footerLines = [
            (object) ['text' => 'Total $', 'price' => $supplierReturn->total],
        ];
    @endphp
    <x-product-details-table :products="$products" :footerLines="$footerLines" />
@endpush