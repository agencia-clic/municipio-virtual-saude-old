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
    <p class="title-card-info">Dados do Parecer</p>
</div>

@if(!empty($emergency_services_conducts))


    <table style="width: 100%; margin-top: 0;">
        <tr>
            <td class="table-unit" width="100%" colspan="2">
                <strong>Unidade de Internação:</strong> {{ $service_units->code }} - {{ $service_units->name }}
                <hr class="line-td" style="width: 82.75%; margin-left: 97;"/>
            </td>
        </tr>
        <tr>
            <td class="table-unit" width="100%" colspan="2">
                <strong>Leito:</strong>
                <hr class="line-td" style="width: 96%; margin-left: 25;"/>
            </td>
        </tr>
        <tr>
            <td class="table-unit" width="50%">
                <strong>Da Clínica:</strong>
                <hr class="line-td" style="width: 83%; margin-left: 45;"/>
            </td>
        
            <td class="table-unit" width="50%">
                <strong>Á Clínica:</strong>
                <hr class="line-td" style="width: 86.6%; margin-left: 40;"/>
            </td>
        </tr>
        <tr>
            <td class="table-unit" width="100%" colspan="2">
                <strong>Solicitação do Parecer:</strong> {{ $emergency_services_conducts->medical_opinion }}
            </td>
        </tr>
    </table>

    <!-- line sing -->
    @include('layouts/admin/fragments.line-sing')

    <table style="width: 100%; margin-top: 130;">
        <tr>
            <td class="table-unit" width="100%" colspan="2">
                <strong>Parecer Médico:</strong>
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 250;">
        <tr>
            <td class="table-unit" width="50%">
                <strong>Data:</strong> ___/___/___
            </td>

            <td class="table-unit" width="50%">
                <hr class="line-td" style="width: 100%; margin-top: 50px;"/>
                <p class="text-responsible">
                    <strong>Profissional Responsavel</strong>
                </p>
            </td>
        </tr>
    </table>

@endif


@endsection