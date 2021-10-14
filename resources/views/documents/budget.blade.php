@extends('layouts.customer_document')

@section('title')
    Presupuesto #{{ $budget->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($budget->date)) }}
@endsection

@push('body')
    @php
        $footerLines = [
            (object) ['text' => 'Costo de mano de obra $', 'price' => $budget->workforce_cost],
            (object) ['text' => 'Total $', 'price' => $budget->total],
        ];
    @endphp
    <x-product-details-table :products="$products" :footerLines="$footerLines" />

    @if ($budget->observations)
        <table width="100%">
            <thead style="background-color: lightgray;">
                <tr>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <td>{{ $budget->observations }}</td>
            </tbody>
        </table>
    @endif
@endpush