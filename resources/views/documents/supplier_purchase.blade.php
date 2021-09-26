@extends('layouts.supplier_document')

@section('title')
    Compra a proveedor #{{ $supplierPurchase->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($supplierPurchase->date)) }}
@endsection

@push('body')
    @php
        $footerLines = [
            (object) ['text' => 'Total $', 'price' => $supplierPurchase->total],
        ];
    @endphp
    <x-supplier-purchase-details-table :products="$products" :footerLines="$footerLines" />
@endpush