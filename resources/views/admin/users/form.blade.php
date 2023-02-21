@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">
        @if(app('request')->input('module') == 'medical')
            Médicos
        @else
            Usuários
        @endif
    </span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($users->IdUsers) ? route('users.form.create', ['module' => app('request')->input('module')]) : route('users.form.update',['module' => app('request')->input('module'), 'IdUsers' => base64_encode($users->IdUsers)])}}" novalidate="">
    
    @csrf <!--token--> 

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="{{ route('users', ['module' => app('request')->input('module')]) }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('users')}}">{{ app('request')->input('module') == "medical" ? "Médicos" : "Usuários" }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(empty($users))Inserir @else Editar @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                    <div id="IdUsers_fields" class="form-group">
                        <label for="IdUsers" id="label_IdUsers">Código:</label>
                        <input type="text" id="IdUsers" name="IdUsers" class="form-control form-control-sm" value="@if(!empty($users)){{ $users->IdUsers }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control form-control-sm" value="@if(!empty($users)){{ date('d-m-Y H:i', strtotime($users->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-12 col-md col-lg-3 col-xl">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control form-control-sm" value="@if(!empty($users)){{ date('d-m-Y H:i', strtotime($users->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control form-control-sm @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($users) AND ($users->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($users) AND ($users->status == "b")))selected @endif>Bloqueado</option>
                        </select>
                    </div>
                </div>

               
                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="visible_fields" class="form-group">
                        <label for="visible" id="label_visible" class="label_visible">Visivel:</label>
                        <select name="visible" class="form-control form-control-sm @error('visible') is-invalid @enderror">
                            <option value="y" @if((old('visible') == "y") OR (!empty($users) AND ($users->visible == "y")))selected @endif>Sim</option>
                            <option value="n" @if((old('visible') == "b") OR (!empty($users) AND ($users->visible == "n")))selected @endif>Não</option>
                        </select>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
    <!-- basic - end -->

    <!-- complemnt - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Complemento</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="name_fields" class="form-group">
                        <label for="name" id="label_name">Nome Razão Social:</label>
                        <input type="text" id="name" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{old('name') ?? $users->name ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="email_fields" class="form-group">
                        <label for="email" id="label_email">E-mail:</label>
                        <input type="text" id="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{old('email') ?? $users->email ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="cpf_cnpj_fields" class="form-group">
                        <label for="cpf_cnpj" id="label_cpf_cnpj">CPF/CNPJ:</label>
                        <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control form-control-sm @error('cpf_cnpj') is-invalid @enderror" value="{{old('cpf_cnpj') ?? $users->cpf_cnpj ?? ""}}" required @if(!empty($users))readonly @endif>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="level_fields" class="form-group">
                        <label for="level" id="label_level" class="label_level">Nível:</label>
                        <select name="level" class="form-control form-control-sm @error('level') is-invalid @enderror" required>
                            <option value="u" @if((old('level') == "u") OR (!empty($users) AND ($users->level == "u")))selected @endif>Usuário</option>
                            <option value="a" @if((old('level') == "a") OR (!empty($users) AND ($users->level == "a")))selected @endif>Administrador</option>

                            @if(auth()->user()->level == "s")
                                <option value="s" @if((old('level') == "s") OR (!empty($users) AND ($users->level == "s")))selected @endif>Super Administrador</option>
                            @endif
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="cell_fields" class="form-group">
                        <label for="cell" id="label_cell">Celular:</label>
                        <input type="text" id="cell" name="cell" class="form-control form-control-sm @error('cell') is-invalid @enderror" value="{{ old('cell') ?? $users->cell ?? "" }}" required>
                        <div class="valid-feedback">sucesso!</div>
                        <div class="invalid-feedback">Celular obrigatório!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="phone_fields" class="form-group">
                        <label for="phone" id="label_phone">Telefone:</label>
                        <input type="text" id="phone" name="phone" class="form-control form-control-sm @error('phone') is-invalid @enderror" value="{{ old('phone') ?? $users->phone ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="rg_fields" class="form-group">
                        <label for="rg" id="label_rg">RG:</label>
                        <input type="text" id="rg" name="rg" class="form-control form-control-sm @error('rg') is-invalid @enderror" value="{{ old('rg') ?? $users->rg ?? "" }}" oninput="this.value = this.value.toUpperCase()">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="uf_rg_fields" class="form-group">
                        <label for="uf_rg" id="label_uf_rg">Estado/UF:</label>
                        <select id="uf_rg" name="uf_rg" class="form-control form-control-sm @error('uf_rg') is-invalid @enderror">
                            <option value="" selected="selected">...</option>
                            <option value="AC" @if((old('uf_rg') == "AC") OR (!empty($users) AND ($users->uf_rg == "AC")))selected @endif>AC</option>
                            <option value="AL" @if((old('uf_rg') == "AL") OR (!empty($users) AND ($users->uf_rg == "AL")))selected @endif>AL</option>
                            <option value="AM" @if((old('uf_rg') == "AM") OR (!empty($users) AND ($users->uf_rg == "AM")))selected @endif>AM</option>
                            <option value="AP" @if((old('uf_rg') == "AP") OR (!empty($users) AND ($users->uf_rg == "AP")))selected @endif>AP</option>
                            <option value="BA" @if((old('uf_rg') == "BA") OR (!empty($users) AND ($users->uf_rg == "BA")))selected @endif>BA</option>
                            <option value="CE" @if((old('uf_rg') == "CE") OR (!empty($users) AND ($users->uf_rg == "CE")))selected @endif>CE</option>
                            <option value="DF" @if((old('uf_rg') == "DF") OR (!empty($users) AND ($users->uf_rg == "DF")))selected @endif>DF</option>
                            <option value="ES" @if((old('uf_rg') == "ES") OR (!empty($users) AND ($users->uf_rg == "ES")))selected @endif>ES</option>
                            <option value="GO" @if((old('uf_rg') == "GO") OR (!empty($users) AND ($users->uf_rg == "GO")))selected @endif>GO</option>
                            <option value="MA" @if((old('uf_rg') == "MA") OR (!empty($users) AND ($users->uf_rg == "MA")))selected @endif>MA</option>
                            <option value="MG" @if((old('uf_rg') == "MG") OR (!empty($users) AND ($users->uf_rg == "MG")))selected @endif>MG</option>
                            <option value="MS" @if((old('uf_rg') == "MS") OR (!empty($users) AND ($users->uf_rg == "MS")))selected @endif>MS</option>
                            <option value="MT" @if((old('uf_rg') == "MT") OR (!empty($users) AND ($users->uf_rg == "MT")))selected @endif>MT</option>
                            <option value="PA" @if((old('uf_rg') == "PA") OR (!empty($users) AND ($users->uf_rg == "PA")))selected @endif>PA</option>
                            <option value="PB" @if((old('uf_rg') == "PB") OR (!empty($users) AND ($users->uf_rg == "PB")))selected @endif>PB</option>
                            <option value="PE" @if((old('uf_rg') == "PE") OR (!empty($users) AND ($users->uf_rg == "PE")))selected @endif>PE</option>
                            <option value="PI" @if((old('uf_rg') == "PI") OR (!empty($users) AND ($users->uf_rg == "PI")))selected @endif>PI</option>
                            <option value="PR" @if((old('uf_rg') == "PR") OR (!empty($users) AND ($users->uf_rg == "PR")))selected @endif>PR</option>
                            <option value="RJ" @if((old('uf_rg') == "RJ") OR (!empty($users) AND ($users->uf_rg == "RJ")))selected @endif>RJ</option>
                            <option value="RN" @if((old('uf_rg') == "RN") OR (!empty($users) AND ($users->uf_rg == "RN")))selected @endif>RN</option>
                            <option value="RO" @if((old('uf_rg') == "RO") OR (!empty($users) AND ($users->uf_rg == "RO")))selected @endif>RO</option>
                            <option value="RR" @if((old('uf_rg') == "RR") OR (!empty($users) AND ($users->uf_rg == "RR")))selected @endif>RR</option>
                            <option value="RS" @if((old('uf_rg') == "RS") OR (!empty($users) AND ($users->uf_rg == "RS")))selected @endif>RS</option>
                            <option value="SC" @if((old('uf_rg') == "SC") OR (!empty($users) AND ($users->uf_rg == "SC")))selected @endif>SC</option>
                            <option value="SE" @if((old('uf_rg') == "SE") OR (!empty($users) AND ($users->uf_rg == "SE")))selected @endif>SE</option>
                            <option value="SP" @if((old('uf_rg') == "SP") OR (!empty($users) AND ($users->uf_rg == "SP")))selected @endif>SP</option>
                            <option value="TO" @if((old('uf_rg') == "TO") OR (!empty($users) AND ($users->uf_rg == "TO")))selected @endif>TO</option>	
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="date_birth_fields" class="form-group @error('date_birth') is-invalid @enderror">
                        <label for="date_birth" id="label_date_birth">Data Nascimento:</label>
                        <input type="text" id="date_birth" name="date_birth" class="form-control form-control-sm" value="@if(!empty(old('date_birth'))) {{old('date_birth')}} @elseif(!empty($users->date_birth)){{date('d-m-Y', strtotime($users->date_birth))}}@endif">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- complemnt - end -->

    <!-- unidades - start -->
    @if(!empty($users) AND ($users->level != "s"))
    <div class="card mb-3 {{$users && $users->IdUsers ? "" : "hide"}}">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Unidades</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <div data-iframe="{{ route('users_service_units', ['IdUsers' => base64_encode($users->IdUsers)]) }}"></div>
            
            <div class="col-12 mt-2">
                 <button class="btn btn-primary btn-sm" type="Unidade" iframe-form="{{ route('users_service_units.form', ['IdUsers' => base64_encode($users->IdUsers)]) }}" iframe-create="{{ route('users_service_units.form.create', ['IdUsers' => base64_encode($users->IdUsers)]) }}">Inserir</button>
            </div>
        </div>
    </div>
    @endif
    <!-- unidades - end -->

    <!-- specialties - start -->
    @if(!empty($users) AND ($users->level != "s"))
    <div class="card mb-3 {{$users && $users->IdUsers ? "" : "hide"}}">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Especialidades (<strong>CBO</strong>)</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <div data-iframe="{{ route('users_medical_specialties', ['IdUsers' => base64_encode($users->IdUsers)]) }}"></div>
            
            <div class="col-12 mt-2">
                 <button class="btn btn-primary btn-sm" type="Especialidades (<strong>CBO</strong>)" iframe-form="{{ route('users_medical_specialties.form', ['IdUsers' => base64_encode($users->IdUsers)]) }}" iframe-create="{{ route('users_medical_specialties.form.create', ['IdUsers' => base64_encode($users->IdUsers)]) }}">Inserir</button>
            </div>
        </div>
    </div>
    @endif
    <!-- specialties - end -->

    <!-- medical - start -->
    @if(app('request')->input('module') == "medical")
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Dados</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="crm_fields" class="form-group">
                        <label for="crm" id="label_crm">CRM:</label>
                        <input type="text" id="crm" name="crm" class="form-control form-control-sm @error('crm') is-invalid @enderror" value="{{old('crm') ?? $users->crm ?? ""}}" {{ app('request')->input('module') == "medical" ? "required" : "" }}>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="uf_crm_fields" class="form-group">
                        <label for="uf_crm" id="label_uf_crm">Estado/UF:</label>
                        <select id="uf_crm" name="uf_crm" class="form-control form-control-sm @error('uf_crm') is-invalid @enderror" {{ app('request')->input('module') == "medical" ? "required" : "" }}>
                            <option value="" selected="selected">...</option>
                            <option value="AC" @if((old('uf_crm') == "AC") OR (!empty($users) AND ($users->uf_crm == "AC")))selected @endif>AC</option>
                            <option value="AL" @if((old('uf_crm') == "AL") OR (!empty($users) AND ($users->uf_crm == "AL")))selected @endif>AL</option>
                            <option value="AM" @if((old('uf_crm') == "AM") OR (!empty($users) AND ($users->uf_crm == "AM")))selected @endif>AM</option>
                            <option value="AP" @if((old('uf_crm') == "AP") OR (!empty($users) AND ($users->uf_crm == "AP")))selected @endif>AP</option>
                            <option value="BA" @if((old('uf_crm') == "BA") OR (!empty($users) AND ($users->uf_crm == "BA")))selected @endif>BA</option>
                            <option value="CE" @if((old('uf_crm') == "CE") OR (!empty($users) AND ($users->uf_crm == "CE")))selected @endif>CE</option>
                            <option value="DF" @if((old('uf_crm') == "DF") OR (!empty($users) AND ($users->uf_crm == "DF")))selected @endif>DF</option>
                            <option value="ES" @if((old('uf_crm') == "ES") OR (!empty($users) AND ($users->uf_crm == "ES")))selected @endif>ES</option>
                            <option value="GO" @if((old('uf_crm') == "GO") OR (!empty($users) AND ($users->uf_crm == "GO")))selected @endif>GO</option>
                            <option value="MA" @if((old('uf_crm') == "MA") OR (!empty($users) AND ($users->uf_crm == "MA")))selected @endif>MA</option>
                            <option value="MG" @if((old('uf_crm') == "MG") OR (!empty($users) AND ($users->uf_crm == "MG")))selected @endif>MG</option>
                            <option value="MS" @if((old('uf_crm') == "MS") OR (!empty($users) AND ($users->uf_crm == "MS")))selected @endif>MS</option>
                            <option value="MT" @if((old('uf_crm') == "MT") OR (!empty($users) AND ($users->uf_crm == "MT")))selected @endif>MT</option>
                            <option value="PA" @if((old('uf_crm') == "PA") OR (!empty($users) AND ($users->uf_crm == "PA")))selected @endif>PA</option>
                            <option value="PB" @if((old('uf_crm') == "PB") OR (!empty($users) AND ($users->uf_crm == "PB")))selected @endif>PB</option>
                            <option value="PE" @if((old('uf_crm') == "PE") OR (!empty($users) AND ($users->uf_crm == "PE")))selected @endif>PE</option>
                            <option value="PI" @if((old('uf_crm') == "PI") OR (!empty($users) AND ($users->uf_crm == "PI")))selected @endif>PI</option>
                            <option value="PR" @if((old('uf_crm') == "PR") OR (!empty($users) AND ($users->uf_crm == "PR")))selected @endif>PR</option>
                            <option value="RJ" @if((old('uf_crm') == "RJ") OR (!empty($users) AND ($users->uf_crm == "RJ")))selected @endif>RJ</option>
                            <option value="RN" @if((old('uf_crm') == "RN") OR (!empty($users) AND ($users->uf_crm == "RN")))selected @endif>RN</option>
                            <option value="RO" @if((old('uf_crm') == "RO") OR (!empty($users) AND ($users->uf_crm == "RO")))selected @endif>RO</option>
                            <option value="RR" @if((old('uf_crm') == "RR") OR (!empty($users) AND ($users->uf_crm == "RR")))selected @endif>RR</option>
                            <option value="RS" @if((old('uf_crm') == "RS") OR (!empty($users) AND ($users->uf_crm == "RS")))selected @endif>RS</option>
                            <option value="SC" @if((old('uf_crm') == "SC") OR (!empty($users) AND ($users->uf_crm == "SC")))selected @endif>SC</option>
                            <option value="SE" @if((old('uf_crm') == "SE") OR (!empty($users) AND ($users->uf_crm == "SE")))selected @endif>SE</option>
                            <option value="SP" @if((old('uf_crm') == "SP") OR (!empty($users) AND ($users->uf_crm == "SP")))selected @endif>SP</option>
                            <option value="TO" @if((old('uf_crm') == "TO") OR (!empty($users) AND ($users->uf_crm == "TO")))selected @endif>TO</option>	
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="crn_fields" class="form-group">
                        <label for="crn" id="label_crn">CRN</label>
                        <input type="text" id="crn" name="crn" class="form-control form-control-sm @error('crn') is-invalid @enderror" value="{{old('crn') ?? $users->crn ?? ""}}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- medical - end -->

    <!-- credential - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Credenciais</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            
            <div class="row">
                
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div id="password_fields" class="form-group">
                        <label for="password" id="label_password">Senha:</label>
                        <input type="password" id="password" name="password" class="form-control form-control-sm @error('password') is-invalid @enderror">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div id="password_confirmation_fields" class="form-group">
                        <label for="password_confirmation" id="label_password_confirmation">Confirme Senha:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- credential - end -->

    <!-- address - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Endereço</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">

            <div class="row mt-1">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="zip_code_fields" class="form-group">
                        <label for="zip_code" id="label_zip_code">CEP:</label>
                        <input type="text" id="zip_code" name="zip_code" class="form-control form-control-sm" value="{{ old('zip_code') ?? $users->zip_code ?? "" }}" query="true">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="address_fields" class="form-group">
                        <label for="address" id="label_address">Endereço:</label>
                        <input type="text" id="address" name="address" class="form-control form-control-sm" value="{{ old('address') ?? $users->address ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="number_fields" class="form-group">
                        <label for="number" id="label_number">Número:</label>
                        <input type="text" id="number" name="number" class="form-control form-control-sm" value="{{ old('number') ?? $users->number ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="district_fields" class="form-group">
                        <label for="district" id="label_district">Bairro:</label>
                        <input type="text" id="district" name="district" class="form-control form-control-sm" value="{{ old('district') ?? $users->district ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="city_fields" class="form-group">
                        <label for="city" id="label_city">Cidade:</label>
                        <input type="text" id="city" name="city" class="form-control form-control-sm" value="{{ old('city') ?? $users->city ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="uf_fields" class="form-group">
                        <label for="uf" id="label_uf">Estado/UF:</label>
                        <select id="uf" name="uf" class="form-control form-control-sm @error('uf') is-invalid @enderror">
                            <option value="" selected="selected">...</option>
                            <option value="AC" @if((old('uf') == "AC") OR (!empty($users) AND ($users->uf == "AC")))selected @endif>AC</option>
                            <option value="AL" @if((old('uf') == "AL") OR (!empty($users) AND ($users->uf == "AL")))selected @endif>AL</option>
                            <option value="AM" @if((old('uf') == "AM") OR (!empty($users) AND ($users->uf == "AM")))selected @endif>AM</option>
                            <option value="AP" @if((old('uf') == "AP") OR (!empty($users) AND ($users->uf == "AP")))selected @endif>AP</option>
                            <option value="BA" @if((old('uf') == "BA") OR (!empty($users) AND ($users->uf == "BA")))selected @endif>BA</option>
                            <option value="CE" @if((old('uf') == "CE") OR (!empty($users) AND ($users->uf == "CE")))selected @endif>CE</option>
                            <option value="DF" @if((old('uf') == "DF") OR (!empty($users) AND ($users->uf == "DF")))selected @endif>DF</option>
                            <option value="ES" @if((old('uf') == "ES") OR (!empty($users) AND ($users->uf == "ES")))selected @endif>ES</option>
                            <option value="GO" @if((old('uf') == "GO") OR (!empty($users) AND ($users->uf == "GO")))selected @endif>GO</option>
                            <option value="MA" @if((old('uf') == "MA") OR (!empty($users) AND ($users->uf == "MA")))selected @endif>MA</option>
                            <option value="MG" @if((old('uf') == "MG") OR (!empty($users) AND ($users->uf == "MG")))selected @endif>MG</option>
                            <option value="MS" @if((old('uf') == "MS") OR (!empty($users) AND ($users->uf == "MS")))selected @endif>MS</option>
                            <option value="MT" @if((old('uf') == "MT") OR (!empty($users) AND ($users->uf == "MT")))selected @endif>MT</option>
                            <option value="PA" @if((old('uf') == "PA") OR (!empty($users) AND ($users->uf == "PA")))selected @endif>PA</option>
                            <option value="PB" @if((old('uf') == "PB") OR (!empty($users) AND ($users->uf == "PB")))selected @endif>PB</option>
                            <option value="PE" @if((old('uf') == "PE") OR (!empty($users) AND ($users->uf == "PE")))selected @endif>PE</option>
                            <option value="PI" @if((old('uf') == "PI") OR (!empty($users) AND ($users->uf == "PI")))selected @endif>PI</option>
                            <option value="PR" @if((old('uf') == "PR") OR (!empty($users) AND ($users->uf == "PR")))selected @endif>PR</option>
                            <option value="RJ" @if((old('uf') == "RJ") OR (!empty($users) AND ($users->uf == "RJ")))selected @endif>RJ</option>
                            <option value="RN" @if((old('uf') == "RN") OR (!empty($users) AND ($users->uf == "RN")))selected @endif>RN</option>
                            <option value="RO" @if((old('uf') == "RO") OR (!empty($users) AND ($users->uf == "RO")))selected @endif>RO</option>
                            <option value="RR" @if((old('uf') == "RR") OR (!empty($users) AND ($users->uf == "RR")))selected @endif>RR</option>
                            <option value="RS" @if((old('uf') == "RS") OR (!empty($users) AND ($users->uf == "RS")))selected @endif>RS</option>
                            <option value="SC" @if((old('uf') == "SC") OR (!empty($users) AND ($users->uf == "SC")))selected @endif>SC</option>
                            <option value="SE" @if((old('uf') == "SE") OR (!empty($users) AND ($users->uf == "SE")))selected @endif>SE</option>
                            <option value="SP" @if((old('uf') == "SP") OR (!empty($users) AND ($users->uf == "SP")))selected @endif>SP</option>
                            <option value="TO" @if((old('uf') == "TO") OR (!empty($users) AND ($users->uf == "TO")))selected @endif>TO</option>	
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="uf_naturalness_fields" class="form-group">
                        <label for="uf_naturalness" id="label_uf_naturalness">Estado/UF Naturalidade:</label>
                        <select id="uf_naturalness" name="uf_naturalness" class="form-control form-control-sm @error('uf_naturalness') is-invalid @enderror">
                            <option value="" selected="selected">...</option>
                            <option value="AC" @if((old('uf_naturalness') == "AC") OR (!empty($users) AND ($users->uf_naturalness == "AC")))selected @endif>AC</option>
                            <option value="AL" @if((old('uf_naturalness') == "AL") OR (!empty($users) AND ($users->uf_naturalness == "AL")))selected @endif>AL</option>
                            <option value="AM" @if((old('uf_naturalness') == "AM") OR (!empty($users) AND ($users->uf_naturalness == "AM")))selected @endif>AM</option>
                            <option value="AP" @if((old('uf_naturalness') == "AP") OR (!empty($users) AND ($users->uf_naturalness == "AP")))selected @endif>AP</option>
                            <option value="BA" @if((old('uf_naturalness') == "BA") OR (!empty($users) AND ($users->uf_naturalness == "BA")))selected @endif>BA</option>
                            <option value="CE" @if((old('uf_naturalness') == "CE") OR (!empty($users) AND ($users->uf_naturalness == "CE")))selected @endif>CE</option>
                            <option value="DF" @if((old('uf_naturalness') == "DF") OR (!empty($users) AND ($users->uf_naturalness == "DF")))selected @endif>DF</option>
                            <option value="ES" @if((old('uf_naturalness') == "ES") OR (!empty($users) AND ($users->uf_naturalness == "ES")))selected @endif>ES</option>
                            <option value="GO" @if((old('uf_naturalness') == "GO") OR (!empty($users) AND ($users->uf_naturalness == "GO")))selected @endif>GO</option>
                            <option value="MA" @if((old('uf_naturalness') == "MA") OR (!empty($users) AND ($users->uf_naturalness == "MA")))selected @endif>MA</option>
                            <option value="MG" @if((old('uf_naturalness') == "MG") OR (!empty($users) AND ($users->uf_naturalness == "MG")))selected @endif>MG</option>
                            <option value="MS" @if((old('uf_naturalness') == "MS") OR (!empty($users) AND ($users->uf_naturalness == "MS")))selected @endif>MS</option>
                            <option value="MT" @if((old('uf_naturalness') == "MT") OR (!empty($users) AND ($users->uf_naturalness == "MT")))selected @endif>MT</option>
                            <option value="PA" @if((old('uf_naturalness') == "PA") OR (!empty($users) AND ($users->uf_naturalness == "PA")))selected @endif>PA</option>
                            <option value="PB" @if((old('uf_naturalness') == "PB") OR (!empty($users) AND ($users->uf_naturalness == "PB")))selected @endif>PB</option>
                            <option value="PE" @if((old('uf_naturalness') == "PE") OR (!empty($users) AND ($users->uf_naturalness == "PE")))selected @endif>PE</option>
                            <option value="PI" @if((old('uf_naturalness') == "PI") OR (!empty($users) AND ($users->uf_naturalness == "PI")))selected @endif>PI</option>
                            <option value="PR" @if((old('uf_naturalness') == "PR") OR (!empty($users) AND ($users->uf_naturalness == "PR")))selected @endif>PR</option>
                            <option value="RJ" @if((old('uf_naturalness') == "RJ") OR (!empty($users) AND ($users->uf_naturalness == "RJ")))selected @endif>RJ</option>
                            <option value="RN" @if((old('uf_naturalness') == "RN") OR (!empty($users) AND ($users->uf_naturalness == "RN")))selected @endif>RN</option>
                            <option value="RO" @if((old('uf_naturalness') == "RO") OR (!empty($users) AND ($users->uf_naturalness == "RO")))selected @endif>RO</option>
                            <option value="RR" @if((old('uf_naturalness') == "RR") OR (!empty($users) AND ($users->uf_naturalness == "RR")))selected @endif>RR</option>
                            <option value="RS" @if((old('uf_naturalness') == "RS") OR (!empty($users) AND ($users->uf_naturalness == "RS")))selected @endif>RS</option>
                            <option value="SC" @if((old('uf_naturalness') == "SC") OR (!empty($users) AND ($users->uf_naturalness == "SC")))selected @endif>SC</option>
                            <option value="SE" @if((old('uf_naturalness') == "SE") OR (!empty($users) AND ($users->uf_naturalness == "SE")))selected @endif>SE</option>
                            <option value="SP" @if((old('uf_naturalness') == "SP") OR (!empty($users) AND ($users->uf_naturalness == "SP")))selected @endif>SP</option>
                            <option value="TO" @if((old('uf_naturalness') == "TO") OR (!empty($users) AND ($users->uf_naturalness == "TO")))selected @endif>TO</option>	
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl hide" id="naturalness_fields">
                    <div class="form-group">
                        <label for="naturalness" id="label_naturalness">Naturalidade:</label>
                        <select id="naturalness" name="naturalness" class="form-control form-control-sm">
                            <option value="" selected="selected">...</option>
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="origin_fields" class="form-group">
                        <label for="origin" id="label_origin">País:</label>
                        <input type="text" id="origin" name="origin" class="form-control form-control-sm" value="{{ old('origin') ?? $users->origin ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- address - end -->
</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>
<script src="{{ asset('admin/js/query-zipcode.js') }}"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/modules/users_service_units.js') }}"></script>

<script type="text/javascript">

//naturalness
function naturalness() {

    let a = $('#uf_naturalness').val()

    if(a){
        $('#naturalness_fields').removeClass('hide')
        $('#naturalness').html('<option value="" selected="selected">loading...</option>');

        request('{{route('query.city')}}', {uf:a, naturalness:'{{ old('naturalness') ?? $users->naturalness ?? "" }}'}, function(res){
            $('#naturalness').html(res);
        });

    }else{
        $('#naturalness_fields').addClass('hide')
        $('#naturalness').val('')
    }
}
naturalness()

$(document).ready(function() {

    $("input[id='cpf_cnpj']").mask('999.999.999-99');
    $("input[id='zip_code']").mask('99999999');
    $("input[id='date_birth']").mask('99-99-9999');
    $("input[id='phone']").mask('(99) 9999-9999');
    $("input[id='cell']").mask('(99) 9 9999-9999');

    $('#modal_create').modal('show')

    //region - validação
	$("#form").validate({
		rules: {
			cpf_cnpj: {
				required: true,
				minlength: 14,
				cpfBR: true,
				remote: "{{ route('users.existe.cpf', ['cpf_current' => $users->cpf_cnpj ?? ""]) }}"
			},
            email: {
				required: true,
                email:true,
				remote: "{{ route('users.existe.email', ['email_current' => $users->email ?? ""]) }}"
			},
            date_birth:{
                required: true,
                dateBR: true,
            },
            password: {
				required: {{ json_encode(empty($users->IdUsers), true) ?? ""}},
				minlength: 8
			},
			password_confirmation: {
				required: {{ json_encode(empty($users->IdUsers), true) ?? ""}},
				minlength: 6,
				equalTo: "#password"
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
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
			$("label[id='"+$(element).attr("id")+"-error']").remove(); // exclui o label já validade (padrao validate é display: none)

		},
		ignore: true
	});
	//endregion -  validação

    $('#uf_naturalness').on('change', function(){
        naturalness()
    })
})

</script>

@endsection
<!-- end - start -->