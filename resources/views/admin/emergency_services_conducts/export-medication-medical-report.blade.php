@extends('layouts.admin.export')

<!-- style css -->
@section('style')

<style>
    .card-info{
        height: 20px;
        width: 100%;
        background: rgba(13,131,221,255);
        margin-bottom: -5;
    }
    .title-card-info{
        color: white;
        text-align: center;
    }
    .table-unit{
        font-size: 12px;
    }
    .line{
        color: rgb(61, 61, 61);
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
    }

    .line-td{
        display: block;
        margin-top: 0.0em;
        margin-bottom: 0.5em;
        margin-right: auto;
        border-style: inset;
        border-width: 0.5px;
    }

    .line-sing{
        bottom: 550px; 
        left: 350px; 
        right: 0px;
    }

    .line-sing-line{
        width: 70%;
    }

    .text-responsible{
        color: rgb(163, 163, 163);
        text-align: center;
        margin-top: -5px;
    }
</style>

@endsection

<!-- contents -->
@section('content')

<div class="card-info">
    <p class="title-card-info">{{ $title }}</p>
</div>


@if(!empty($emergency_services_conducts))


    <table style="width: 100%; margin-top: 0;">
        <tr>
            <td class="table-unit" width="100%" colspan="2">
                {{ $emergency_services_conducts->medical_report }}
            </td>
        </tr>
    </table>

@endif

@endsection