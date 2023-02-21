<input type="hidden" id="IdUsersResponsibleInternment" name="IdUsersResponsibleInternment" class="form-control form-control-sm" value="{{ auth()->user()->IdUsers }}">

<!-- Laudo Técnico e Justificativa -->
<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Laudo Técnico e Justificativa de Internação</h5>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">

        <div class="row mt-2">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="main_signs_fields" class="form-group">
                    <label class="form-label" for="main_signs_label">Principais Sinais e Sintomas Clínicos:</label>
                    <textarea class="form-control form-control-sm @error('main_signs') is-invalid @enderror" id="main_signs" name="main_signs" rows="4" required>{{$emergency_services_conducts->main_signs ?? ""}}</textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="justify_hospitalization_fields" class="form-group">
                    <label class="form-label" for="justify_hospitalization_label">Condições que justificam a internação:</label>
                    <textarea class="form-control form-control-sm @error('justify_hospitalization') is-invalid @enderror" id="justify_hospitalization" name="justify_hospitalization" rows="4" required>{{$emergency_services_conducts->justify_hospitalization ?? ""}}</textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="main_results_fields" class="form-group">
                    <label class="form-label" for="main_results_label">Principais Resultados de Provas Diagnósticas(Resultado dos exames realizados):</label>
                    <textarea class="form-control form-control-sm @error('main_results') is-invalid @enderror" id="main_results" name="main_results" rows="4">{{$emergency_services_conducts->main_results ?? ""}}</textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12 col-md col-lg col-xl">
                <label for="date_initial_diagnosis" id="label_date_initial_diagnosis"><strong>Data do Diagnóstico Inicial:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="date_initial_diagnosis" name="date_initial_diagnosis" class="form-control form-control-sm" value="@if(!empty($emergency_services_conducts->date_initial_diagnosis)){{ date('d-m-Y', strtotime($emergency_services_conducts->date_initial_diagnosis)) }}@elseif(!empty($emergency_services_diagnostics[0]) AND (!empty($emergency_services_diagnostics[0]['date']))){{ date('d-m-Y', strtotime($emergency_services_diagnostics[0]['date'])) }}@endif">
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div id="code_main_filter_fields" class="form-group">
                    <label for="code_main_filter" id="label_code_main_filter"><strong>Código FILTRO:</strong></label>
                    <input type="text" id="code_main_filter" name="code_main_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <label for="cid10_main_filter" id="label_cid10_main_filter"><strong>CID10 FILTRO:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="cid10_main_filter" name="cid10_main_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>

            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="IdCid10Main_fields" class="form-group">
                    <label for="IdCid10Main" id="label_IdCid10Main">CID10 Principal</label>
                    <select id="IdCid10Main" name="IdCid10Main" class="form-control form-control-sm @error('IdCid10Main') is-invalid @enderror" url-query="{{ route('cid10.form.json') }}">
                        <option value="@if((!empty($emergency_services_conducts)) AND (!empty($emergency_services_conducts->IdCid10Main))) {{$emergency_services_conducts->IdCid10Main}} @elseif((!empty($emergency_services_diagnostics)) AND (!empty($emergency_services_diagnostics[0]))) {{ $emergency_services_diagnostics[0]['IdCid10'] }}  @endif">...</option>
                    </select>
                </div>              
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div id="code_secondary_filter_fields" class="form-group">
                    <label for="code_secondary_filter" id="label_code_secondary_filter"><strong>Código FILTRO:</strong></label>
                    <input type="text" id="code_secondary_filter" name="code_secondary_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <label for="cid10_secondary_filter" id="label_cid10_secondary_filter"><strong>CID10 FILTRO:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="cid10_secondary_filter" name="cid10_secondary_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>
        
            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="IdCid10Secondary_fields" class="form-group">
                    <label for="IdCid10Secondary" id="label_IdCid10Secondary">CID10 Secundário</label>
                    <select id="IdCid10Secondary" name="IdCid10Secondary" class="form-control form-control-sm @error('IdCid10Secondary') is-invalid @enderror" url-query="{{ route('cid10.form.json') }}">
                        <option value="@if((!empty($emergency_services_conducts)) AND (!empty($emergency_services_conducts->IdCid10Secondary))) {{$emergency_services_conducts->IdCid10Secondary}} @elseif((!empty($emergency_services_diagnostics)) AND (!empty($emergency_services_diagnostics[1]))) {{ $emergency_services_diagnostics[1]['IdCid10'] }}  @endif">...</option>
                    </select>
                </div>              
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div id="code_associated_causes_filter_fields" class="form-group">
                    <label for="code_associated_causes_filter" id="label_code_associated_causes_filter"><strong>Código FILTRO:</strong></label>
                    <input type="text" id="code_associated_causes_filter" name="code_associated_causes_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-">
                <label for="cid10_associated_causes_filter" id="label_cid10_associated_causes_filter"><strong>CID10 FILTRO:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="cid10_associated_causes_filter" name="cid10_associated_causes_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>
        
            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="IdCid10AssociatedCauses_fields" class="form-group">
                    <label for="IdCid10AssociatedCauses" id="label_IdCid10AssociatedCauses">CID10 Causas Associadas</label>
                    <select id="IdCid10AssociatedCauses" name="IdCid10AssociatedCauses" class="form-control form-control-sm @error('IdCid10AssociatedCauses') is-invalid @enderror" url-query="{{ route('cid10.form.json') }}">
                        <option value="@if((!empty($emergency_services_conducts)) AND (!empty($emergency_services_conducts->IdCid10AssociatedCauses))) {{$emergency_services_conducts->IdCid10AssociatedCauses}} @elseif((!empty($emergency_services_diagnostics)) AND (!empty($emergency_services_diagnostics[1]))) {{ $emergency_services_diagnostics[1]['IdCid10'] }}  @endif">...</option>
                    </select>
                </div>              
            </div>
        </div>
    </div>
</div>

<!-- Acidentes ou Violências -->
<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Preencher em caso de causas externas (Acidentes ou Violências)</h5>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">

        <div class="row mt-0">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label for="condition" id="label_condition"><strong></strong></label><br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="traffic_accident" name="traffic_accident" value="on" @if(old('traffic_accident') or ((!empty($emergency_services_conducts)) AND ($emergency_services_conducts) AND $emergency_services_conducts->traffic_accident)) checked @endif/>
                        <label class="form-check-label" for="traffic_accident">Acidente de Trânsito</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="acid_work" name="acid_work" value="on" @if(old('acid_work') or ((!empty($emergency_services_conducts)) AND ($emergency_services_conducts) AND $emergency_services_conducts->acid_work)) checked @endif/>
                        <label class="form-check-label" for="acid_work">Acid. de Trabalho Típico</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="acid_work_path" name="acid_work_path" value="on" @if(old('acid_work_path') or ((!empty($emergency_services_conducts)) AND ($emergency_services_conducts) AND $emergency_services_conducts->acid_work_path)) checked @endif/>
                        <label class="form-check-label" for="acid_work_path">Acid. de Trabalho Trajeto</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="insurance_cnpj_fields" class="form-group">
                    <label for="insurance_cnpj" id="label_insurance_cnpj">CNPJ Seguradora:</label>
                    <input type="text" id="insurance_cnpj" name="insurance_cnpj" class="form-control form-control-sm" value="{{ old('insurance_cnpj') ?? $emergency_services_conducts->insurance_cnpj ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="no_ticket_fields" class="form-group">
                    <label for="no_ticket" id="label_no_ticket">Nr. Bilhete:</label>
                    <input type="text" id="no_ticket" name="no_ticket" class="form-control form-control-sm" value="{{ old('no_ticket') ?? $emergency_services_conducts->no_ticket ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="serie_fields" class="form-group">
                    <label for="serie" id="label_serie">Série:</label>
                    <input type="text" id="serie" name="serie" class="form-control form-control-sm" value="{{ old('serie') ?? $emergency_services_conducts->serie ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="insurance_company_cnpj_fields" class="form-group">
                    <label for="insurance_company_cnpj" id="label_insurance_company_cnpj">CNPJ Seguradora:</label>
                    <input type="text" id="insurance_company_cnpj" name="insurance_company_cnpj" class="form-control form-control-sm" value="{{ old('insurance_company_cnpj') ?? $emergency_services_conducts->insurance_company_cnpj ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="no_ticket_fields" class="form-group">
                    <label for="no_ticket" id="label_no_ticket">Numero Bilhete:</label>
                    <input type="text" id="no_ticket" name="no_ticket" class="form-control form-control-sm" value="{{ old('no_ticket') ?? $emergency_services_conducts->no_ticket ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="cbor_fields" class="form-group">
                    <label for="cbor" id="label_cbor">CBOR:</label>
                    <input type="text" id="cbor" name="cbor" class="form-control form-control-sm" value="{{ old('cbor') ?? $emergency_services_conducts->cbor ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="insurance_cnpj_fields" class="form-group">
                    <label for="insurance_cnpj" id="label_insurance_cnpj">CNPJ Empresa:</label>
                    <input type="text" id="insurance_cnpj" name="insurance_cnpj" class="form-control form-control-sm" value="{{ old('insurance_cnpj') ?? $emergency_services_conducts->insurance_cnpj ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="cnae_company_fields" class="form-group">
                    <label for="cnae_company" id="label_cnae_company">CNAE Empresa:</label>
                    <input type="text" id="cnae_company" name="cnae_company" class="form-control form-control-sm" value="{{ old('cnae_company') ?? $emergency_services_conducts->cnae_company ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="cbor_fields" class="form-group">
                    <label for="cbor" id="label_cbor">CBOR:</label>
                    <input type="text" id="cbor" name="cbor" class="form-control form-control-sm" value="{{ old('cbor') ?? $emergency_services_conducts->cbor ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md col-lg col-xl">
            <div id="description_nature_njury_fields" class="form-group">
                <label for="description_nature_njury" id="label_description_nature_njury" class="label_description_nature_njury">Descrição Natureza da Lesão:</label>
                <select name="description_nature_njury" class="form-control form-control-sm @error('description_nature_njury') is-invalid @enderror">
                    <option value="">...</option>
                    <option value="l" @if((old('description_nature_njury') == "l") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->description_nature_njury == "l")))selected @endif>Leve</option>
                    <option value="g" @if((old('description_nature_njury') == "g") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->description_nature_njury == "g")))selected @endif>Grave</option>
                    <option value="gv" @if((old('description_nature_njury') == "gv") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->description_nature_njury == "gv")))selected @endif>Gravíssima</option>
                </select>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('admin/js/modules/users_filtes.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/query-zipcode.js') }}"></script>
<script src="{{ asset('admin/js/modules/emergency_services_internacao.js') }}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>


<script type="text/javascript">

$(document).ready(function() {
    $("input[id='date_initial_diagnosis']").mask('99-99-9999');
})

</script>
    