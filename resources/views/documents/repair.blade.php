@extends('layouts.customer_document')

@section('title')
    Reparación #{{ $repair->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($repair->date)) }}
@endsection

@push('body')
    <p><b>Vehículo:</b> {{ $repair->vehicle->vehicle_brand->name }} {{ $repair->vehicle->model }} {{ $repair->vehicle->year }} ({{ $repair->vehicle->domain }})</p>

    @php
        $footerLines = [
            (object) ['text' => 'Costo de mano de obra $', 'price' => $repair->workforce_cost],
            (object) ['text' => 'Total $', 'price' => $repair->total],
        ];
    @endphp
    <x-product-details-table :products="$products" :footerLines="$footerLines" />

    @if ($repair->observations)
        <table width="100%">
            <thead style="background-color: lightgray;">
                <tr>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <td>{{ $repair->observations }}</td>
            </tbody>
        </table>
    @endif
@endpush