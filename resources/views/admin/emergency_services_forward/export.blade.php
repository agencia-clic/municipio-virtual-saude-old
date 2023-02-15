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
    <p class="title-card-info">Dados do Encaminhamento</p>
</div>

@if(!empty($emergency_services_forward['data']) AND ($emergency_services_forward['count'] > 0))

    @php $count = 0; @endphp
    @foreach ($emergency_services_forward['data'] as $val)
        @php $count++; @endphp

        <table style="width: 100%; margin-top: 0;">
            <tr>
                <td class="table-unit" width="100%">
                    <strong>Procedimento:</strong> {{ $val->code }} - {{ $val->title }}
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="100%">
                    <strong>Responsavel:</strong> {{ $val->responsible_crm }} - {{ $val->responsible }}
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="100%">
                    <strong>Especialidade:</strong> {{ $val->specialty }} ({{ $val->categorie }})
                </td>
            </tr>
            <tr>
                <td class="table-unit" width="100%">
                    <strong>Motivo do Encaminhamento:</strong> {{ $val->note }}
                </td>
            </tr>
        </table>

        @if($count != $emergency_services_forward['count'])
            <hr class="line">
        @endif

    @endforeach
@endif


<!-- line sing -->
@include('layouts/admin/fragments.line-sing')
@endsection