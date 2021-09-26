@extends('layouts.supplier_document')

@section('title')
    Pago a proveedor #{{ $supplierPayment->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($supplierPayment->date)) }}
@endsection

@push('body')
    <table width="100%">
        <thead style="background-color: lightgray;">
        <tr>
            <th>#</th>
            <th align="right">Total</th>
            <th>$ {{ $supplierPayment->amount }}</th>
        </tr>
        </thead>
    </table>
@endpush