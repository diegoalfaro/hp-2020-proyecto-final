@extends('layouts.document')

@prepend('body')
    <table width="100%">
        <tr>
            <td valign="top">
                <h1>{{ __('app.title') }}</h1>
                <h2>@yield('title')</h2>
                <h3>Fecha: @yield('date')</h3>
            </td>
            <td align="right">
                <h3>Información del cliente #{{ $customer->id }}</h3>
                <ul style="list-style-type:none">
                    <li>{{ $customer->fullName }}</li>
                    <li>{{ $customer->address }}</li>
                    <li>{{ $customer->phone }}</li>
                </ul>
            </td>
        </tr>
    </table>
@endprepend