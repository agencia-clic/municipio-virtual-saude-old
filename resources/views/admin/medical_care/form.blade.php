@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h5 text-800">Atendimento Medíco</span>
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
                                    <li class="breadcrumb-item"><a href="{{route('medical_care')}}">Atendimentos Medícos</a></li>
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
            <div class="kanban-items-container border bg-white rounded-2 py-3 mb-3" style="max-height: none;">

                <div class="card mb-3 kanban-item shadow-sm active" data-class="data-front-desk">
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
                            <span class="fas fa-user-md fs-0"></span>
                            <span class="nav-link-text ps-1">Atendimento</span>
                        </p>
                    </div>
                </div>
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

                <!-- anamnesis - start -->
                <div class="card mb-3 anamnesis-card">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Anamnese / Exame Físico</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                        <textarea class="form-control form-control-sm @error('anamnesis') is-invalid @enderror" id="anamnesis" name="anamnesis" rows="3" placeholder="Anamnese / Exame Físico" required>{{old('anamnesis') ?? $medical_care->anamnesis ?? ""}}</textarea>
                        <div class="valid-feedback">sucesso!</div>
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

                <!-- guidelines - start -->
                <div class="card mb-3 ">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Orientações</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                        <textarea class="form-control form-control-sm @error('guidelines') is-invalid @enderror" id="guidelines" name="guidelines" rows="3" placeholder="Observação">{{old('guidelines') ?? $medical_care->guidelines ?? ""}}</textarea>
                        <div class="valid-feedback">sucesso!</div>
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
                                    <label for="aggression" id="label_aggression"><strong>Agressões:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="aggression-y" name="aggression" @if(old('aggression') or (($medical_care) AND $medical_care->aggression == "y")) checked @endif value="y"/>
                                        <label class="form-check-label" for="aggression-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="aggression-n" name="aggression" @if((empty(old('aggression')) or empty(($medical_care))) OR old('aggression') or (($medical_care) AND $medical_care->aggression == "n")) checked @endif value="n"/>
                                        <label class="form-check-label" for="aggression-n">Não</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="firearm_aggression" id="label_firearm_aggression"><strong>Agressão com arma de fogo:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="firearm_aggression-y" @if(old('firearm_aggression') or (($medical_care) AND $medical_care->firearm_aggression == "y")) checked @endif name="firearm_aggression" value="y"/>
                                        <label class="form-check-label" for="firearm_aggression-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="firearm_aggression-n" @if((empty(old('firearm_aggression')) or empty(($medical_care))) OR old('firearm_aggression') or (($medical_care) AND $medical_care->firearm_aggression == "n")) checked @endif name="firearm_aggression" value="n"/>
                                        <label class="form-check-label" for="firearm_aggression-n">Não</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="weapon_flaps" id="label_weapon_flaps"><strong>Agressão com arma branca:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="weapon_flaps-y" @if(old('weapon_flaps') or (($medical_care) AND $medical_care->weapon_flaps == "y")) checked @endif name="weapon_flaps" value="y"/>
                                        <label class="form-check-label" for="weapon_flaps-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="weapon_flaps-n" @if((empty(old('weapon_flaps')) or empty(($medical_care))) OR old('weapon_flaps') or (($medical_care) AND $medical_care->weapon_flaps == "n")) checked @endif name="weapon_flaps" value="n"/>
                                        <label class="form-check-label" for="weapon_flaps-n">Não</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="self_extermination" id="label_self_extermination"><strong>Tentativa de auto extermínio:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="self_extermination-y" @if(old('self_extermination') or (($medical_care) AND $medical_care->self_extermination == "y")) checked @endif name="self_extermination" value="y"/>
                                        <label class="form-check-label" for="self_extermination-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="self_extermination-n" @if((empty(old('self_extermination')) or empty(($medical_care))) OR old('self_extermination') or (($medical_care) AND $medical_care->self_extermination == "n")) checked @endif name="self_extermination" value="n"/>
                                        <label class="form-check-label" for="self_extermination-n">Não</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="sexual_violence" id="label_sexual_violence"><strong>Violência sexual:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="sexual_violence-y" @if(old('sexual_violence') or (($medical_care) AND $medical_care->sexual_violence == "y")) checked @endif name="sexual_violence" value="y"/>
                                        <label class="form-check-label" for="sexual_violence-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="sexual_violence-n" @if((empty(old('sexual_violence')) or empty(($medical_care))) OR old('sexual_violence') or (($medical_care) AND $medical_care->sexual_violence == "n")) checked @endif name="sexual_violence" value="n"/>
                                        <label class="form-check-label" for="sexual_violence-n">Não</label>
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
                                        <input class="form-check-input" type="radio" id="forensic_examination-n" @if((empty(old('forensic_examination')) or empty(($medical_care))) OR old('forensic_examination') or (($medical_care) AND $medical_care->forensic_examination == "n")) checked @endif name="forensic_examination" value="n"/>
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