@extends('base.root')

@push('head')
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
            margin-bottom: 1cm;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
    </style>
@endpush