@extends('layouts.admin.export-procedure')

<!-- style css -->
@section('style')

<style>
    .card-info{
        height: 19px;
        width: 100%;
        background: #071e26;
    }
    .title-card-info{
        color: white;
        text-align: center;
        margin-top:10px;
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
    .card-table{
        border: solid 2px;
        color: #071e26;
        height: 60px;
    }
    .title{
        font-size: 14px;
        color: rgb(61, 61, 61);
    }
    .title-card-info{
        font-size: 14px;
        font-weight: bold;
    }

    fieldset {
        border: 1px solid #000;
        font-size: 7.2px;
        height: 13px;
    }

    .text-fildset{
        font-size: 12px;
        margin-top: 0px;
    }
</style>

@endsection

<!-- contents -->
@section('content')

<table style="margin-top: 10; width: 98%; margin-left: 6;">
    <tr>
        <td style="text-align: center;" width="30%">
            <div class="card-table" style=" width: 90%;">
                <img src="{{ Storage::url('assets/sus.png') }}" style="margin-top: 5px; width:120px;">
            </div>
        </td>
        <td style="text-align: center;" width="70%">
            <div class="card-table" style=" width: 100%;">
                <h1 class="title">
                    <strong>LAUDO PARA SOLICITAÇÃO/AUTORIZAÇÃO DE PROCEDIMENTO AMBULATORIAL</strong>
                </h1>
            </div>
        </td>
    </tr>
</table>

<div class="card-info">
    <p class="title-card-info">
        IDENTIFICAÇÃO DO ESTABELECIMENTO DE SAÚDE (SOLICITANTE)
    </p>
</div>

<table style="width: 100%; margin-top: 10;">
    <tr>
        <td class="table-unit" width="80%">
            <fieldset>
                <legend><strong>1 - NOME DO ESTABELECIMENTO SOLICITANTE</strong></legend>
                <p class="text-fildset">{{ $service_units->name }}</p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>2 - C N E S</strong></legend>
                <p class="text-fildset" style="text-align:center;">{{ $service_units->code }}</p>
            </fieldset>
        </td>
    </tr>
</table>

<div class="card-info" style="margin-top: -5;">
    <p class="title-card-info">
        IDENTIFICAÇÃO DO PACIENTE
    </p>
</div>

<table style="width: 100%; margin-top: 5;">
    <tr>
        <td class="table-unit" width="60%" colspan="2">
            <fieldset>
                <legend><strong>3 - NOME DO PACIENTE</strong></legend>
                <p class="text-fildset">
                    {{ $users_paciente->name }}
                </p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>4 - SEXO</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    
                    @if($users_paciente->sex == "f")
                        Femi
                    @elseif($users_paciente->sex == "m")
                        Masc
                    @else
                        Outros
                    @endif
                </p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>5 - Nº FICHA</strong></legend>
                <p class="text-fildset" style="text-align:center;">{{ $IdEmergencyServices }}</p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="table-unit" width="40%">
            <fieldset>
                <legend><strong>6 - CARTÃO NACIONAL DE SAÚDE (CNS)</strong></legend>
                <p class="text-fildset">{{ $users_paciente->cns }}</p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>7 - DATA DE NASCIMENTO</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    {{ date('d-m-Y', strtotime($users_paciente->date_birth)) }}
                </p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>8 - RAÇA/COR</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    @if(!empty($users_paciente) AND ($users_paciente->breed == "B"))BRANCA @endif
                    @if(!empty($users_paciente) AND ($users_paciente->breed == "N"))NEGRA @endif
                    @if(!empty($users_paciente) AND ($users_paciente->breed == "P"))PARDA @endif
                    @if(!empty($users_paciente) AND ($users_paciente->breed == "A"))AMARELA @endif
                    @if(!empty($users_paciente) AND ($users_paciente->breed == "I"))INDIGENA @endif
                    @if(!empty($users_paciente) AND ($users_paciente->breed == "O"))OUTROS @endif
                </p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>8.1 - ETNIA</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="table-unit" width="40%" colspan="2">
            <fieldset>
                <legend><strong>9 - NOME DA MÃE</strong></legend>
                <p class="text-fildset">{{ $users_paciente->mother }}</p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%" colspan="2">
            <fieldset>
                <legend><strong>10 - TELEFONE DE CONTATO</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    
                </p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="table-unit" width="40%" colspan="2">
            <fieldset>
                <legend><strong>11 - NOME DO RESPONSÁVEL</strong></legend>
                <p class="text-fildset">
                    {{ $emergency_services->escort_name }}
                </p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%" colspan="2">
            <fieldset>
                <legend><strong>12 - TELEFONE DE CONTATO</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    {{ $mask->phone($emergency_services->escort_phone) }}
                </p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="table-unit" width="100%" colspan="4">
            <fieldset>
                <legend><strong>13 - ENDEREÇO (RUA, Nº, BAIRRO</strong></legend>
                <p class="text-fildset">
                    {{ $users_paciente->address }} {{ $users_paciente->number ? " - {$users_paciente->number}" : ""}} {{ $users_paciente->complement ? " - {$users_paciente->complement}" : ""}}
                </p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="table-unit" width="40%">
            <fieldset>
                <legend><strong>14 - MUNICÍPIO DE RESIDÊNCIA</strong></legend>
                <p class="text-fildset">
                    {{ $users_paciente->city }}
                </p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>15 - CÓD. IBGE MUNICÍPIO</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="10%">
            <fieldset>
                <legend><strong>16 - UF</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    {{ $users_paciente->uf }}
                </p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>17 - CEP</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    {{ $users_paciente->zip_code }}
                </p>
            </fieldset>
        </td>
    </tr>
</table>

<div class="card-info" style="margin-top: -5;">
    <p class="title-card-info">
        PROCEDIMENTOS SOLICITADOS
    </p>
</div>

@if(!empty($emergency_services_procedures))

    @foreach($emergency_services_procedures as $val)
        
        <table style="width: 100%; margin-top: 5;">
            <tr>
                <td class="table-unit" width="25%">
                    <fieldset>
                        <legend><strong>18 -CÓD. DO PROCEDIMENTO PRINCIPAL</strong></legend>
                        <p class="text-fildset">
                            {{ $val->code }}
                        </p>
                    </fieldset>
                </td>

                <td class="table-unit" width="75%">
                    <fieldset>
                        <legend><strong>19 - NOM DO PROCEDIMENTO PRINCIPAL</strong></legend>
                        <p class="text-fildset" style="text-align:center;">
                            {{ $val->title }}
                        </p>
                    </fieldset>
                </td>

                <td class="table-unit" width="10%">
                    <fieldset>
                        <legend><strong>20 - QTDE</strong></legend>
                        <p class="text-fildset" style="text-align:center;">1</p>
                    </fieldset>
                </td>
            </tr>
        </table>

    @endforeach

@endif

<div class="card-info" style="margin-top: -5;">
    <p class="title-card-info">
        JUSTIFICATIVA DO(S) PROCEDIMENTOS(S) SOLICITADOS(S)
    </p>
</div>

<table style="width: 100%; margin-top: 5;">
    <tr>
        <td class="table-unit" width="30%">
            <fieldset>
                <legend><strong>36 - DESCRIÇÃO DO DIAGNOSTICO</strong></legend>
                <p class="text-fildset"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>37 - CID 10 PRINCIPAL</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>38 - CID 10 SECUNDÁRIO</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="20%">
            <fieldset>
                <legend><strong>39 - CID 10 CAUSAS ASSOCIADAS</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>
    </tr>

    <tr>
        <td class="table-unit" width="100%" colspan="4">
            <fieldset style="height:70px;">
                <legend><strong>40 - OBSERVAÇÕES</strong></legend>
                <p class="text-fildset"></p>
            </fieldset>
        </td>
    </tr>
</table>

<div class="card-info" style="margin-top: -5;">
    <p class="title-card-info">
        SOLICITAÇÃO
    </p>
</div>

<table style="width: 100%; margin-top: 5;">
    <tr>
        <td class="table-unit" width="30%">
            <fieldset>
                <legend><strong>41 - NOME DO PROFISSIONAL SOLICITANTE</strong></legend>
                <p class="text-fildset">{{ $users_responsible->name }}</p>
            </fieldset>
        </td>

        <td class="table-unit" width="35%">
            <fieldset>
                <legend><strong>42 - DATA DA SOLICITACAO</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    {{ $procedures_groups->created_at->format('d-mY H:i') }}
                </p>
            </fieldset>
        </td>

        <td class="table-unit" width="40%" rowspan="2">
            <fieldset style="height: 60px">
                <legend><strong>43 - ASSINATURA E CARIMBRO (Nº DO REGISTRO DO CONSELHO)</strong></legend>
                <p class="text-fildset" style="text-align:center;">1</p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="table-unit" width="10%">
            <fieldset>
                <legend><strong>44- DOCUMENTO</strong></legend>
                <p class="text-fildset">( ) CNS (<strong>X</strong>) CPF</p>
            </fieldset>
        </td>

        <td class="table-unit">
            <fieldset>
                <legend><strong>45 - Nº DOCUMENTO (CNS/CPF) DO PROFISSIONAL SOLICITANTE</strong></legend>
                <p class="text-fildset" style="text-align:center;">
                    {{ $users_responsible->cpf_cnpj }}
                </p>
            </fieldset>
        </td>
    </tr>
</table>

<div class="card-info" style="margin-top: -5;">
    <p class="title-card-info">
        AUTORIZAÇÃO
    </p>
</div>

<table style="width: 100%; margin-top: 5;">
    <tr>
        <td class="table-unit" width="30%">
            <fieldset>
                <legend><strong> 46 - NOME DO PROFISSIONAL AUTORIZADOR</strong></legend>
                <p class="text-fildset"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="36%">
            <fieldset>
                <legend><strong>47 - CÓD ÓRGÃO EMISSOR</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="30%" rowspan="2">
            <fieldset style="height: 60px">
                <legend><strong>48 - Nº DA AUTORIZAÇÃO (APAC)</strong></legend>
                <p class="text-fildset" style="text-align:center;">1</p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="table-unit" width="10%">
            <fieldset>
                <legend><strong>49 - DOCUMENTO</strong></legend>
                <p class="text-fildset">( ) CNS (<strong>X</strong>) CPF</p>
            </fieldset>
        </td>

        <td class="table-unit">
            <fieldset>
                <legend><strong>50 - Nº DOCUMENTO (CNS/CPF) DO PROFISSIONAL AUTORIZADOR</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>
    </tr>

    <tr>
        <td class="table-unit" width="30%">
            <fieldset>
                <legend><strong>51 - DATA DA AUTORIZAÇÃO</strong></legend>
                <p class="text-fildset"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="30%">
            <fieldset>
                <legend><strong>52 - ASSINATURA E CARIMBO (Nº DO REGISTRO DO CONSELHO)</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="40%">
            <fieldset>
                <legend><strong>53 - PERÍODO DE VALIDADE DA APAC</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>
    </tr>
</table>

<div class="card-info" style="margin-top: -5;">
    <p class="title-card-info">
        IDENTIFICAÇÃO DO ESTABELECIMENTO DE SAÚDE (EXECUTANTE)
    </p>
</div>

<table style="width: 100%; margin-top: 5;">
    <tr>
        <td class="table-unit" width="70%">
            <fieldset>
                <legend><strong>54 - NOME DO ESTABELECIMENTO EXECUTANTE</strong></legend>
                <p class="text-fildset"></p>
            </fieldset>
        </td>

        <td class="table-unit" width="30%">
            <fieldset>
                <legend><strong>55 - C N E S</strong></legend>
                <p class="text-fildset" style="text-align:center;"></p>
            </fieldset>
        </td>
    </tr>
</table>

@endsection