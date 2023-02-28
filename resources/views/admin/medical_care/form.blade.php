@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h5 text-800">Atendimento Médico</span>
</div>

<!-- form -- start -->
<form class="mt-3 needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($medical_care->IdMedicalCare) ? route('medical_care.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) : route('medical_care.form.update', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices), 'IdMedicalCare' => base64_encode($medical_care->IdMedicalCare)])}}" novalidate="">

    @csrf <!--token--> 

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary btn-sm" type="button" data-redirect="{{ route('medical_care') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary btn-sm" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('medical_care')}}">Atendimentos Médicos</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(empty($medical_care))Inserir @else Editar @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                    @if(strlen($emergency_services->users_cpf_cnpj) == 11)
                                        •  {{ Mask::default($emergency_services->users_cpf_cnpj, '###.###.###-##') }}
                                    @elseif(strlen($emergency_services->users_cpf_cnpj) == 14)
                                        •  {{ Mask::default($emergency_services->users_cpf_cnpj, '##.###.###/####-##') }}
                                    @endif
                        
                                    @if($emergency_services->users_date_birth)
                                        • {{ Mask::birth($emergency_services->users_date_birth) }} ANOS
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
            <div class="kanban-items-container border rounded-2 py-3 mb-3">

                <div class="card mb-3 kanban-item shadow-sm active" data-class="data-front-desk">
                    <div class="card-body shadow-button">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-file-alt fs-0"></span>
                            <span class="nav-link-text ps-1">Informações</span>
                        </p>
                    </div>
                </div>

                <div class="card mb-3 kanban-item shadow-sm" data-class="data-attendance">
                    <div class="card-body shadow-button">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-user-md fs-0"></span>
                            <span class="nav-link-text ps-1">Atendimento</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-upload">
                    <div class="card-body shadow-button">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-upload fs-0"></span>
                            <span class="nav-link-text ps-1">Upload de Arquivos</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="allergies-diseases">
                    <div class="card-body shadow-button">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-first-aid fs-0"></span>
                            <span class="nav-link-text ps-1">Alergias / Doenças / Antecedentes</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-historic">
                    <div class="card-body shadow-button">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-history fs-0"></span>
                            <span class="nav-link-text ps-1">Histórico</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="registration-data">
                    <div class="card-body shadow-button">
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

                <!-- anamnesis - start -->
                <div class="col-lg-12 col-xl-12 col-xxl-12 h-100">
                    
					<div class="card theme-wizard h-100 mb-5">
                        <div class="card-header">
                            <div class="row flex-between-end">
                                <div class="col-auto align-self-center">
                                    <h5 class="mb-0">Atendimento</h5>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card-header bg-light pt-3 pb-2">
                            <ul class="nav justify-content-between nav-wizard">
                                <li class="nav-item">
                                    <a class="nav-link active fw-semi-bold" href="#bootstrap-wizard-validation-tab1" tab-position="1" data-bs-toggle="tab" data-wizard-step="data-wizard-step" disabled>
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle"><span class="fas fa-stethoscope"></span></span>
                                        </span>
                                        <span class="d-none text-service-form d-md-block mt-1 fs--1">Anamnese / Exame Físico</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab2" tab-position="2" data-bs-toggle="tab" data-wizard-step="data-wizard-step" disabled>
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle"><span class="fas fa-notes-medical"></span></span>
                                        </span>
                                        <span class="d-none text-service-form d-md-block mt-1 fs--1">Queixa Principal</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab3" tab-position="3" data-bs-toggle="tab" data-wizard-step="data-wizard-step" disabled>
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle"><span class="fas fa-procedures"></span></span>
                                        </span>
                                        <span class="d-none text-service-form d-md-block mt-1 fs--1">Comorbidades</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab4" tab-position="4" data-bs-toggle="tab" data-wizard-step="data-wizard-step" disabled>
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle"><span class="fas fa-prescription-bottle-alt"></span></span>
                                        </span>
                                        <span class="d-none text-service-form d-md-block mt-1 fs--1">Medicações de Uso Contínuo</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab5" tab-position="5" data-bs-toggle="tab" data-wizard-step="data-wizard-step" disabled>
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle"><span class="fas fa-first-aid"></span></span>
                                        </span>
                                        <span class="d-none text-service-form d-md-block mt-1 fs--1">Alergias</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab6" tab-position="6" data-bs-toggle="tab" data-wizard-step="data-wizard-step" disabled>
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle"><span class="fas fa-hospital-user"></span></span>
                                        </span>
                                        <span class="d-none text-service-form d-md-block mt-1 fs--1">Exame Clínico</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab7" tab-position="7" data-bs-toggle="tab" data-wizard-step="data-wizard-step" disabled>
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle"><span class="fas fa-user-md"></span></span>
                                        </span>
                                        <span class="d-none text-service-form d-md-block mt-1 fs--1">Hipótese Diagnóstica</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab8" tab-position="8" data-bs-toggle="tab" data-wizard-step="data-wizard-step" disabled>
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle"><span class="fas fa-laptop-medical"></span></span>
                                        </span>
                                        <span class="d-none text-service-form d-md-block mt-1 fs--1">Conduta</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body py-4" id="wizard-controller">
                            <div class="tab-content">
                                
                                <!-- History / Physical Examination -->
                                <div class="tab-pane wizard active px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab1" id="bootstrap-wizard-validation-tab1">
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-sm @error('anamnesis') is-invalid @enderror" id="anamnesis" name="anamnesis" rows="8" placeholder="ANAMNESE / EXAME FÍSICO" data-wizard-validate-email="true" required>{{old('anamnesis') ?? $medical_care->anamnesis ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                    
                                <div class="tab-pane wizard px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab2" id="bootstrap-wizard-validation-tab2">
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-sm @error('chief_complaint') is-invalid @enderror" id="chief_complaint" name="chief_complaint" rows="8" placeholder="QUEIXA PRINCIPAL" data-wizard-validate-email="true" required>{{old('chief_complaint') ?? $medical_care->chief_complaint ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                                <div class="tab-pane wizard px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab3" id="bootstrap-wizard-validation-tab3">
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-sm @error('comorbidities') is-invalid @enderror" id="comorbidities" name="comorbidities" rows="8" placeholder="COMORBIDADES" data-wizard-validate-email="true" required>{{old('comorbidities') ?? $medical_care->comorbidities ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane wizard px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab4" id="bootstrap-wizard-validation-tab4">
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-sm @error('medication_continues') is-invalid @enderror" id="medication_continues" name="medication_continues" rows="8" placeholder="MEDICAÇÕES DE USO CONTÍNUO" data-wizard-validate-email="true" required>{{old('medication_continues') ?? $medical_care->medication_continues ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                    
                                <div class="tab-pane wizard px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab5" id="bootstrap-wizard-validation-tab5">
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-sm @error('allergies') is-invalid @enderror" id="allergies" name="allergies" rows="8" placeholder="ALERGIAS" data-wizard-validate-email="true" required>{{old('allergies') ?? $medical_care->allergies ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                    
                                <div class="tab-pane wizard px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab6" id="bootstrap-wizard-validation-tab6">
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-sm @error('clinical_exam') is-invalid @enderror" id="clinical_exam" name="clinical_exam" rows="8" placeholder="EXAME CLÍNICO" data-wizard-validate-email="true" required>{{old('clinical_exam') ?? $medical_care->clinical_exam ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                    
                                <div class="tab-pane wizard px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab7" id="bootstrap-wizard-validation-tab7">
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-sm @error('hypothesis_diagnostics') is-invalid @enderror" id="hypothesis_diagnostics" name="hypothesis_diagnostics" rows="8" placeholder="HIPÓTESE DIAGNÓSTICA" data-wizard-validate-email="true" required>{{old('hypothesis_diagnostics') ?? $medical_care->hypothesis_diagnostics ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                    
                                <div class="tab-pane wizard px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab8" id="bootstrap-wizard-validation-tab8">
                                    <div class="mb-3">
                                        <textarea class="form-control form-control-sm @error('conduct') is-invalid @enderror" id="conduct" name="conduct" rows="8" placeholder="CONDUTA" data-wizard-validate-email="true" required>{{old('conduct') ?? $medical_care->conduct ?? ""}}</textarea>
                                        <div class="valid-feedback">sucesso!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="px-sm-3 px-md-5">
                                <ul class="pager wizard list-inline mb-0">
                                    <li class="previous">
                                        <button class="btn btn-link ps-0 btn-sm hide" id="prev-wizard" onclick="tap_position('-')" type="button">
                                            <span class="fas fa-chevron-left me-2" data-fa-transform="shrink-3"></span>
                                            Voltar
                                        </button>
                                    </li>
                                    <li class="next">
                                        <button class="btn btn-primary px-5 px-sm-3 btn-sm " id="next-wizard" onclick="tap_position('+')" type="button">Próximo
                                            <span class="fas fa-chevron-right ms-2" data-fa-transform="shrink-3"> </span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- diagnostics - start -->
                <div class="card mb-3 diagnostics-card">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Diagnósticos</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('emergency_services_diagnostics', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary btn-sm diagnostics-button" type="button"  title="Diagnósticos" iframe-form="{{ route('emergency_services_diagnostics.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" iframe-create="{{ route('emergency_services_diagnostics.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}">Inserir</button>
                        </div>
                    </div>
                </div>

                <!-- Lesão Corporal - start -->
                <div class="card mb-3 ">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Lesão Corporal</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="form-check-label" for="aggression" id="label_aggression">Agressões:</label>
                                    <div class="form-check form-switch">                                       
                                        <input class="form-check-input" id="aggression" type="checkbox" @if(old('aggression') or (($medical_care) AND $medical_care->aggression == "y")) checked @endif value="y"/>
                                        <td>Sim</td>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="form-check-label" for="firearm_aggression" id="label_firearm_aggression">Agressão com arma de fogo:</label>
                                    <div class="form-check form-switch">                                       
                                        <input class="form-check-input" id="firearm_aggression" type="checkbox" @if(old('firearm_aggression') or (($medical_care) AND $medical_care->firearm_aggression == "y")) checked @endif name="firearm_aggression" value="y"/>
                                        <td>Sim</td>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="form-check-label" for="weapon_flaps" id="label_weapon_flaps">Agressão com arma branca:</label>
                                    <div class="form-check form-switch">                                       
                                        <input class="form-check-input" id="weapon_flaps" type="checkbox" @if(old('weapon_flaps') or (($medical_care) AND $medical_care->weapon_flaps == "y")) checked @endif name="weapon_flaps" value="y"/>
                                        <td>Sim</td>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="form-check-label" for="self_extermination" id="label_self_extermination">Tentativa de auto extermínio:</label>
                                    <div class="form-check form-switch">                                       
                                        <input class="form-check-input" id="self_extermination" type="checkbox" @if(old('self_extermination') or (($medical_care) AND $medical_care->self_extermination == "y")) checked @endif name="self_extermination" value="y"/>
                                        <td>Sim</td>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="form-check-label" for="sexual_violence" id="label_sexual_violence">Violência sexual:</label>
                                    <div class="form-check form-switch">                                       
                                        <input class="form-check-input" id="sexual_violence" type="checkbox" @if(old('sexual_violence') or (($medical_care) AND $medical_care->sexual_violence == "y")) checked @endif name="sexual_violence" value="y"/>
                                        <td>Sim</td>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="forensic_examination" id="label_forensic_examination"><strong>Realizado exame de corpo de delito:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="forensic_examination-y" @if(old('forensic_examination') or (($medical_care) AND $medical_care->forensic_examination == "y")) checked @endif name="forensic_examination" value="y"/>
                                        <label class="form-check-label" for="forensic_examination-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="forensic_examination-n" @if((empty(old('forensic_examination')) or empty(($medical_care))) OR old('forensic_examination') or (($medical_care) AND $medical_care->forensic_examination == "n")) checked @endif name="forensic_examination" value="n" required/>
                                        <label class="form-check-label" for="forensic_examination-n">Não</label>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <button class="btn btn-primary btn-sm" type="button"  title="Alergias Doenças" iframe-form="{{ route('users_diseases.form', ['type' => "a", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}" iframe-create="{{ route('users_diseases.form.create', ['type' => "a", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}">Inserir</button>
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
                            <button class="btn btn-primary btn-sm" type="button"  title="Antecedentes" iframe-form="{{ route('users_diseases.form', ['type' => "b", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}" iframe-create="{{ route('users_diseases.form.create', ['type' => "b", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}">Inserir</button>
                        </div>
                    </div>
                </div>

            </div>

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
                            <button class="btn btn-primary btn-sm" type="button" iframe-title="Novo Arquivo" url="{{ route('emergency_services_files.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" title="Arquivos" data-iframe>Inserir</button>
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
<script src="{{ asset('admin/js/modules/medical_care.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/iframe.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/block-item.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/wizard.js') }}" type="text/javascript"></script>

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
            validation_wizard()
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