
@csrf <!--token--> 

<link href="{{ asset('admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />

<div class="row">

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="traffic_accident" id="label_traffic_accident"><strong>É decorrente de acidente de trânsito:</strong></label><br/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="traffic_accident-y" name="traffic_accident" value="y" @if(old('traffic_accident') or (($emergency_services_diagnostics) AND $emergency_services_diagnostics->traffic_accident == "y")) {{"checked"}} @endif/>
                <label class="form-check-label" for="traffic_accident-y">Sim</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="traffic_accident-n" name="traffic_accident" value="n" 
                @if(old('traffic_accident') OR ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->traffic_accident == "n") OR (empty($emergency_services_diagnostics)))) {{"checked"}} @endif/>
                <label class="form-check-label" for="traffic_accident-n">Não</label>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="work_related" id="label_work_related"><strong>É relacionado ao trabalho:</strong></label><br/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="work_related-y" name="work_related" value="y" @if(old('work_related') or (($emergency_services_diagnostics) AND $emergency_services_diagnostics->work_related == "y")) {{"checked"}} @endif/>
                <label class="form-check-label" for="work_related-y">Sim</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="work_related-n" name="work_related" value="n" 
                @if(old('work_related') OR ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->work_related == "n") OR (empty($emergency_services_diagnostics)))) {{"checked"}} @endif/>
                <label class="form-check-label" for="work_related-n">Não</label>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="violent_attack" id="label_violent_attack"><strong>É relacionado à atentado violento:</strong></label><br/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="violent_attack-y" name="violent_attack" value="y" @if(old('violent_attack') or (($emergency_services_diagnostics) AND $emergency_services_diagnostics->violent_attack == "y")) {{"checked"}} @endif/>
                <label class="form-check-label" for="violent_attack-y">Sim</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="violent_attack-n" name="violent_attack" value="n" 
                @if(old('violent_attack') OR ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->violent_attack == "n") OR (empty($emergency_services_diagnostics)))) {{ "checked" }} @endif/>
                <label class="form-check-label" for="violent_attack-n">Não</label>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="notifiable_disease" id="label_notifiable_disease"><strong>É doença de notificação compulsória:</strong></label><br/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="notifiable_disease-y" name="notifiable_disease" value="y" @if(old('notifiable_disease') or (($emergency_services_diagnostics) AND $emergency_services_diagnostics->notifiable_disease == "y")) {{"checked"}} @endif/>
                <label class="form-check-label" for="notifiable_disease-y">Sim</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="notifiable_disease-n" name="notifiable_disease" value="n" 
                @if(old('notifiable_disease') OR ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->notifiable_disease == "n") OR (empty($emergency_services_diagnostics)))) {{ "checked"}} @endif/>
                <label class="form-check-label" for="notifiable_disease-n">Não</label>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="diagnostics" id="label_diagnostics"><strong>Diagnóstico:</strong></label><br/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="diagnostics-d" name="diagnostics" value="d" @if(old('diagnostics') or ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->diagnostics == "d"))) {{"checked"}} @endif/>
                <label class="form-check-label" for="diagnostics-d">Definitivo</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="diagnostics-p" name="diagnostics" value="p" 
                {{(old('diagnostics') OR ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->diagnostics == "p") OR (empty($emergency_services_diagnostics)))) ? "checked" : ""}}/>
                <label class="form-check-label" for="diagnostics-p">Provisório</label>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="main_diagnosis" id="label_main_diagnosis"><strong>Diagnóstico Principal:</strong></label><br/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="main_diagnosis-y" name="main_diagnosis" value="y" @if(old('main_diagnosis') or ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->main_diagnosis == "y"))) {{"checked"}} @endif/>
                <label class="form-check-label" for="main_diagnosis-y">Sim</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="main_diagnosis-n" name="main_diagnosis" value="n" 
                @if(old('main_diagnosis') OR ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->main_diagnosis == "n") OR (empty($emergency_services_diagnostics)))) {{"checked"}} @endif/>
                <label class="form-check-label" for="main_diagnosis-n">Não</label>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="respiratory_symptomatic" id="label_respiratory_symptomatic"><strong>Sintomático Respiratório:</strong></label><br/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="respiratory_symptomatic-y" name="respiratory_symptomatic" value="y" @if(old('respiratory_symptomatic') or ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->respiratory_symptomatic == "y"))) {{"checked"}} @endif/>
                <label class="form-check-label" for="respiratory_symptomatic-y">Sim</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="respiratory_symptomatic-n" name="respiratory_symptomatic" value="n" 
                @if(old('respiratory_symptomatic') OR ((($emergency_services_diagnostics) AND $emergency_services_diagnostics->respiratory_symptomatic == "n") OR (empty($emergency_services_diagnostics)))) {{"checked"}} @endif/>
                <label class="form-check-label" for="respiratory_symptomatic-n">Não</label>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div id="date_fields" class="form-group">
            <label for="date" id="label_date">Data dos Primeiros Sintomas:</label>
            <input class="form-control datetimepicker" id="date" name="date" type="text" value="@if(!empty($emergency_services_diagnostics) AND ($emergency_services_diagnostics->date)){{ date('d-m-Y H:i', strtotime($emergency_services_diagnostics->date)) }} @else {{ date('d-m-Y') }} @endif" placeholder="d-m-y" locale="pt" data-options='{"disableMobile":true}'/>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div id="code_filter_fields" class="form-group">
            <label for="code_filter" id="label_code_filter">Código FILTRO:</label>
            <input type="text" id="code_filter" code_filter="code_filter" class="form-control" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div id="title_filter_fields" class="form-group">
            <label for="title_filter" id="label_title_filter">CID10 FILTRO:</label>
            <input type="text" id="title_filter" name="title_filter" class="form-control" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdCid10_fields" class="form-group">
            <label for="IdCid10" id="label_IdCid10">CID10</label>
            <select id="IdCid10" name="IdCid10" class="form-control" url-query="{{ route('cid10.form.json') }}">
                <option value="{{ $emergency_services_diagnostics->IdCid10 ?? "" }}">...</option>
            </select>
        </div>              
    </div>
</div>

<script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/pt.js"></script>
<script src="{{ asset('admin/js/flatpickr.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/emergency_services_diagnostics.js') }}" type="text/javascript"></script>