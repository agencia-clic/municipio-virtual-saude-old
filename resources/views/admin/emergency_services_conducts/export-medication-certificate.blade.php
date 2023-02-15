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
    <p class="title-card-info">Atestado Médico</p>
</div>

@if(!empty($emergency_services_conducts))

    <table style="width: 100%; margin-top: 10;">
        <tr>
            <td class="table-unit" style="text-align: center;" width="100%">
                ATESTO QUE O (A) PACIENTE <strong>{{ Str::upper($users_paciente->name) }}</strong> NECESSITA DE AFASTAMENTO DE SUAS ATIVIDADES, A PARTIR DE <strong>{{ date('d-m-Y', strtotime($emergency_services_conducts->date_medical_certificate)) }}</strong>, PARA TRATAMENTO DE SAÚDE.
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 50;">
        <tr>
            <td class="table-unit" width="100%">
                
                    @if($emergency_services_conducts->period_medical_certificate == "m")
                        <strong>Período:</strong> Manhã
                    @elseif($emergency_services_conducts->period_medical_certificate == "t")
                        <strong>Período:</strong> Tarde
                    @elseif($emergency_services_conducts->period_medical_certificate == "n")
                        <strong>Período:</strong> Noite
                    @else
                        <strong>Período:</strong> {{ $emergency_services_conducts->number_days_medical_certificate }} DIAS
                    @endif
                
            </td>
        </tr>

        @if(!empty($cid10))
            <tr>
                <td class="table-unit" width="100%">
                    <strong>{{ $cid10->code }}</strong> {{ $cid10->title }}
                </td>
            </tr>

            <tr>
                <td class="table-unit" width="100%">
                    Eu <strong>{{ Str::upper($users_paciente->name) }}</strong>, autorizo a exibição do CID10 em meu atestado.
                </td>
            </tr>
        @endif
    </table>
@endif

<!-- line sing -->
@include('layouts/admin/fragments.line-sing')
@endsection