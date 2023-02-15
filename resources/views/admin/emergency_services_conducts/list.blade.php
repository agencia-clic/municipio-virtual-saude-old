@extends('layouts.admin.app')

<!-- head -->
@section('head')
<link href="{{ asset('admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Registrar Condutas</span>
</div>

<!-- form -- start -->
<form class="mt-3 needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ route('emergency_services_conducts.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices), 'type' => $type]) }}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="
                                @if($type == "p")
                                    {{ route('emergency_services_procedures.list.run') }}
                                @elseif($type == "i")
                                    {{ route('inpatients') }}
                                @elseif($type == "o")
                                    {{ route('observation') }}
                                @else
                                    {{ route('medical_care', ['IdFlowcharts' => $type]) }}
                                @endif"><span class="fas fa-arrow-left"></span></button>

                            @if($emergency_services->status == "a")
                                <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    
                                    <li class="breadcrumb-item"><a href="
                                        @if($type == "p")
                                            {{ route('emergency_services_procedures.list.run') }}
                                        @elseif($type == "i")
                                            {{ route('inpatients') }}
                                        @elseif($type == "o")
                                            {{ route('observation') }}
                                        @else
                                            {{ route('medical_care', ['IdFlowcharts' => $type]) }}
                                        @endif
                                    ">Voltar</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">@if(empty($medical_care))Inserir @else Editar @endif</li>
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
                                    <span class="
                                    @if((!empty($emergency_services->last_screenings())) AND $emergency_services->last_screenings()->classification == 4)
                                        emergency
                                    @elseif((!empty($emergency_services->last_screenings())) AND $emergency_services->last_screenings()->classification == 3)
                                        very_urgent
                                    @elseif((!empty($emergency_services->last_screenings())) AND $emergency_services->last_screenings()->classification == 2)
                                        urgent
                                    @elseif((!empty($emergency_services->last_screenings())) AND $emergency_services->last_screenings()->classification == 1)
                                        little_urgent
                                    @elseif((!empty($emergency_services)) AND $emergency_services->last_screenings()->classification == 0)
                                        not_urgent
                                    @else
                                        bg-500
                                    @endif me-1 icon-item" style="float: left;"></span>

                                   <span class="mt-1"> {{ $emergency_services->users_name }}
                                    @if($emergency_services->users_cpf_cnpj)
                                        • {{ $mask->cpf_cnpj($emergency_services->users_cpf_cnpj) }}
                                    @endif
                        
                                    @if($emergency_services->users_date_birth)
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

                <div class="card mb-3 kanban-item shadow-sm" data-class="data-front-desk">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-file-alt fs-0"></span>
                            <span class="nav-link-text ps-1">Informações</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-attendance">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-address-card fs-0"></span>
                            <span class="nav-link-text ps-1">Anamnese / Exame Físico</span>
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
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-main">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-user-md fs-0"></span>
                            <span class="nav-link-text ps-1">Principal</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm shadow-sm @if(app('request')->input('tab') == "nursing" OR empty(app('request')->input('tab'))) active @endif" data-class="data-nursing">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fa fa-stethoscope fs-0"></span>
                            <span class="nav-link-text ps-1">Enfermagem</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm shadow-sm @if(app('request')->input('tab') == "prescription") active @endif" data-class="data-prescription">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fa far fa-edit fs-0"></span>
                            <span class="nav-link-text ps-1">Prescrição</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm shadow-sm @if(app('request')->input('tab') == "check-in-prescription") active @endif" data-class="data-check-in-prescription">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-clipboard fs-0"></span>
                            <span class="nav-link-text ps-1">Check-in da Prescrição</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="declarations_attestation-nursing">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-file-invoice fs-0"></span>
                            <span class="nav-link-text ps-1">Declarações / Atestado</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="medical-report-nursing">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-file-invoice fs-0"></span>
                            <span class="nav-link-text ps-1">Laudo Médico</span>
                        </p>
                    </div>
                </div>
                @if($service_units->count() > 0)
                    <div class="card mb-3 kanban-item shadow-sm" data-class="unit-transfer">
                        <div class="card-body">
                            <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                                <span class="fas fa-share-square fs-0"></span>
                                <span class="nav-link-text ps-1">Tranferência de Unidade</span>
                            </p>
                        </div>
                    </div>
                @endif
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-upload">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-upload fs-0"></span>
                            <span class="nav-link-text ps-1">Upload de Arquivos</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="allergies-diseases">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-first-aid fs-0"></span>
                            <span class="nav-link-text ps-1">Alergias / Doenças / Antecedentes</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-historic">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-history fs-0"></span>
                            <span class="nav-link-text ps-1">Histórico</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="registration-data">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-address-card fs-0"></span>
                            <span class="nav-link-text ps-1">Dados Cadastrais</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-9">

            <!-- atendimento -->
            <div class="data-attendance block-item-class">

                <!-- diagnostics - start -->
                <div class="card mb-3 diagnostics-card">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Anamnese / Exame Físico</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('medical_care.list_iframe', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                        
                        @if($emergency_services->status == "a")
                            <div class="col-12 mt-2">
                                <button class="btn btn-primary diagnostics-button" type="button"  title="Anamnese / Exame Físico" iframe-form="{{ route('medical_care.form.iframe', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" iframe-create="{{ route('medical_care.form.iframe.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}">Inserir</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- dados vitais -->
            <div class="vital-data block-item-class">

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Dados Vitais</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">

                        <!-- button action -->
                        <div class="col-12 mb-2">
                            <div class="card border h-100 border-primary">
                                <div class="card-body">
                                    <div class="row flex-between-center">
                                        <div class="col-sm-auto mb-2 mb-sm-0">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">

                                                @if($emergency_services->status == "a")
                                                    <button class="btn btn-primary" type="button" title="Dados Vitais" iframe-form="{{ route('emergency_services_vital_data.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" iframe-create="{{ route('emergency_services_vital_data.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"><span class="fas fa-plus"></span></button>
                                                @endif

                                                <button class="btn btn-primary" type="button" title="Imprimir" data-redirect="{{ route('emergency_services_vital_data.export', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" target="_blanck"><span class="fas fa-print"></span></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div data-iframe="{{ route('emergency_services_vital_data', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                    </div>
                </div>

            </div>

            <!-- front desk -->
            <div class="data-front-desk block-item-class">
                @include('layouts/admin/fragments.screenings')
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

            <!-- main -->
            <div class="data-main block-item-class">

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Principal</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        
                        <ul class="nav nav-tabs" role="tablist">

                            @if($emergency_services->status == "a")
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="internment-tab" data-bs-toggle="tab" data-bs-target="#internment" type="button" role="tab" aria-controls="internment" aria-selected="true">Internação</button>
                                </li>
                            @endif

                            <li class="nav-item" role="presentation">
                                <button class="nav-link  @if($emergency_services->status != "a") active @endif" id="forward_patient-tab" data-bs-toggle="tab" data-bs-target="#forward_patient" type="button" role="tab" aria-controls="forward_patient" aria-selected="false">Encaminhar Paciente</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link  @if($emergency_services->status != "a") active @endif" id="forward_patient_internal-tab" data-bs-toggle="tab" data-bs-target="#forward_patient_internal" type="button" role="tab" aria-controls="forward_patient_internal" aria-selected="false">Encaminhamento Interno</button>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="prescription-tab" data-bs-toggle="tab" data-bs-target="#prescription-tab-tab" type="button" role="tab" aria-controls="prescription-tab-tab" aria-selected="false">Receituário</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="medical_opinion-tab-tab" data-bs-toggle="tab" data-bs-target="#medical_opinion-tab" type="button" role="tab" aria-controls="medical_opinion-tab" aria-selected="false">Parecer Médico</button>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- internar -->
                            @if($emergency_services->status == "a")
                            <div class="tab-pane fade show active" id="internment" role="tabpanel" aria-labelledby="internment-tab">

                                @if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->admit_patient)))
                                    <div class="form-check mt-3">
                                        <input class="form-check-input check-request-save hide" id="admit_patient" name="admit_patient" type="checkbox" onchange="" value="admit-patient-check-request" checked>
                                        <input class="form-check-input" id="admit_patient_view" name="admit_patient_view" type="checkbox" onchange="" value="admit-patient-check-request" checked disabled>
                                        <label class="form-check-label" for="admit_patient">Solicitar</label>
                                    </div>
                                @else
                                    <!-- internar -->
                                    <div class="form-check mt-3">
                                        <input class="form-check-input check-request-save" id="admit_patient" name="admit_patient" type="checkbox" onchange="validate_conducts_internment()" value="admit-patient-check-request">
                                        <label class="form-check-label" for="admit_patient">Solicitar</label>
                                    </div>
                                @endif

                                @if(!empty($admit_patient = $emergency_services_conducts->admit_patient_($emergency_services->IdEmergencyServices)))
                                    @if($admit_patient->status == "w")
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Paciente aguardando aprovação da solicitação de internação.</strong>
                                        </div>
                                    @elseif($admit_patient->status == "a")
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Paciente aguardando leito.</strong>
                                        </div>
                                    @elseif($admit_patient->status == "n")
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Internação não aprovada.</strong>
                                        </div>
                                    @elseif($admit_patient->status == "h")
                                        <div class="alert alert-success" role="alert">
                                            <strong>Paciente se encontra internado.</strong>
                                        </div>
                                    @endif
                                @endif

                                <div id="admit-patient-check-request" class="hide" url="{{ route('emergency_services_conducts.internment', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                            </div>
                            @endif

                            <!-- emcaminhar -->
                            <div class="tab-pane fade @if($emergency_services->status != "a") show active @endif" id="forward_patient" role="tabpanel" aria-labelledby="forward_patient-tab">
                                <div class="form-check mt-3 form-check form-check-inline">
                                    <input class="form-check-input check-request check-request-save" id="to_forward" name="to_forward" type="checkbox" value="to-forward-check-request"  @if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->to_forward))) checked @endif/>
                                    <label class="form-check-label" for="to_forward">Solicitar</label>
                                </div>

                                <div id="to-forward-check-request" class="hide">

                                    <div class="col-12 mb-2">
                                        <div class="card border h-100 border-primary">
                                            <div class="card-body">
                                                <div class="row flex-between-center">
                                                    <div class="col-sm-auto mb-2 mb-sm-0">
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                            @if($emergency_services->status == "a")
                                                                <button class="btn btn-primary diagnostics-button" type="button"  title="Encaminhar Paciente" iframe-form="{{ route('emergency_services_forward.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" iframe-create="{{ route('emergency_services_forward.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"><span class="fas fa-plus"></span></button>
                                                            @endif

                                                            <button class="btn btn-primary" type="button" title="Imprimir" data-redirect="{{ route('emergency_services_forward.export', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" target="_blanck"><span class="fas fa-print"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-iframe="{{ route('emergency_services_forward', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                                </div>
                            </div>

                            <!-- emcaminhar -->
                            <div class="tab-pane fade @if($emergency_services->status != "a") show active @endif" id="forward_patient_internal" role="tabpanel" aria-labelledby="forward_patient_internal-tab">

                                <div class="col-12 mb-2 mt-2">
                                    <div class="card border h-100 border-primary">
                                        <div class="card-body">
                                            <div class="row flex-between-center">
                                                <div class="col-sm-auto mb-2 mb-sm-0">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                    
                                                        @if($emergency_services->status == "a")
                                                            <button class="btn btn-primary diagnostics-button" type="button"  title="Encaminhamento Interno" iframe-form="{{ route('emergency_services_forward_internal.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" iframe-create="{{ route('emergency_services_forward_internal.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"><span class="fas fa-plus"></span></button>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-iframe="{{ route('emergency_services_forward_internal', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                            </div>
                            
                            <!-- receituário -->
                            <div class="tab-pane fade" id="prescription-tab-tab" role="tabpanel" aria-labelledby="prescription-tab-tab">
                                <div class="mt-3">
                                    
                                    <div class="form-check mt-3">
                                        <input class="form-check-input check-request check-request-save" id="prescription" name="prescription" type="checkbox" value="prescription-check-request" @if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->prescription))) checked @endif/>
                                        <label class="form-check-label" for="prescription">Solicitar</label>
                                    </div>

                                    <div id="prescription-check-request" class="hide">

                                        <!-- button action -->
                                        <div class="col-12 mb-2">
                                            <div class="card border h-100 border-primary">
                                                <div class="card-body">
                                                    <div class="row flex-between-center">
                                                        <div class="col-sm-auto mb-2 mb-sm-0">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                            
                                                                @if($emergency_services->status == "a")
                                                                    <button class="btn btn-primary diagnostics-button" type="button"  title="Receituário" iframe-form="{{ route('emergency_services_prescriptions.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" iframe-create="{{ route('emergency_services_prescriptions.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"><span class="fas fa-plus"></span></button>
                                                                @endif

                                                                <button class="btn btn-primary modal-print-option"  data-option='[{"option":"CONTROLADO", "value":"c"},{"option":"CONTÍNUO", "value":"t"},{"option":"NORMAL", "value":"n"}]' type="button" title="Receituário Médico" data-url="{{ route('emergency_services_prescriptions.export', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" target="_blanck"><span class="fas fa-print"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-iframe="{{ route('emergency_services_prescriptions', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="medical_opinion-tab" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row mt-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                        <!-- button action -->
                                        <div class="col-12 mb-2">
                                            <div class="card border h-100 border-primary">
                                                <div class="card-body">
                                                    <div class="row flex-between-center">
                                                        <div class="col-sm-auto mb-2 mb-sm-0">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">

                                                                @if($emergency_services->status == "a")
                                                                    <button class="btn btn-primary save_form" type="button"><span class="fas fa-save"></span></button>
                                                                @endif

                                                                <button class="btn btn-primary" type="button" title="Imprimir" data-redirect="{{ route('emergency_services_conducts.medication.option.export', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" target="_blanck"><span class="fas fa-print"></span></button>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="medical_opinion_fields" class="form-group">
                                            <label class="form-label" for="medical_opinion_label">Parecer Médico</label>
                                            <textarea class="form-control @error('medical_opinion') is-invalid @enderror" id="medical_opinion" name="medical_opinion" rows="8" @if($emergency_services->status != "a") disabled @endif>{{$emergency_services_conducts->medical_opinion ?? ""}}</textarea>
                                            <div class="valid-feedback">sucesso!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Enfermagem -->
            <div class="data-nursing block-item-class">

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Enfermagem</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if((app('request')->input('tab') == "nursing" AND app('request')->input('subtab') == "procedures"))) active @endif" id="procedure-nursing-tab" data-bs-toggle="tab" data-bs-target="#procedure-nursing" type="button" role="tab" aria-controls="procedure" aria-selected="true">Procedimento</button>
                            </li>

                            @if($emergency_services->status == "a")
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#note-nursing" type="button" role="tab" aria-controls="forward_patient" aria-selected="false">Observação</button>
                                </li>
                            @endif

                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if((app('request')->input('tab') == "nursing" AND app('request')->input('subtab') == "high-nursing") OR empty(app('request')->input('tab'))) active @endif" id="contact-tab" data-bs-toggle="tab" data-bs-target="#high-nursing" type="button" role="tab" aria-controls="prescription" aria-selected="false">Alta</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- procedimentos -->
                            <div class="tab-pane fade @if((app('request')->input('tab') == "nursing" AND app('request')->input('subtab') == "procedures"))) show active @endif" id="procedure-nursing" role="tabpanel" aria-labelledby="procedure-nursing-tab">
                                <!-- Solicitação de Procedimentos / Exames - start -->
                                <div data-iframe="{{ route('procedures_groups', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>

                                @if($emergency_services->status == "a")
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-primary procedures-button" type="button" title="Solicitação de Procedimentos / Exames" data-url="{{ route('emergency_services_procedures', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}">Inserir</button>
                                    </div>
                                @endif
                            </div>

                            <!-- observação -->
                            @if($emergency_services->status == "a")
                                <div class="tab-pane fade" id="note-nursing" role="tabpanel" aria-labelledby="note-nursing-tab">
                                
                                    @if((!empty($admit_patient)) AND ($admit_patient->status == "h"))
                                        <div class="alert alert-success mt-3" role="alert">
                                            <strong>Paciente se encontra Internado/Observação.</strong>
                                        </div>
                                    @else
                                    
                                        @if((!empty($emergency_services_conducts)) AND (!empty($emergency_services_conducts->observation)))

                                            <div class="alert alert-success mt-3" role="alert">
                                                <strong>Paciente se encontra em observação.</strong>
                                            </div>

                                            @if(!empty($emergency_services_conducts->note_observation))
                                                <hr class="mt-0">
                                                <strong>Observação:</strong><br>
                                                {{ $emergency_services_conducts->note_observation }}
                                            @endif

                                            <input type="hidden" name="type_observation" value="o"/>
                                            <input class="hide" name="note_observation" value="{{$emergency_services_conducts->note_observation}}"/>
                                            <input class="hide" name="observation" value="observation-check-request"/>

                                        @else
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" id="observation" name="observation" type="checkbox" onchange="validate_conducts_observation()" value="observation-check-request"/>
                                                <label class="form-check-label" for="observation">Solicitar</label>
                                            </div>

                                            <div id="observation-check-request" class="hide">
                                                <!-- observação -->

                                                <input type="hidden" name="type_observation" value="o"/>
                                                <div class="row mt-1">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2">
                                                        <div id="note_observation_fields" class="form-group">
                                                            <label class="form-label" for="note_observation_label">Observação</label>
                                                            <textarea class="form-control @error('note_observation') is-invalid @enderror" id="note_observation" name="note_observation" rows="3">{{ $emergency_services_observations->note_observation ?? "" }}</textarea>
                                                            <div class="valid-feedback">sucesso!</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            @endif

                            <!-- alta -->
                            <div class="tab-pane fade @if((app('request')->input('tab') == "nursing" AND app('request')->input('subtab') == "high-nursing") OR empty(app('request')->input('tab'))) show active @endif" id="high-nursing" role="tabpanel" aria-labelledby="high-nursing-tab">
                                <div class="form-check mt-3">
                                    <input class="form-check-input check-request" id="patient_discharge" name="patient_discharge" type="checkbox" onchange="validate_conducts_patient_discharge()" value="patient-discharge-check-request"  @if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->patient_discharge))) checked @endif @if($emergency_services->status != "a") disabled @endif/>
                                    <label class="form-check-label" for="patient_discharge">Registrar</label>
                                </div>

                                <div id="patient-discharge-check-request" class="hide">
                                
                                    <!-- type -->
                                    <div class="row mt-1">

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div id="type_patient_discharge_fields" class="form-group">
                                                <label for="type_patient_discharge" id="label_type_patient_discharge" class="label_type_patient_discharge">Tipo:</label>
                                                <select name="type_patient_discharge" class="form-control @error('type_patient_discharge') is-invalid @enderror" @if($emergency_services->status != "a") disabled @endif>
                                                    <option value="m" @if((old('type_patient_discharge') == "m") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->type_patient_discharge == "m")))selected @endif>Melhorado</option>
                                                    <option value="ap" @if((old('type_patient_discharge') == "ap") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->type_patient_discharge == "ap")))selected @endif>A pedido</option>
                                                    <option value="c" @if((old('type_patient_discharge') == "c") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->type_patient_discharge == "c")))selected @endif>Curado</option>
                                                    <option value="e" @if((old('type_patient_discharge') == "e") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->type_patient_discharge == "e")))selected @endif>Evasão</option>
                                                    <option value="i" @if((old('type_patient_discharge') == "i") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->type_patient_discharge == "i")))selected @endif>Inalterado</option>
                                                    <option value="o" @if((old('type_patient_discharge') == "o") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->type_patient_discharge == "o")))selected @endif>Obito</option>
                                                    <option value="p" @if((old('type_patient_discharge') == "p") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->type_patient_discharge == "p")))selected @endif>Piorado</option>
                                                    <option value="en" @if((old('type_patient_discharge') == "en") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->type_patient_discharge == "en")))selected @endif>Encaminhado para outro hospital</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                            <div id="date_patient_discharge_fields" class="form-group">
                                                <label for="date_patient_discharge" id="label_date_patient_discharge">Data:</label>
                                                <input class="form-control datetimepicker" id="date_patient_discharge" name="date_patient_discharge" type="text" value="@if(!empty($emergency_services_conducts) AND ($emergency_services_conducts->date_time_patient_discharge)){{ date('d-m-Y', strtotime($emergency_services_conducts->date_time_patient_discharge)) }} @else {{ date('d-m-Y') }} @endif" placeholder="d-m-y" locale="pt" data-options='{"disableMobile":true}' required @if($emergency_services->status != "a") disabled @endif/>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                            <div id="date_time_patient_discharge_fields" class="form-group">
                                                <label for="date_time_patient_discharge" id="label_date_time_patient_discharge">Hora:</label>
                                                <input class="form-control datetimepicker" id="date_time_patient_discharge" name="date_time_patient_discharge" type="text" value="@if(!empty($emergency_services_conducts) AND ($emergency_services_conducts->date_time_patient_discharge)){{ date('H:i', strtotime($emergency_services_conducts->date_time_patient_discharge)) }} @else {{ date('H:i') }} @endif" placeholder="H:i" locale="pt" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' required @if($emergency_services->status != "a") disabled @endif/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- motivo -->
                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div id="note_patient_discharge_fields" class="form-group">
                                                <label class="form-label" for="note_patient_discharge_label">Motivo</label>
                                                <textarea class="form-control @error('note_patient_discharge') is-invalid @enderror" id="note_patient_discharge" name="note_patient_discharge" rows="3" @if($emergency_services->status != "a") disabled @endif>{{$emergency_services_conducts->note_patient_discharge ?? "" }}</textarea>
                                                <div class="valid-feedback">sucesso!</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- prescrição -->
            <div class="data-prescription block-item-class">

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Prescrição</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item active" role="presentation">
                                <button class="nav-link" id="presentation-run-tab" data-bs-toggle="tab" data-bs-target="#presentation-run" type="button" role="tab" aria-controls="procedure" aria-selected="true">Prescrições</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="presentation-historic-run-tab" data-bs-toggle="tab" data-bs-target="#presentation-historic-run" type="button" role="tab" aria-controls="procedure" aria-selected="false">Historico Prescrições</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- prescrição medicação -->
                            <div class="tab-pane fade active show" id="presentation-run" role="tabpanel" aria-labelledby="presentation-run-tab-tab">
                                <div data-iframe="{{ route('medication_groups', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>

                                @if($emergency_services->status == "a")
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-primary procedures-button" type="button" title="Registrar Prescrição" data-url="{{ route('emergency_services_medications', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}">Inserir</button>
                                    </div>
                                @endif
                            </div>

                            <!-- prescrição medicação historico -->
                            <div class="tab-pane fade" id="presentation-historic-run" role="tabpanel" aria-labelledby="presentation-historic-run-tab">
                                <div data-iframe="{{ route('emergency_services_medications.history', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- data-check-in-prescription -->
            <div class="data-check-in-prescription block-item-class">

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Check-in Prescrição</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('emergency_services_medications.list.check', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                    </div>
                </div>
            </div>

            <!-- declarations_attestation-nursing -->
            <div class="declarations_attestation-nursing block-item-class">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Declarações / Atestado</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="declaration_presence-tab" data-bs-toggle="tab" data-bs-target="#declaration_presence" type="button" role="tab" aria-controls="declaration_presence" aria-selected="true">Declaração de Comparecimento / Acompanhamento</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="medical_certificate-tab" data-bs-toggle="tab" data-bs-target="#medical_certificate-tab-tab" type="button" role="tab" aria-controls="medical_certificate-tab-tab" aria-selected="false">Atestado Médico</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!--- Declaração -->
                            <div class="tab-pane fade show active" id="declaration_presence" role="tabpanel" aria-labelledby="declaration_presence-tab">
                                <div class="form-check mt-3">
                                    <input class="form-check-input check-request" id="declaration_presence_check" onchange="comparison_statement_validade()" name="declaration_presence" type="checkbox" value="declaration_presence-check-request" @if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->declaration_presence))) checked @endif @if($emergency_services->status != "a") disabled @endif/>
                                    <label class="form-check-label" for="declaration_presence">Solicitar</label>
                                </div>

                                <div id="declaration_presence-check-request" class="hide">
                                    
                                    <!-- button action -->
                                    <div class="col-12 mb-2">
                                        <div class="card border h-100 border-primary">
                                            <div class="card-body">
                                                <div class="row flex-between-center">
                                                    <div class="col-sm-auto mb-2 mb-sm-0">
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="...">

                                                            @if($emergency_services->status == "a")
                                                                <button class="btn btn-primary save_form" type="button"><span class="fas fa-save"></span></button>
                                                            @endif

                                                            <button class="btn btn-primary" type="button" title="Imprimir" data-redirect="{{ route('emergency_services_conducts.medication.declaration.certificate.export', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" target="_blanck"><span class="fas fa-print"></span></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div id="date_comparison_statement_fields" class="form-group">
                                                <label for="date_comparison_statement" id="label_date_comparison_statement">Data:</label>
                                                <input type="text" id="date_comparison_statement" name="date_comparison_statement" class="form-control datetimepicker" value="@if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->date_time_comparison_statement))){{ date('d-m-Y', strtotime($emergency_services_conducts->date_time_comparison_statement)) }} @else {{ date('d-m-Y') }}@endif" maxlength="19" data-options='{"disableMobile":true}' @if($emergency_services->status != "a") disabled @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div id="date_time_comparison_statement_fields" class="form-group">
                                                <label for="date_time_comparison_statement" id="label_date_time_comparison_statement">Hora:</label>
                                                <input type="text" id="date_time_comparison_statement" name="date_time_comparison_statement" class="form-control datetimepicker" value="@if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->date_time_comparison_statement))){{ date('H:i', strtotime($emergency_services_conducts->date_time_comparison_statement)) }}@else {{ date('H:i') }}@endif" maxlength="19" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' @if($emergency_services->status != "a") disabled @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div id="up_until_comparison_statement_fields" class="form-group">
                                                <label for="up_until_comparison_statement" id="label_up_until_comparison_statement">Até:</label>
                                                <input type="text" id="up_until_comparison_statement" name="up_until_comparison_statement" class="form-control datetimepicker" value="@if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->up_until_comparison_statement))){{ date('H:i', strtotime($emergency_services_conducts->up_until_comparison_statement)) }}@else {{ date('H:i') }}@endif" maxlength="19" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' @if($emergency_services->status != "a") disabled @endif>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                                            <div id="note_comparison_statement_fields" class="form-group">
                                                <label for="note_comparison_statement" id="label_note_comparison_statement">Motivo:</label>
                                                <textarea class="form-control @error('note_comparison_statement') is-invalid @enderror" id="note_comparison_statement" name="note_comparison_statement" rows="3" placeholder="Motivo" @if($emergency_services->status != "a") disabled @endif>{{old('note_comparison_statement') ?? $emergency_services_conducts->note_comparison_statement ?? ""}}</textarea>
                                                <div class="valid-feedback">sucesso!</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--- Atestado -->
                            <div class="tab-pane fade" id="medical_certificate-tab-tab" role="tabpanel" aria-labelledby="medical_certificate-tab">
                                <div class="form-check mt-3">
                                    <input class="form-check-input check-request" id="medical_certificate" name="medical_certificate" type="checkbox" onchange="medical_certificate_validade()" value="medical_certificate-check-request" @if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->medical_certificate))) checked @endif @if($emergency_services->status != "a") disabled @endif/>
                                    <label class="form-check-label" for="admit_patient">Solicitar</label>
                                </div>

                                <div id="medical_certificate-check-request" class="hide">
                                    
                                    <!-- button action -->
                                    <div class="col-12 mb-2">
                                        <div class="card border h-100 border-primary">
                                            <div class="card-body">
                                                <div class="row flex-between-center">
                                                    <div class="col-sm-auto mb-2 mb-sm-0">
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="...">

                                                            @if($emergency_services->status == "a")
                                                                <button class="btn btn-primary save_form" type="button"><span class="fas fa-save"></span></button>
                                                            @endif

                                                            <button class="btn btn-primary" type="button" title="Imprimir" data-redirect="{{ route('emergency_services_conducts.medication.certificate.export', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" target="_blanck"><span class="fas fa-print"></span></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md col-lg col-xl">
                                            <div id="date_medical_certificate_fields" class="form-group">
                                                <label for="date_medical_certificate" id="label_date_medical_certificate">Data:</label>
                                                <input type="text" id="date_medical_certificate" name="date_medical_certificate" class="form-control datetimepicker" value="@if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->date_medical_certificate))){{ date('d-m-Y', strtotime($emergency_services_conducts->date_medical_certificate)) }} @else {{ date('d-m-Y') }}@endif" maxlength="19" data-options='{"disableMobile":true}' @if($emergency_services->status != "a") disabled @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md col-lg col-xl">
                                            <div id="number_days_medical_certificate_fields" class="form-group">
                                                <label for="number_days_medical_certificate" id="label_number_days_medical_certificate">Número de Dias:</label>
                                                <input type="number" id="number_days_medical_certificate" name="number_days_medical_certificate" class="form-control" value="@if(!empty($emergency_services_conducts)){{ $emergency_services_conducts->number_days_medical_certificate }}@endif" @if($emergency_services->status != "a") disabled @endif>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-md col-lg col-xl">
                                            <div id="period_medical_certificate_fields" class="form-group">
                                                <label for="period_medical_certificate" id="label_period_medical_certificate" class="label_period_medical_certificate">Períodos:</label>
                                                <select name="period_medical_certificate" class="form-control @error('period_medical_certificate') is-invalid @enderror" @if($emergency_services->status != "a") disabled @endif>
                                                    <option value="">...</option>
                                                    <option value="m" @if((old('period_medical_certificate') == "m") OR (!empty($emergency_services_conducts) AND($emergency_services_conducts->period_medical_certificate == "m")))selected @endif>Manhã</option>
                                                    <option value="t" @if((old('period_medical_certificate') == "t") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->period_medical_certificate == "t")))selected @endif>Tarde</option>
                                                    <option value="n" @if((old('period_medical_certificate') == "n") OR (!empty($emergency_services_conducts) AND ($emergency_services_conducts->period_medical_certificate == "n")))selected @endif>Noite</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                            <div id="code_filter_fields" class="form-group">
                                                <label for="code_filter" id="label_code_filter">Código FILTRO:</label>
                                                <input type="text" id="code_filter" code_filter="code_filter" class="form-control" oninput="this.value = this.value.toUpperCase()" @if($emergency_services->status != "a") disabled @endif>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                            <div id="title_filter_fields" class="form-group">
                                                <label for="title_filter" id="label_title_filter">CID10 FILTRO:</label>
                                                <input type="text" id="title_filter" name="title_filter" class="form-control" oninput="this.value = this.value.toUpperCase()" @if($emergency_services->status != "a") disabled @endif>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-12 col-md col-lg col-xl">
                                            <div id="IdCid10MedicalCertificate_fields" class="form-group">
                                                <label for="IdCid10MedicalCertificate" id="label_IdCid10MedicalCertificate">CID10</label>
                                                <select id="IdCid10MedicalCertificate" name="IdCid10MedicalCertificate" class="form-control" url-query="{{ route('cid10.form.json') }}" @if($emergency_services->status != "a") disabled @endif>
                                                    <option value="{{ $emergency_services_conducts->IdCid10MedicalCertificate ?? "" }}">...</option>
                                                </select>
                                            </div>              
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- medical-report-nursing -->
            <div class="medical-report-nursing block-item-class">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Laudo Médico</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">

                        <!-- button action -->
                        <div class="col-12 mb-2 mt-1">
                            <div class="card border h-100 border-primary">
                                <div class="card-body">
                                    <div class="row flex-between-center">
                                        <div class="col-sm-auto mb-2 mb-sm-0">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">

                                                @if($emergency_services->status == "a")
                                                    <button class="btn btn-primary save_form" type="button"><span class="fas fa-save"></span></button>
                                                @endif

                                                <button class="btn btn-primary" type="button" title="Imprimir" data-redirect="{{ route('emergency_services_conducts.medication.medical.report.export', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" target="_blanck"><span class="fas fa-print"></span></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div id="medical-report_fields" class="form-group">
                                    <label class="form-label" for="medical-report_label">Laudo Médico</label>
                                    <textarea class="form-control @error('medical-report') is-invalid @enderror" id="medical_report" name="medical_report" rows="8" @if($emergency_services->status != "a") disabled @endif>{{ $emergency_services_conducts->medical_report ?? ""}}</textarea>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- unit-transfer -->
            @if($service_units->count() > 0 AND ($emergency_services->status == "a"))
            <div class="unit-transfer block-item-class">
            
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Tranferência de Unidade</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div class="form-check">
                            <input class="form-check-input check-request-save-transfer" id="unit_transfer" name="unit_transfer" type="checkbox" value="unit-transfer" onchange="check_request_save_transfer()" @if(!empty($emergency_services_conducts) AND (!empty($emergency_services_conducts->unit_transfer))) checked @endif/>
                            <label class="form-check-label" for="unit_transfer">Solicitar</label>
                        </div>

                        <div class="hide" id="unit-transfer">
                            <div class="alert alert-danger" role="alert">
                                Ao tranferir de unidade o paciente o atendimento será finalizado.
                            </div> 

                            <div class="row mt-1">

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div id="IdServiceUnitsUnitTransfer_fields" class="form-group">
                                        <label for="IdServiceUnitsUnitTransfer" id="label_IdServiceUnitsUnitTransfer" class="label_IdServiceUnitsUnitTransfer">Unidades:</label>
                                        <select name="IdServiceUnitsUnitTransfer" class="form-control @error('IdServiceUnitsUnitTransfer') is-invalid @enderror" required>
                                            @foreach($service_units as $index => $val)
                                                <option value="{{ $val->IdServiceUnits }}" @if(old('IdServiceUnitsUnitTransfer') == $val->IdServiceUnits OR (!empty($emergency_services_conducts) AND ($val->IdServiceUnits == $emergency_services_conducts->IdServiceUnitsUnitTransfer)))selected @endif>{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                                    <div id="unit_transfer_reason_reason_fields" class="form-group">
                                        <label for="unit_transfer_reason_reason" id="label_unit_transfer_reason_reason">Motivo:</label>
                                        <textarea class="form-control @error('unit_transfer_reason_reason') is-invalid @enderror" id="unit_transfer_reason_reason" name="unit_transfer_reason_reason" rows="3" placeholder="Motivo">{{old('unit_transfer_reason_reason') ?? $emergency_services_conducts->unit_transfer_reason ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- upload file -->
            <div class="data-upload block-item-class">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Arquivos</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('emergency_services_files', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary" type="button" iframe-title="Novo Arquivo" url="{{ route('emergency_services_files.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" title="Arquivos" data-iframe>Inserir</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- registration data -->
            <div class="registration-data block-item-class">
                @include('layouts/admin/fragments.users')
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
        </div>

    </div>

</form>

@endsection

<!-- scripts - start -->
@section('scripts')

<script>
    @if(empty($medical_care))
        localStorage.setItem('block-item-select', '')
    @endif
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>
<script src="{{ asset('admin/js/inputmask.js') }}"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/iframe.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/block-item.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/procedures_groups.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/emergency_services_conducts.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/materials.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/validate_medications.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/emergency_services_medications_edite.js') }}" type="text/javascript"></script>

<script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/pt.js"></script>
<script src="{{ asset('admin/js/flatpickr.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/medical_certificate.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {

    //region - validação
    $("#form").validate({
        rules: {
            
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