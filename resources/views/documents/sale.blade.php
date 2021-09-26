@extends('layouts.customer_document')

@section('title')
    Venta #{{ $sale->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($sale->date)) }}
@endsection

@push('body')
    @php
        $footerLines = [
            (object) ['text' => 'Total $', 'price' => $sale->total],
        ];
    @endphp
    <x-product-details-table :products="$products" :footerLines="$footerLines" />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <td>{{ $sale->observations }}</td>
        </tbody>
    </table>
@endpush