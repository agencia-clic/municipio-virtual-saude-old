@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Recepção</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($emergency_services->IdEmergencyServices) ? route('emergency_services.form.create') : route('emergency_services.form.update',['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)])}}" novalidate="">

    @csrf <!--token--> 
    
    <div class="row mt-3">

        <!-- actions - start -->
        <div class="col-12 mb-2">
            <div class="card border h-100 border-primary">
                <div class="card-body">
                    <div class="row flex-between-center">
                        <div class="col-sm-auto mb-2 mb-sm-0">
                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                <button class="btn btn-primary" type="button" data-redirect="{{ route('emergency_services.form') }}"><span class="fas fa-plus"></span></button>
                                <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="row gx-2 align-items-center">
                                <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('emergency_services')}}">Recepção</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">@if(empty($emergency_services))Inserir @else Editar @endif</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- actions - end -->

        <div class="col-sm-12 col-md-3">
            <div class="kanban-items-container border bg-white rounded-2 py-3 mb-3" style="max-height: none;">
                <div class="card mb-3 kanban-item shadow-sm active" data-class="data-atendimento">
                    <div class="card-body">
                    <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                        <span class="far fa-address-card fs-1"></span>
                        <span class="nav-link-text ps-1">Dados do Paciente</span>
                    </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-acompanhante">
                    <div class="card-body">
                    <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                        <span class="fas fa-user-friends fs-1"></span>
                        <span class="nav-link-text ps-1">Dados do Acompanhante</span>
                    </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-9">

            <!-- atendimento -->
            <div class="data-atendimento block-item-class">
                <!-- basic - start -->
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Básico</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                        
                        <div class="row">
                            <div class="col-sm-6 col-md col-lg col-xl">
                                <div id="status_fields" class="form-group">
                                    <label for="status" id="label_status" class="label_status">Status:</label>
                                    <select name="status" class="form-control form-control-sm @error('status') is-invalid @enderror">
                                        <option value="a" @if((old('status') == "a") OR (!empty($emergency_services) AND ($emergency_services->status == "a")))selected @endif>Ativo</option>
                                        <option value="c" @if((old('status') == "c") OR (!empty($emergency_services) AND ($emergency_services->status == "c")))selected @endif>Cancelar</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md col-lg col-xl">
                                <div id="identified_patient_fields" class="form-group">
                                    <label for="identified_patient" id="label_identified_patient" class="label_identified_patient">Paciente Identificado:</label>
                                    <select name="identified_patient" id="identified_patient" class="form-control form-control-sm @error('identified_patient') is-invalid @enderror" @if(!empty($emergency_services)) disabled @endif>
                                        <option value="y" @if((old('identified_patient') == "y") OR (!empty($emergency_services) AND ($emergency_services->identified_patient == "y")))selected @endif>Sim</option>
                                        <option value="n" @if((old('identified_patient') == "n") OR (!empty($emergency_services) AND ($emergency_services->identified_patient == "n")))selected @endif>Não</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- basic - end -->

                <!-- patient - start -->
                <div class="card mb-3 @if((empty($emergency_services)) OR (!empty($emergency_services) AND ($emergency_services->identified_patient == "y"))) users-no-indentificate hide @endif">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Paciente</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div id="users_description_fields" class="form-group">
                                    <label class="form-label" for="text_label">Descrição do Passiente:</label>
                                    <textarea class="form-control form-control-sm @error('users_description') is-invalid @enderror" id="users_description" name="users_description" rows="3">{{old('text') ?? $emergency_services->users_description ?? ""}}</textarea>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="row mt-1">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div id="users_date_birth_identified_fields" class="form-group">
                                    <label for="users_date_birth_identified" id="label_users_date_birth_identified">Idade Aparente:</label>
                                    <input type="number" id="users_date_birth_identified" name="users_date_birth_identified" class="form-control form-control-sm" value="@if(!empty($emergency_services)){{ $emergency_services->users_date_birth_identified }}@endif">
                                </div>
                            </div>
                        
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div id="users_sex_fields" class="form-group">
                                    <label for="users_sex" id="label_users_sex">Sexo:</label>
                                    <select id="users_sex" name="users_sex" class="form-control form-control-sm @error('users_sex') is-invalid @enderror">
                                        <option value="" selected="selected">...</option>
                                        <option value="m" @if((old('users_sex') == "m") OR (!empty($emergency_services) AND ($emergency_services->users_sex == "m")))selected @endif>MASCULINO</option>
                                        <option value="f" @if((old('users_sex') == "f") OR (!empty($emergency_services) AND ($emergency_services->users_sex == "f")))selected @endif>FEMININO</option>
                                    </select>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- patient - end -->

                <!-- patient - start -->
                <div class="card mb-3 @if((empty($emergency_services)) OR (!empty($emergency_services) AND ($emergency_services->identified_patient == "y"))) card-users-patient-register hide @endif">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Paciente</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">

                        <div class="row">
                            @if(empty($emergency_services))
                            
                                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <div id="user_name_fields" class="form-group">
                                        <label for="user_name" id="label_user_name">FILTRO: Nome:</label>
                                        <input type="text" id="user_name" name="user_name" class="form-control form-control-sm" maxlength="50" autocomplete="off">    
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <div id="user_cpf_cnpj_fields" class="form-group">
                                        <label for="user_cpf_cnpj" id="label_user_cpf_cnpj">FILTRO: CPF:</label>
                                        <input type="text" id="user_cpf_cnpj" name="user_cpf_cnpj" class="form-control form-control-sm" maxlength="14" autocomplete="off">    
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <div id="user_mother_fields" class="form-group">
                                        <label for="user_mother" id="label_user_mother">FILTRO: Mãe:</label>
                                        <input type="text" id="user_mother" name="user_mother" class="form-control form-control-sm" maxlength="50" autocomplete="off">    
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                    <div id="user_date_birth_fields" class="form-group">
                                        <label for="user_date_birth" id="label_user_date_birth">FILTRO: Data Nascimento:</label>
                                        <input type="text" id="user_date_birth" name="user_date_birth" class="form-control form-control-sm" maxlength="15" autocomplete="off">    
                                    </div>
                                </div>
                        
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-1 mt-2">
                                    <div id="user_button_fields" class="form-group">
                                        <label for="user_button" id="label_user_button"></label>
                                        <button type="button" class="form-control btn btn-outline-secondary btn-sm query_users_patient" title="Buscar" url="{{ route('users.form.query') }}">
                                            <span class="fas fa-search" data-fa-transform="shrink-3 down-2"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-1 mt-2">
                                    <div id="user_button_fields" class="form-group">
                                        <label for="user_button" id="label_user_button"></label>
                                        <button type="button" class="form-control btn btn-outline-secondary btn-sm" url="{{ route('users_patients.form') }}" iframe-title="Inserir Paciente" title="Novo Registro" data-iframe>
                                            <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <div class="col-sm-12 col-md-2 col-lg-2 col-xl-1 mt-2">
                                <div id="user_button_fields" class="form-group">
                                    <label for="user_button" id="label_user_button"></label>
                                    <button type="button" class="form-control btn btn-outline-secondary btn-sm edit-patient-users" url="{{ route('users_patients.form') }}" iframe-title="Editar Paciente" title="Editar">
                                        <span class="far fa-edit" data-fa-transform="shrink-3 down-2"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md col-lg col-xl">
                                <div id="IdUsers_fields" class="form-group">
                                    <label for="IdUsers" id="label_IdUsers">Paciente</label>
                                    <select id="IdUsers" name="IdUsers" class="form-control form-control-sm @error('IdUsers') is-invalid @enderror" url-query="{{ route('users.query.json') }}">
                                        <option value="{{old('IdUsers') ?? $emergency_services->IdUsers ?? ""}}">...</option>
                                    </select>
                                </div>              
                            </div>
                        </div>

                        <div class="row mt-3 users-data-view"></div>
                    </div>
                </div>
                <!-- patient - start -->

                <!-- allergies diseases - start -->
                <div class="card mb-3 hide card-users">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Alergias Doenças</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('users_diseases', ['type' => "a"]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary" type="button"  title="Alergias Doenças" iframe-form="{{ route('users_diseases.form', ['type' => "a"]) }}" iframe-create="{{ route('users_diseases.form.create', ['type' => "a"]) }}">Inserir</button>
                        </div>
                    </div>
                </div>
                <!-- allergies diseases - end -->

                <!-- background - start -->
                <div class="card mb-3 hide card-users">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Antecedentes</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('users_diseases', ['type' => "b"]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary" type="button"  title="Antecedentes" iframe-form="{{ route('users_diseases.form', ['type' => "b"]) }}" iframe-create="{{ route('users_diseases.form.create', ['type' => "b"]) }}">Inserir</button>
                        </div>
                    </div>
                </div>
                <!-- background - end -->

                <!-- content - start -->
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Conteúdo</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">

                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="provenance_fields" class="form-group">
                                    <label for="provenance" id="label_provenance">Procedencia:</label>
                                    <select id="provenance" name="provenance" class="form-control form-control-sm @error('provenance') is-invalid @enderror">
                                        <option value="liv" @if((old('provenance') == "liv") OR (!empty($emergency_services) AND ($emergency_services->provenance == "liv")))selected @endif>Livre Demanda</option>
                                        <option value="agen" @if((old('provenance') == "agen") OR (!empty($emergency_services) AND ($emergency_services->provenance == "agen")))selected @endif>Agente Penitenciário</option>
                                        <option value="amb" @if((old('provenance') == "amb") OR (!empty($emergency_services) AND ($emergency_services->provenance == "amb")))selected @endif>Ambulância</option>
                                        <option value="bom" @if((old('provenance') == "bom") OR (!empty($emergency_services) AND ($emergency_services->provenance == "bom")))selected @endif>Bombeiros</option>
                                        <option value="mic" @if((old('provenance') == "mic") OR (!empty($emergency_services) AND ($emergency_services->provenance == "mic")))selected @endif>Microregião</option>
                                        <option value="out" @if((old('provenance') == "out") OR (!empty($emergency_services) AND ($emergency_services->provenance == "out")))selected @endif>Outros</option>
                                        <option value="poc" @if((old('provenance') == "poc") OR (!empty($emergency_services) AND ($emergency_services->provenance == "poc")))selected @endif>Polícia Civil</option>
                                        <option value="pom" @if((old('provenance') == "pom") OR (!empty($emergency_services) AND ($emergency_services->provenance == "pom")))selected @endif>Polícia Militar</option>
                                        <option value="rot" @if((old('provenance') == "rot") OR (!empty($emergency_services) AND ($emergency_services->provenance == "rot")))selected @endif>Retorno (Mostrar Exame)</option>
                                        <option value="sam" @if((old('provenance') == "sam") OR (!empty($emergency_services) AND ($emergency_services->provenance == "sam")))selected @endif>SAMU</option>
                                        <option value="tu" @if((old('provenance') == "tu") OR (!empty($emergency_services) AND ($emergency_services->provenance == "tu")))selected @endif>Transferido de Unidades</option>
                                    </select>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="types_fields" class="form-group">
                                    <label for="types" id="label_types">Atendimento:</label>
                                    <select id="types" name="types" class="form-control form-control-sm @error('types') is-invalid @enderror" required>
                                        <option value="acol" @if((old('types') == "acol") OR (!empty($emergency_services) AND ($emergency_services->types == "acol")))selected @endif>Acolhimento</option>

                                        @if((!empty($emergency_services)) AND $emergency_services->types == 'pp')
                                            <option value="pp" selected>Aguardando Paciente</option>
                                        @endif

                                        @if((!empty($emergency_services)) AND $emergency_services->types == 'acol-s')
                                            <option value="acol-s" selected>Em Acolhimento</option>
                                        @endif

                                        @if((!empty($emergency_services)) AND $emergency_services->types == 'atem-s')
                                            <option value="atem-s" selected>Em Atendimento Médico</option>
                                        @endif

                                        @if((!empty($emergency_services)) AND $emergency_services->types == 'atem')
                                            <option value="atem" @if((old('types') == "atem") OR (!empty($emergency_services) AND ($emergency_services->types == "atem")))selected @endif>Atendimento Médico</option>
                                        @endif
                                    </select>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="character_fields" class="form-group">
                                    <label for="character" id="label_character">Caráter do Atendimento:</label>
                                    <select id="character" name="character" class="form-control form-control-sm @error('character') is-invalid @enderror">
                                        <option value="ele" @if((old('character') == "ele") OR (!empty($emergency_services) AND ($emergency_services->character == "ele")))selected @endif>Eletivo</option>
                                        <option value="urg" @if((old('character') == "urg") OR (!empty($emergency_services) AND ($emergency_services->character == "urg")))selected @endif>Urgência</option>
                                        <option value="trab" @if((old('character') == "trab") OR (!empty($emergency_services) AND ($emergency_services->character == "trab")))selected @endif>Acidente no local de trabalho ou a serviço da empresa</option>
                                        <option value="traj" @if((old('character') == "traj") OR (!empty($emergency_services) AND ($emergency_services->character == "traj")))selected @endif>Acidente no trajeto para o trabalho</option>
                                        <option value="otra" @if((old('character') == "otra") OR (!empty($emergency_services) AND ($emergency_services->character == "otra")))selected @endif>Outros tipos de acidentes de trânsito</option>
                                        <option value="oles" @if((old('character') == "oles") OR (!empty($emergency_services) AND ($emergency_services->character == "oles")))selected @endif>Outros tipos de lesões e envenenamento por agentes químicos ou físicos</option>
                                    </select>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div id="forwarding_fields" class="form-group">
                                    <label for="forwarding" id="label_forwarding" class="label_forwarding">Encaminhamento:</label>
                                    <select name="forwarding" id="forwarding" class="form-control form-control-sm @error('forwarding') is-invalid @enderror" required>
                                        <option value="n" @if((old('forwarding') == "n") OR (!empty($emergency_services) AND ($emergency_services->forwarding == "n")))selected @endif>Não</option>
                                        <option value="y" @if((old('forwarding') == "y") OR (!empty($emergency_services) AND ($emergency_services->forwarding == "y")))selected @endif>Sim</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div id="accident_work_fields" class="form-group">
                                    <label for="accident_work" id="label_accident_work" class="label_accident_work">Acidente Trabalho:</label>
                                    <select name="accident_work" class="form-control form-control-sm @error('accident_work') is-invalid @enderror">
                                        <option value="n" @if((old('accident_work') == "n") OR (!empty($emergency_services) AND ($emergency_services->accident_work == "n")))selected @endif>Não</option>
                                        <option value="y" @if((old('accident_work') == "y") OR (!empty($emergency_services) AND ($emergency_services->accident_work == "y")))selected @endif>Sim</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1 hide card-forwarding">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="forwarding_uf_fields" class="form-group">
                                    <label for="forwarding_uf" id="label_forwarding_uf">Estado/UF:</label>
                                    <select id="forwarding_uf" name="forwarding_uf" class="form-control form-control-sm @error('forwarding_uf') is-invalid @enderror" {{ app('request')->input('module') == "medical" ? "required" : "" }}>
                                        <option value="" selected="selected">...</option>
                                        <option value="AC" @if((old('forwarding_uf') == "AC") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "AC")))selected @endif>AC</option>
                                        <option value="AL" @if((old('forwarding_uf') == "AL") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "AL")))selected @endif>AL</option>
                                        <option value="AM" @if((old('forwarding_uf') == "AM") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "AM")))selected @endif>AM</option>
                                        <option value="AP" @if((old('forwarding_uf') == "AP") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "AP")))selected @endif>AP</option>
                                        <option value="BA" @if((old('forwarding_uf') == "BA") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "BA")))selected @endif>BA</option>
                                        <option value="CE" @if((old('forwarding_uf') == "CE") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "CE")))selected @endif>CE</option>
                                        <option value="DF" @if((old('forwarding_uf') == "DF") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "DF")))selected @endif>DF</option>
                                        <option value="ES" @if((old('forwarding_uf') == "ES") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "ES")))selected @endif>ES</option>
                                        <option value="GO" @if((old('forwarding_uf') == "GO") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "GO")))selected @endif>GO</option>
                                        <option value="MA" @if((old('forwarding_uf') == "MA") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "MA")))selected @endif>MA</option>
                                        <option value="MG" @if((old('forwarding_uf') == "MG") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "MG")))selected @endif>MG</option>
                                        <option value="MS" @if((old('forwarding_uf') == "MS") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "MS")))selected @endif>MS</option>
                                        <option value="MT" @if((old('forwarding_uf') == "MT") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "MT")))selected @endif>MT</option>
                                        <option value="PA" @if((old('forwarding_uf') == "PA") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "PA")))selected @endif>PA</option>
                                        <option value="PB" @if((old('forwarding_uf') == "PB") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "PB")))selected @endif>PB</option>
                                        <option value="PE" @if((old('forwarding_uf') == "PE") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "PE")))selected @endif>PE</option>
                                        <option value="PI" @if((old('forwarding_uf') == "PI") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "PI")))selected @endif>PI</option>
                                        <option value="PR" @if((old('forwarding_uf') == "PR") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "PR")))selected @endif>PR</option>
                                        <option value="RJ" @if((old('forwarding_uf') == "RJ") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "RJ")))selected @endif>RJ</option>
                                        <option value="RN" @if((old('forwarding_uf') == "RN") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "RN")))selected @endif>RN</option>
                                        <option value="RO" @if((old('forwarding_uf') == "RO") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "RO")))selected @endif>RO</option>
                                        <option value="RR" @if((old('forwarding_uf') == "RR") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "RR")))selected @endif>RR</option>
                                        <option value="RS" @if((old('forwarding_uf') == "RS") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "RS")))selected @endif>RS</option>
                                        <option value="SC" @if((old('forwarding_uf') == "SC") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "SC")))selected @endif>SC</option>
                                        <option value="SE" @if((old('forwarding_uf') == "SE") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "SE")))selected @endif>SE</option>
                                        <option value="SP" @if((old('forwarding_uf') == "SP") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "SP")))selected @endif>SP</option>
                                        <option value="TO" @if((old('forwarding_uf') == "TO") OR (!empty($emergency_services) AND ($emergency_services->forwarding_uf == "TO")))selected @endif>TO</option>	
                                    </select>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md col-lg col-xl hide" id="forwarding_county_fields">
                                <div class="form-group">
                                    <label for="forwarding_county" id="label_forwarding_county">Municipio:</label>
                                    <select id="forwarding_county" name="forwarding_county" class="form-control form-control-sm">
                                        <option value="" selected="selected">...</option>
                                    </select>
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md col-lg col-xl">
                                <div id="forwarding_number_fields" class="form-group">
                                    <label for="forwarding_number" id="label_forwarding_number">N° Solicitação:</label>
                                    <input type="text" id="forwarding_number" name="forwarding_number" class="form-control form-control-sm @error('forwarding_number') is-invalid @enderror" value="{{old('forwarding_number') ?? $emergency_services->forwarding_number ?? ""}}">
                                    <div class="valid-feedback">sucesso!</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- content - end -->

                <!-- note - start -->
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Observação</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                        <textarea class="form-control form-control-sm @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="Observação">{{old('text') ?? $emergency_services->note ?? ""}}</textarea>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
                <!-- note - end -->
            </div>

            <!-- Dados do Acompanhante -->
            <div class="data-acompanhante block-item-class">
                
                <!-- patient - start -->
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Dados do Acompanhante</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                            
                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="escort_name_fields" class="form-group">
                                    <label for="escort_name" id="label_escort_name">Nome do Acompanhante:</label>
                                    <input type="text" id="escort_name" name="escort_name" class="form-control form-control-sm" value="@if(!empty($emergency_services)){{ $emergency_services->escort_name }}@endif">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="kinship_fields" class="form-group">
                                    <label for="kinship" id="label_kinship">Parentesco:</label>
                                    <input type="text" id="kinship" name="kinship" class="form-control form-control-sm" value="@if(!empty($emergency_services)){{ $emergency_services->kinship }}@endif">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div id="escort_phone_fields" class="form-group">
                                    <label for="escort_phone" id="label_escort_phone">Telefone:</label>
                                    <input type="text" id="escort_phone" name="escort_phone" class="form-control form-control-sm" value="@if(!empty($emergency_services)){{ $emergency_services->escort_phone }}@endif">
                                </div>
                            </div>
                        </div>

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
    @if(empty($emergency_services))
        localStorage.setItem('block-item-select', '')
    @endif
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>
<script src="{{ asset('admin/js/modules/emergency_services.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/iframe.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/block-item.js') }}" type="text/javascript"></script>

<script type="text/javascript">

//forwarding_county
function forwarding_county() {
let a = $('#forwarding_uf').val()

if(a){
    $('#forwarding_county_fields').removeClass('hide')
    $('#forwarding_county').html('<option value="" selected="selected">loading...</option>');

    request('{{route('query.city')}}', {uf:a, forwarding_county:'{{ old('forwarding_county') ?? $emergency_services->forwarding_county ?? "" }}'}, function(res){
        $('#forwarding_county').html(res);
    });

}else{
    $('#forwarding_county_fields').addClass('hide')
    $('#forwarding_county').val('')
}
}
forwarding_county()

$(document).ready(function() {
    $("input[id='user_cpf_cnpj']").mask('999.999.999-99');
    $("input[id='user_date_birth']").mask('99-99-9999');
    $("input[id='user_phone']").mask('(99) 9 9999-9999');
    $("input[id='escort_phone']").mask('(99) 9 9999-9999');

    //region - validação
	$("#form").validate({
		rules: {
            users_date_birth:{
                required:{
					depends: function(element) {
						return $("#identified_patient").val() == "n";
					}
				},
            },
            users_sex:{
                required:{
					depends: function(element) {
						return $("#identified_patient").val() == "n";
					}
				},
            },
            IdUsers:{
                required:{
					depends: function(element) {
						return $("#identified_patient").val() == "y";
					}
				},
            },
            forwarding_uf:{
                required:{
					depends: function(element) {
						return $("#forwarding").val() == "y";
					}
				},
            },
            forwarding_county:{
                required:{
					depends: function(element) {
						return $("#forwarding").val() == "y";
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

    $('#forwarding_uf').on('change', function(){
        forwarding_county()
    })
})
</script>

@endsection
<!-- end - start -->