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
    <p class="title-card-info">
        Receituário Médico
    
        @if(app('request')->input('type') == 'n')
            Normal
        @elseif(app('request')->input('type') == 't')
            Contínuo
        @elseif(app('request')->input('type') == 'c')
            Controlado
        @endif
    </p>
</div>

@if(!empty($emergency_services_prescriptions['data']) AND ($emergency_services_prescriptions['count'] > 0))

    @php $count = 0; @endphp
    @foreach ($emergency_services_prescriptions['data'] as $val)
        @php $count++; @endphp

        <table style="width: 100%; margin-top: 0;">
            <tr>
                <td class="table-unit" width="50%">
                    <strong>Tipo:</strong> 
                    @if($val->type == 'n')
                        Normal
                    @elseif($val->type == 't')
                       Contínuo
                    @elseif($val->type == 'c')
                        Controlado
                    @endif
                </td>
            
                <td class="table-unit" width="50%">
                    <strong>Via de Administração:</strong> {{ $val->administrations }}
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="50%">
                    <strong>Medicação:</strong> {{ $val->prescriptions }}
                </td>
 
                <td class="table-unit" width="50%">
                    <strong>Quantidade Medicamento:</strong> {{ $val->amount }}
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="100%" colspan="2">
                    <strong>Unidade Medida:</strong> {{ $val->units }}
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="100%" colspan="2">
                    <strong>Responsavel:</strong> {{ $val->responsible_crm }} - {{ $val->responsible }}
                </td>
            </tr>
           
            <tr>
                <td class="table-unit" width="100%" colspan="2">
                    <strong>Orientação:</strong> {{ $val->note }}
                </td>
            </tr>
        </table>

        @if($count != $emergency_services_prescriptions['count'])
            <hr class="line">
        @endif

    @endforeach
@endif

<!-- line sing -->
@include('layouts/admin/fragments.line-sing')
@endsection