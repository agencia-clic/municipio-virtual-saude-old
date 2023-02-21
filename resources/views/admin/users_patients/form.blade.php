@extends('layouts.admin.app')

@section('content')

<!-- form -- start -->
<form class="needs-validation mt-2" id="form-iframe" name="form-iframe" method="POST" enctype="multipart/form-data" action="{{ empty($users->IdUsers) ? route('users_patients.form.create', ['module' => app('request')->input('module')]) : route('users_patients.form.update',['module' => app('request')->input('module'), 'IdUsers' => base64_encode($users->IdUsers)])}}" novalidate="">

    @csrf <!--token--> 

    <!-- general data - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Dados Gerais</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="name_fields" class="form-group">
                        <label for="name" id="label_name">Nome:</label>
                        <input type="text" id="name" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{old('name') ?? $users->name ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="email_fields" class="form-group">
                        <label for="email" id="label_email">E-mail:</label>
                        <input type="text" id="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{old('email') ?? $users->email ?? ""}}" data-no-uppercase="true">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="cpf_cnpj_fields" class="form-group">
                        <label for="cpf_cnpj" id="label_cpf_cnpj">CPF:</label>
                        <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control form-control-sm @error('cpf_cnpj') is-invalid @enderror" value="{{old('cpf_cnpj') ?? $users->cpf_cnpj ?? ""}}" @if(!empty($users->cpf_cnpj))readonly @endif required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="cns_fields" class="form-group">
                        <label for="cns" id="label_cns">CNS:</label>
                        <input type="number" id="cns" name="cns" class="form-control form-control-sm @error('cns') is-invalid @enderror" value="{{ old('cns') ?? $users->cns ?? "" }}" @if(!empty($users->cns))readonly @endif>
                        <div class="valid-feedback">sucesso!</div>
                        <div class="invalid-feedback">Celular obrigatório!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="date_birth_fields" class="form-group @error('date_birth') is-invalid @enderror">
                        <label for="date_birth" id="label_date_birth">Data Nascimento:</label>
                        <input type="text" id="date_birth" name="date_birth" class="form-control form-control-sm" value="{{!empty($users) ? date('d-m-Y', strtotime($users->date_birth)) : old('date_birth') }}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="mother_fields" class="form-group">
                        <label for="mother" id="label_mother">Nome Mãe:</label>
                        <input type="text" id="mother" name="mother" class="form-control form-control-sm @error('mother') is-invalid @enderror" value="{{ old('mother') ?? $users->mother ?? "" }}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- general data - end -->

    <!-- complement - start -->
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
                    <div id="breed_fields" class="form-group">
                        <label for="breed" id="label_breed">Raça:</label>
                        <select id="breed" name="breed" class="form-control form-control-sm @error('breed') is-invalid @enderror">
                            <option value="" selected="selected">...</option>
                            <option value="B" @if((old('breed') == "B") OR (!empty($users) AND ($users->breed == "B")))selected @endif>BRANCA</option>
                            <option value="N" @if((old('breed') == "N") OR (!empty($users) AND ($users->breed == "N")))selected @endif>NEGRA</option>
                            <option value="P" @if((old('breed') == "P") OR (!empty($users) AND ($users->breed == "P")))selected @endif>PARDA</option>
                            <option value="A" @if((old('breed') == "A") OR (!empty($users) AND ($users->breed == "A")))selected @endif>AMARELA</option>
                            <option value="I" @if((old('breed') == "I") OR (!empty($users) AND ($users->breed == "I")))selected @endif>INDIGENA</option>
                            <option value="O" @if((old('breed') == "O") OR (!empty($users) AND ($users->breed == "O")))selected @endif>OUTROS</option>
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="sex_fields" class="form-group">
                        <label for="sex" id="label_sex">Genero:</label>
                        <select id="sex" name="sex" class="form-control form-control-sm @error('sex') is-invalid @enderror" required>
                            <option value="" selected="selected">...</option>
                            <option value="m" @if((old('sex') == "m") OR (!empty($users) AND ($users->sex == "m")))selected @endif>MASCULINO</option>
                            <option value="f" @if((old('sex') == "f") OR (!empty($users) AND ($users->sex == "f")))selected @endif>FEMININO</option>
                            <option value="o" @if((old('sex') == "o") OR (!empty($users) AND ($users->sex == "o")))selected @endif>OUTROS</option>
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="sanguine_fields" class="form-group">
                        <label for="sanguine" id="label_sanguine">T.Sanguineo:</label>
                        <select id="sanguine" name="sanguine" class="form-control form-control-sm @error('sanguine') is-invalid @enderror">
                            <option value="" selected="selected">...</option>
                            <option value="A+" @if((old('sanguine') == "A+") OR (!empty($users) AND ($users->sanguine == "A+")))selected @endif>A+</option>
                            <option value="A-" @if((old('sanguine') == "A-") OR (!empty($users) AND ($users->sanguine == "A-")))selected @endif>A-</option>
                            <option value="B+" @if((old('sanguine') == "B+") OR (!empty($users) AND ($users->sanguine == "B+")))selected @endif>B+</option>
                            <option value="AB+" @if((old('sanguine') == "AB+") OR (!empty($users) AND ($users->sanguine == "AB+")))selected @endif>AB+</option>
                            <option value="AB-" @if((old('sanguine') == "AB-") OR (!empty($users) AND ($users->sanguine == "AB-")))selected @endif>AB-</option>
                            <option value="O-" @if((old('sanguine') == "O-") OR (!empty($users) AND ($users->sanguine == "O-")))selected @endif>O-</option>
                            <option value="O+" @if((old('sanguine') == "O+") OR (!empty($users) AND ($users->sanguine == "O+")))selected @endif>O+</option>
                            <option value="N" @if((old('sanguine') == "N") OR (!empty($users) AND ($users->sanguine == "N")))selected @endif>Nenhum</option>
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="schooling_fields" class="form-group">
                        <label for="schooling" id="label_schooling">Escolaridade:</label>
                        <select id="schooling" name="schooling" class="form-control form-control-sm @error('schooling') is-invalid @enderror">
                            <option value="" selected="selected">...</option>
                            <option value="ca" @if((old('schooling') == "ca") OR (!empty($users) AND ($users->schooling == "ca")))selected @endif>Classe Alfabetizada</option>
                            <option value="c" @if((old('schooling') == "c") OR (!empty($users) AND ($users->schooling == "c")))selected @endif>Creche</option>
                            <option value="ef" @if((old('schooling') == "ef") OR (!empty($users) AND ($users->schooling == "ef")))selected @endif>Ensino Fundamental</option>
                            <option value="efc" @if((old('schooling') == "efc") OR (!empty($users) AND ($users->schooling == "efc")))selected @endif>Ensino Fundamental Completo</option>
                            <option value="t" @if((old('schooling') == "t") OR (!empty($users) AND ($users->schooling == "t")))selected @endif>Ensino Tecnico</option>
                            <option value="si" @if((old('schooling') == "si") OR (!empty($users) AND ($users->schooling == "si")))selected @endif>Ensino Superior Incompleto</option>
                            <option value="s" @if((old('schooling') == "s") OR (!empty($users) AND ($users->schooling == "s")))selected @endif>Ensino Superior</option>
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="marital_status_fields" class="form-group">
                        <label for="marital_status" id="label_marital_status">Estado Civil:</label>
                        <select id="marital_status" name="marital_status" class="form-control form-control-sm @error('marital_status') is-invalid @enderror">
                            <option value="" selected="selected">...</option>
                            <option value="c" @if((old('marital_status') == "c") OR (!empty($users) AND ($users->marital_status == "c")))selected @endif>Casado</option>
                            <option value="s" @if((old('marital_status') == "s") OR (!empty($users) AND ($users->marital_status == "s")))selected @endif>Solteiro</option>
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="occupation_fields" class="form-group">
                        <label for="occupation" id="label_occupation">Ocupacão:</label>
                        <input type="text" id="occupation" name="occupation" class="form-control form-control-sm @error('occupation') is-invalid @enderror" value="{{ old('occupation') ?? $users->occupation ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="rg_fields" class="form-group">
                        <label for="rg" id="label_rg">RG:</label>
                        <input type="text" id="rg" name="rg" class="form-control form-control-sm @error('rg') is-invalid @enderror" value="{{ old('rg') ?? $users->rg ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="uf_rg_fields" class="form-group">
                        <label for="uf_rg" id="label_uf_rg">Estado/UF:</label>
                        <select id="uf_rg" name="uf_rg" class="form-control form-control-sm @error('uf_rg') is-invalid @enderror">
                            <option value="MG" @if((old('uf_rg') == "MG") OR (!empty($users) AND ($users->uf_rg == "MG")))selected @endif>MG</option>
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
                    <div id="voter_registration_fields" class="form-group">
                        <label for="voter_registration" id="label_voter_registration">Titulo Eleitor:</label>
                        <input type="text" id="voter_registration" name="voter_registration" class="form-control form-control-sm @error('voter_registration') is-invalid @enderror" value="{{ old('voter_registration') ?? $users->voter_registration ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="cell_fields" class="form-group">
                        <label for="cell" id="label_cell">Celular:</label>
                        <input type="text" id="cell" name="cell" class="form-control form-control-sm @error('cell') is-invalid @enderror" value="{{ old('cell') ?? $users->cell ?? "" }}">
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

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="origin_fields" class="form-group">
                        <label for="origin" id="label_origin">Pais Origem:</label>
                        <input type="text" id="origin" name="origin" class="form-control form-control-sm" value="{{ old('origin') ?? $users->origin ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- complement - end -->

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
                    <div id="complement_fields" class="form-group">
                        <label for="complement" id="label_complement">Complemento:</label>
                        <input type="text" id="complement" name="complement" class="form-control form-control-sm" value="{{ old('complement') ?? $users->complement ?? "" }}">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

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
            </div>

            <div class="row mt-1">

                <div class="col-sm-12 col-md col-lg col-xl">
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

                <div class="col-sm-12 col-md col-lg col-xl">
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

            </div>
        </div>
    </div>
    <!-- address - end -->
    
    <button type="submit" id="send-form" class="hide"></button>
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
<script src="{{ asset('admin/js/modules/emergency_services.js') }}" type="text/javascript"></script>

<script type="text/javascript">

//naturalness
function naturalness() {

    let a = $('#uf_naturalness').val()

    if(a){
        $('#naturalness_fields').removeClass('hide')
        $('#naturalness').html('<option value="" selected="selected">loading...</option>');

        request('{{route('query.city')}}', {uf:a, naturalness:'{{ old('naturalness') ?? $users->naturalness ?? "Araxá" }}'}, function(res){
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

    //reload dados
    @if(!empty($users->IdUsers))
        window.parent.query_users(' {{$users->IdUsers}} ')
    @endif

    //modal close users
    @if($close = Session::get('modal-close-users'))
        window.parent.close_modal('{{ $close }}')
    @endif

    //region - validação
	$("#form-iframe").validate({
		rules: {
            name: "required",
            sex: "required",
            mother: "required",
			cpf_cnpj: {
				minlength: 14,
				cpfBR: true,
				remote: "{{ route('users.existe.cpf', ['cpf_current' => $users->cpf_cnpj ?? ""]) }}"
			},
            email: {
                email:true,
				remote: "{{ route('users.existe.email', ['email_current' => $users->email ?? ""]) }}"
			},
            date_birth:{
                required: true,
                dateBR: true,
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