@extends('layouts.customer_document')

@section('title')
    Pago de cliente #{{ $customerPayment->id }}
@endsection

@section('date')
    {{ date('d/m/Y', strtotime($customerPayment->date)) }}
@endsection

@push('body')
    <table width="100%">
        <thead style="background-color: lightgray;">
        <tr>
            <th>#</th>
            <th align="right">Total</th>
            <th>$ {{ $customerPayment->amount }}</th>
        </tr>
        </thead>
    </table>
@endpush