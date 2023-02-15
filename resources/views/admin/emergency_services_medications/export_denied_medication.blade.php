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
    <p class="title-card-info">Termo de recusa de Tratamento</p>
</div>

<table style="width: 100%; margin-top: 20;">
    <tr>
        <td class="table-unit-not" style="font-size: 13px;" width="100%">
            Eu _______________________________________ ou responsável por _______________________________________
            estando lúcido(a) e consciente, declaro que me responsabilizo pela recusa em aceitar o(s) tratamento(s) abaixo
            referido(s), e que fui, pelo Médico/Enfermeiro abaixo identificado, devidamente informado(a) acerca da minha (sua) situação
            clínica, das possíveis complicações e riscos que corro com esta minha decisão.
        </td>
    </tr>
</table>

<table style="width: 100%; margin-top: 30;">
    <tr>
        <td class="table-unit-not" width="100%">
            <strong>Medicamento recusado:</strong>
            {{ $emergency_services_medications->title }}
        </td>
    </tr>
</table>

<table style="width: 100%; margin-top: 30;">
    <tr>
        <td class="table-unit-not" width="100%">
            <strong>Observação:</strong>
            {{ $emergency_services_medications->note_denied_medication }}
        </td>
    </tr>
</table>

<div style="text-align: center; margin-top: 100px;">
    <h1 class="line-sing-text">_________________________________________</h1>
    <h1 class="line-sing-text">Paciente / Responsável</h1>
</div>

<span>&nbsp;</span>

<div style="text-align: center; margin-top: 50px;">
    <h1 class="line-sing-text">_________________________________________</h1>
    <h1 class="line-sing-text">Médico / Enfermeiro</h1>
</div>

<table style="width: 100%; margin-top: 200px;">
    <tr>
        <td class="table-unit-not" width="100%">
            <strong>Grau de Parentesco com o(a) Paciente: __________________________________________________________________________</strong>
           
        </td>
    </tr>
</table>

@endsection