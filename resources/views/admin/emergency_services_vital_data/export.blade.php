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
    <p class="title-card-info">{{ $title }}</p>
</div>

@if(!empty($emergency_services_vital_data['data']) AND ($emergency_services_vital_data['count'] > 0))

    @php $count = 0; @endphp
    @foreach ($emergency_services_vital_data['data'] as $val)
        @php $count++ @endphp

        <table style="width: 100%; margin-top: 0;">
            <tr>
                <td class="table-unit" width="100%">
                    <strong>Temperatura (ºC):</strong> {{ $val->temperature }}
                </td>
   
                <td class="table-unit" width="100%">
                    <strong>Glicemia (mg/dl):</strong> {{ $val->blood_glucose }}
                </td>
            </tr>

            <tr>
                <td class="table-unit" width="100%">
                    <strong>Frequência Cardíaca (bpm):</strong> {{ $val->heart_rate }}
                </td>
   
                <td class="table-unit" width="100%">
                    <strong>Peso:</strong> {{ $val->weight }}
                </td>
            </tr>

            <tr>
                <td class="table-unit" width="100%">
                    <strong>Saturação O2:</strong> {{ $val->O2_saturation }}
                </td>
   
                <td class="table-unit" width="100%">
                    <strong>Altura:</strong> {{ $val->height }}
                </td>
            </tr>

            <tr>
                <td class="table-unit" width="100%">
                    <strong>Frequência Respiratória (rpm):</strong> {{ $val->respiratory_frequency }}
                </td>
   
                <td class="table-unit" width="100%">
                    <strong>ECG:</strong> {{ $val->ecg }}
                </td>
            </tr>

            <tr>
                <td class="table-unit" width="100%">
                    <strong>Pressão Arterial (mmHg):</strong> {{ $val->blood_pressure }}
                </td>
   
                <td class="table-unit" width="100%">
                    <strong>Régua da Dor:</strong> 
                    @if($val->rule_of_pain == 1)
                    <span class="badge pain_one text-white">Sem Dor</span>
                    @elseif($val->rule_of_pain == 2)
                        <span class="badge pain_two text-white">Dor Leve</span>
                    @elseif($val->rule_of_pain == 3)
                        <span class="badge pain_three text-white">Dor Leve</span>
                    @elseif($val->rule_of_pain == 4)
                        <span class="badge pain_four text-white">Dor Moderada</span>
                    @elseif($val->rule_of_pain == 5)
                        <span class="badge pain_five text-white">Dor Moderada</span>
                    @elseif($val->rule_of_pain == 6)
                        <span class="badge pain_six text-white">Dor Severa</span>
                    @elseif($val->rule_of_pain == 7){
                        <span class="badge pain_seven text-white">Dor Severa</span>
                    @elseif($val->rule_of_pain == 8)
                        <span class="badge pain_eight text-white">Dor Muito Severa</span>
                    @elseif($val->rule_of_pain == 9)
                        <span class="badge pain_nine text-white">Dor Muito Severa</span>
                    @elseif($val->rule_of_pain == 10)
                        <span class="badge pain_ten text-white">pior Dor Possível</span>
                    @endif
                </td>
            </tr>

            <tr>
                <td class="table-unit" width="100%" colspan="2">
                    <strong>Responsavel:</strong> {{ $val->responsible_crm }} - {{ $val->responsible }}
                </td>
            </tr>
        </table>

        @if($count != $emergency_services_vital_data['count'])
            <hr class="line">
        @endif

    @endforeach
@endif


<!-- line sing -->
@include('layouts/admin/fragments.line-sing')
@endsection