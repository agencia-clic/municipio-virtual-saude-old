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
        background-color: rgb(247, 247, 247);
        color:rgb(61, 61, 61);
        font-size: 12px;
    }
    .table-unit-not{
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
    <p class="title-card-info">Prescrição</p>
</div>

@if(!empty($emergency_services_medications['data']) AND ($emergency_services_medications['count'] > 0))

    @php $count = 0; @endphp
    @foreach ($emergency_services_medications['data'] as $val)
        @php $count++; @endphp

        <table style="width: 100%; margin-top: 0;">
            <tr>
                <td class="table-unit" width="100%" colspan="2">
                    <strong>Data/Hora:</strong> 
                    {{ $val->created_at->format('d-m-Y H:i') }}
                </td>
            </tr>

            <tr>
                <td class="table-unit" width="100%" colspan="2">
                    <strong>Medicamento:</strong> {{ $val->medicines }}
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="100%" colspan="2">
                    <strong>Orientação:</strong> {{ $val->guidance }}
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="100%" colspan="2">
                    <strong>Frequência da Dose:</strong> 
                    @if($val->type == "u")
                        Dose única
                    @elseif($val->type == "i")
                        Intervalo 
                        
                        @if(!empty($val->break))
                            <strong>{{ date('H:i', strtotime($val->break)) }} H/m</strong>
                        @endif
                    @else
                        Vezes ao Dia {{ $val->number_time_day }}
                    @endif
                </td>
            </tr> 
            <tr>
                <td class="table-unit" width="50%">
                    <strong>Administracão:</strong> {{ $val->administrations }}
                </td>
          
                <td class="table-unit" width="50%">
                    <strong>Infusao:</strong> {{ $val->infusao }}
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="50%">
                    <strong>Diluição:</strong> {{ $val->dilutions }}
                </td>
            
                <td class="table-unit" width="50%">
                    <strong>Qtd:</strong> {{ number_format($val->amount, 2, ",", ".") }} {{ $val->un_measure }}
                </td>
            </tr>
        </table>

        @if($count != $emergency_services_medications['count'])
            <hr class="line">
        @endif

    @endforeach
@endif

<table style="width: 100%; margin-top: 10;">
    <tr>
        <td class="table-unit-not" width="100%">
            <strong>Observação:</strong>
            {{ $medication_groups->note }}
        </td>
    </tr>
</table>


<!-- line sing -->
@include('layouts/admin/fragments.line-sing')
@endsection