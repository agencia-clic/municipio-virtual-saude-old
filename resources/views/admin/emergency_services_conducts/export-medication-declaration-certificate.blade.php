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
        color:rgb(61, 61, 61);
        font-size: 12px;
        text-align: center;
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
</style>

@endsection

<!-- contents -->
@section('content')

<div class="card-info">
    <p class="title-card-info">Declaração Comparecimento/Acompanhamento</p>
</div>

<table style="width: 100%; margin-top: 10;">
    <tr>
        <td class="table-unit" width="100%">
            DECLARO QUE O(A) PACIENTE <strong>{{ Str::upper($users_paciente->name) }}</strong> COMPARECEU NESTA UNIDADE DE SAÚDE, NO DIA <strong>{{ Str::upper(Carbon::parse(date('Y-m-d', strtotime($emergency_services_conducts->date_time_comparison_statement)))->locale('pt-BR')->translatedFormat('d F Y')); }}</strong> NO HORÁRIO DE <strong>{{ date('H:i', strtotime($emergency_services_conducts->date_time_comparison_statement)) }}</strong> ÀS <strong>{{ date('H:i', strtotime($emergency_services_conducts->up_until_comparison_statement)) }}</strong> PARA FINS DE {{ Str::upper($emergency_services_conducts->note_comparison_statement) }}
        </td>
    </tr>
</table>

<!-- line sing -->
@include('layouts/admin/fragments.line-sing')
@endsection