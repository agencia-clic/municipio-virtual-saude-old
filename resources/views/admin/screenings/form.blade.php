@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Acolhimento</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($screenings->IdScreenings) ? route('screenings.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) : route('screenings.form.update', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices), 'IdScreenings' => base64_encode($screenings->IdScreenings)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="{{ route('screenings') }}"><span class="fas fa-arrow-left"></span></button>

                            @if(empty($screenings))
                                <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('screenings')}}">Acolhimentos</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(empty($screenings))Inserir @else Visualizar @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @csrf <!--token--> 

    <div class="row mt-3">

        <!-- info users current -->
        <div class="col-sm-12 col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-end">
                        <div class="col-12 align-self-center">
                            <h5>
                                <h6 class="alert-heading fw-semi-bold">
                                <span class="mt-1"> {{ $emergency_services->users_name }}
                                    @if($emergency_services->users_cpf_cnpj)
                                        • {{ $mask->cpf_cnpj($emergency_services->users_cpf_cnpj) }}
                                    @endif
                        
                                    @if(!empty($emergency_services->users_date_birth))
                                        • {{ $mask->birth($emergency_services->users_date_birth) }} ANOS
                                    @endif</span> 
                                </h6>
                        
                                <h6 class="alert-heading fw-semi-bold">
                                    <span class="h6 alert-heading fw-semi-bold"><strong>Atendimento:</strong> {{$emergency_services->IdEmergencyServices}}</span>
                                    • <span class="h6 alert-heading fw-semi-bold"><strong>Entrada:</strong> {{ $emergency_services->created_at->format('d-m-Y H:i') }}</span> 
                                </h6>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-3">
            <div class="kanban-items-container border bg-white rounded-2 py-3 mb-3" style="max-height: none;">
                <div class="card mb-3 kanban-item shadow-sm active" data-class="data-front-desk">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-file-alt fs-1"></span>
                            <span class="nav-link-text ps-1">Recepção</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="vital-data">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-heartbeat fs-1"></span>
                            <span class="nav-link-text ps-1">Dados Vitais</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="forwarding">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-file-export fs-1"></span>
                            <span class="nav-link-text ps-1">Encaminhamento</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="allergies-diseases">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-first-aid fs-1"></span>
                            <span class="nav-link-text ps-1">Alergias / Doenças / Antecedentes</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-historic">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-history fs-1"></span>
                            <span class="nav-link-text ps-1">Histórico</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="registration-data">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-address-card fs-1"></span>
                            <span class="nav-link-text ps-1">Dados Cadastrais</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-9">

            <!-- basic - start -->
            @if(!empty($screenings))
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-end">
                        <div class="col-12 align-self-center">
                            <h5 class="mb-0">Básico</h5>
                        </div>
                    </div>
                </div>
                
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div id="IdScreenings_fields" class="form-group">
                                <label for="IdScreenings" id="label_IdScreenings">Código:</label>
                                <input type="text" id="IdScreenings" name="IdScreenings" class="form-control" value="@if(!empty($screenings)){{ $screenings->IdScreenings }}@endif" readonly="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div id="created_at_fields" class="form-group">
                                <label for="created_at" id="label_created_at">Criação:</label>
                                <input type="text" id="created_at" name="created_at" class="form-control" value="@if(!empty($screenings)){{ date('d-m-Y H:i', strtotime($screenings->created_at)) }}@endif" maxlength="19" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- front desk -->
            <div class="data-front-desk block-item-class">
                @include('layouts/admin/fragments.front-desk')
            </div>

            <!-- atendimento -->
            <div class="vital-data block-item-class">
                
                <!-- content - start -->
                <div class="card mb-3 card-content">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Conteúdo</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="temperature_fields" class="form-group">
                                    <label for="temperature" id="label_temperature">Temperatura:</label>
                                    <input type="text" id="temperature" name="temperature" class="form-control  @error('temperature') is-invalid @enderror" value="{{old('temperature') ?? $screenings->temperature ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="weight_fields" class="form-group">
                                    <label for="weight" id="label_weight">Peso:</label>
                                    <input type="text" id="weight" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{old('weight') ?? $screenings->weight ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="heart_rate_fields" class="form-group">
                                    <label for="heart_rate" id="label_heart_rate">Frequência Cardíaca (BPM):</label>
                                    <input type="text" id="heart_rate" name="heart_rate" class="form-control @error('heart_rate') is-invalid @enderror" value="{{old('heart_rate') ?? $screenings->heart_rate ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="height_fields" class="form-group">
                                    <label for="height" id="label_height">Altura:</label>
                                    <input type="text" id="height" name="height" class="form-control @error('height') is-invalid @enderror" value="{{old('height') ?? $screenings->height ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="respiratory_frequency_fields" class="form-group">
                                    <label for="respiratory_frequency" id="label_respiratory_frequency">Frequência Respiratória (RPM):</label>
                                    <input type="text" id="respiratory_frequency" name="respiratory_frequency" class="form-control @error('respiratory_frequency') is-invalid @enderror" value="{{old('respiratory_frequency') ?? $screenings->respiratory_frequency ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="O2_saturation_fields" class="form-group">
                                    <label for="O2_saturation" id="label_O2_saturation">Saturação O²:</label>
                                    <input type="text" id="O2_saturation" name="O2_saturation" class="form-control @error('O2_saturation') is-invalid @enderror" value="{{old('O2_saturation') ?? $screenings->O2_saturation ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="blood_pressure_fields" class="form-group">
                                    <label for="blood_pressure" id="label_blood_pressure">Pressão Arterial (MM/HG):</label>
                                    <input type="text" id="blood_pressure" name="blood_pressure" class="form-control @error('blood_pressure') is-invalid @enderror" value="{{old('blood_pressure') ?? $screenings->blood_pressure ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="ecg_fields" class="form-group">
                                    <label for="ecg" id="label_ecg">ECG:</label>
                                    <input type="text" id="ecg" name="ecg" class="form-control @error('ecg') is-invalid @enderror" value="{{old('ecg') ?? $screenings->ecg ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="blood_glucose_fields" class="form-group">
                                    <label for="blood_glucose" id="label_blood_glucose">Glicemia:</label>
                                    <input type="text" id="blood_glucose" name="blood_glucose" class="form-control @error('blood_glucose') is-invalid @enderror" value="{{old('blood_glucose') ?? $screenings->blood_glucose ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="rule_of_pain_fields" class="form-group">
                                    <label for="rule_of_pain" id="label_rule_of_pain"></label>
                                    <label class="form-label" for="rule_of_pain">Régua da Dor: <span>{{old('rule_of_pain') ?? $screenings->rule_of_pain ?? "0"}}</span></label>
                                    <input class="form-range" id="rule_of_pain" name="rule_of_pain" class="form-control @error('rule_of_pain') is-invalid @enderror" value="{{old('rule_of_pain') ?? $screenings->rule_of_pain ?? "0"}}" type="range" min="0" max="10" @if(!empty($screenings)) disabled @endif/>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label for="condition" id="label_condition"><strong>Condição:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="condition_hypertensive" name="condition_hypertensive" value="on" @if(old('condition_hypertensive') or (($screenings) AND $screenings->condition_hypertensive)) checked @endif @if(!empty($screenings)) disabled @endif/>
                                        <label class="form-check-label" for="condition_hypertensive">Hipertenso</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="condition_diabetic" name="condition_diabetic" value="on" @if(old('condition_diabetic') or (($screenings) AND $screenings->condition_diabetic)) checked @endif @if(!empty($screenings)) disabled @endif/>
                                        <label class="form-check-label" for="condition_diabetic">Diabético</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="condition_heart_disease" name="condition_heart_disease" value="on" @if(old('condition_heart_disease') or (($screenings) AND $screenings->condition_heart_disease)) checked @endif @if(!empty($screenings)) disabled @endif/>
                                        <label class="form-check-label" for="condition_heart_disease">Diabético</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="condition_pregnant" name="condition_pregnant" value="on" @if(old('condition_pregnant') or (($screenings) AND $screenings->condition_pregnant)) checked @endif @if(!empty($screenings)) disabled @endif/>
                                        <label class="form-check-label" for="condition_pregnant">Gestante</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 hide gestational-block">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div id="gestational_age_fields" class="form-group">
                                    <label for="gestational_age" id="label_gestational_age">Idade Gestacional:</label>
                                    <input type="text" id="gestational_age" name="gestational_age" class="form-control @error('gestational_age') is-invalid @enderror" value="{{old('gestational_age') ?? $screenings->gestational_age ?? ""}}" @if(!empty($screenings)) disabled @endif>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="classification_fields" class="form-group">
                                    <label for="classification" id="label_classification"></label>
                                    <label class="form-label" for="classification">Classificação: <span></span></label>
                                    <input class="form-range" id="classification" name="classification" class="form-control @error('classification') is-invalid @enderror" value="{{old('classification') ?? $screenings->classification ?? "0"}}" type="range" min="0" max="4" @if(!empty($screenings)) disabled @endif/>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>

                <!-- complaints - start -->
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Queixas</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                        <textarea class="form-control @error('complaints') is-invalid @enderror" id="complaints" name="complaints" rows="3" placeholder="Observação" @if(!empty($screenings)) disabled @endif>{{old('complaints') ?? $screenings->complaints ?? ""}}</textarea>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
                <!-- complaints - end -->
            </div>

            <!-- forwarding -->
            <div class="forwarding block-item-class">
            
                <input type="hidden" name="type" value="a"/> 

                <!-- screenings - start -->
                <div class="card mb-3 card-specialties">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Fluxograma</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">

                        <div class="alert alert-warning flowcharts_alert hide" role="alert">
                            Não há nenhum profissional em atendimento neste Fluxo.
                        </div>

                        <div id="IdFlowcharts_fields" class="form-group">
                            <label for="IdFlowcharts" id="label_IdFlowcharts" class="label_IdFlowcharts">Fluxo</label>
                            <select name="IdFlowcharts" id="IdFlowcharts" class="form-control @error('IdFlowcharts') is-invalid @enderror" @if(!empty($screenings)) disabled @endif>
                                <option value="">...</option>
                                @if(!empty($flowcharts))
                                    @foreach($flowcharts as $val)
                                        <option value="{{ $val->IdFlowcharts }}" @if(old('IdFlowcharts') == $val->IdFlowcharts OR (!empty($screenings) AND ($val->IdFlowcharts == $screenings->IdFlowcharts)))selected @endif data-count="{{ $val->count_user_units() }}">{{ $val->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <!-- screenings - end -->

                <!-- discharge reason - start -->
                <div class="card mb-3 card-discharge-reason hide">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Liberar Paciente</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">   

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                                <div id="discharge_reason_fields" class="form-group">
                                    <label for="discharge_reason" id="label_discharge_reason">Motivo da Alta:</label>
                                    <textarea class="form-control @error('discharge_reason') is-invalid @enderror" id="discharge_reason" name="discharge_reason" rows="3" placeholder="Observação" @if(!empty($screenings)) disabled @endif>{{old('discharge_reason') ?? $emergency_services->discharge_reason ?? ""}}</textarea>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- discharge reason - end -->

            </div> 

            <!-- allergies diseases -->
            <div class="allergies-diseases block-item-class">
                
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Alergias Doenças</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('users_diseases', ['type' => "a", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary" type="button"  title="Alergias Doenças" iframe-form="{{ route('users_diseases.form', ['type' => "a", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}" iframe-create="{{ route('users_diseases.form.create', ['type' => "a", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}">Inserir</button>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Antecedentes</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('users_diseases', ['type' => "b", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary" type="button"  title="Antecedentes" iframe-form="{{ route('users_diseases.form', ['type' => "b", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}" iframe-create="{{ route('users_diseases.form.create', ['type' => "b", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}">Inserir</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- historic -->
            <div class="data-historic block-item-class">

                <div class="card mb-3 diagnostics-card">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Histórico</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('emergency_services.historic', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                    </div>
                </div>
            </div>

            <!-- registration data -->
            <div class="registration-data block-item-class">
                @include('layouts/admin/fragments.users')
            </div>

        </div>
    </div>
</form>

@endsection

<!-- scripts - start -->
@section('scripts')

<script>
    @if(empty($screenings))
        localStorage.setItem('block-item-select', '')
    @endif
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>
<script src="{{ asset('admin/js/inputmask.js') }}"></script>
<script src="{{ asset('admin/js/price_format.js') }}"></script>
<script src="{{ asset('admin/js/modules/screenings.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/classification_manchester.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/block-item.js') }}" type="text/javascript"></script>

<script type="text/javascript">
function existem_users() {
    $('.flowcharts_alert').addClass('hide')
    if($('#IdFlowcharts option:selected').attr('data-count') == 0){
        $('.flowcharts_alert').removeClass('hide')
    }
}
existem_users()

$(document).ready(function() {

    $(document).on('change', '#IdFlowcharts', function(){
        existem_users()
    })

    //region - validação
	$("#form").validate({
		rules: {

            IdServiceUnitsForwarding:{
                required:{
					depends: function(element) {
						return $("#type").val() == "e";
					}
				},
            },

            temperature: "required",
            O2_saturation: "required",
            blood_pressure: "required",

            forwarding_reason:{
                required:{
					depends: function(element) {
						return $("#type").val() == "e";
					}
				},
            },

            IdFlowcharts:{
                required:{
					depends: function(element) {
						return $("#type").val() == "a";
					}
				},
            },
		},
		messages: {

		},
		onkeyup: false,
		submitHandler: function(form) {

			$(this.submitButton).prop('disabled', true);
			form.submit();

		},
		errorElement: "label",
		errorPlacement: function (error, element) {
			//alert(JSON.stringify(error));
			error.addClass("invalid-feedback");
			if(element.parent().hasClass('input-group')){
				error.insertAfter( element.parent() );
			} else if (element.prop("type") === "checkbox") {
				error.insertAfter(element.next("label"));
			} else {
				error.insertAfter(element);
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid");
            $(element).prop('required', true)
            validate_form()
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
			$("label[id='"+$(element).attr("id")+"-error']").remove(); // exclui o label já validade (padrao validate é display: none)

		},
		ignore: true
	});
	//endregion -  validação

})
</script>

@endsection
<!-- end - start -->