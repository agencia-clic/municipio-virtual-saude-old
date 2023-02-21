<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Identificação do Paciente</h5>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <label for="name" id="label_name"><strong>Paciente:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="name" name="name" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" value="{{ $users->name ?? "" }}">
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="sex_fields" class="form-group">
                    <label for="sex" id="label_sex" class="label_sex">Sexo:</label>
                    <select name="sex" class="form-control form-control-sm @error('sex') is-invalid @enderror">
                        <option value="m" @if((old('sex') == "m") OR (!empty($users) AND ($users->sex == "m")))selected @endif>Masculino</option>
                        <option value="f" @if((old('sex') == "f") OR (!empty($users) AND ($users->sex == "f")))selected @endif>Feminino</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="date_birth_fields" class="form-group">
                    <label for="date_birth" id="label_date_birth">Nascimento</label>
                    <input class="form-control form-control-sm" id="date_birth" name="date_birth" type="text" value="@if(!empty($users) AND ($users->date_birth)){{ date('d-m-Y', strtotime($users->date_birth)) }} @endif" placeholder="d-m-y"/>
                </div>
            </div>

            <div class="col-sm-12 col-md col-lg col-xl">
                <label for="cpf_cnpj" id="label_cpf_cnpj"><strong>CPF:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" value="{{ old('cell') ?? $users->cpf_cnpj ?? "" }}" disabled>
                </div>
            </div>

            <div class="col-sm-12 col-md col-lg col-xl">
                <label for="rg" id="label_rg"><strong>RG:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="rg" name="rg" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" {{ old('cell') ?? $users->rg ?? "" }}>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md col-lg col-xl">
                <label for="prontuario" id="label_prontuario"><strong>Prontuário:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="prontuario" name="prontuario" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" value="{{ $emergency_services->IdEmergencyServices ?? "" }}" disabled>
                </div>
            </div>

            <div class="col-sm-12 col-md col-lg col-xl">
                <label for="CNS" id="label_CNS"><strong>CNS:</strong></label>
                <div class="input-group mb-2">
                    <input type="text" id="CNS" name="CNS" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>

            <div class="col-sm-12 col-md col-lg col-xl">
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

            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="cell_fields" class="form-group">
                    <label for="cell" id="label_cell">Celular:</label>
                    <input type="text" id="cell" name="cell" class="form-control form-control-sm @error('cell') is-invalid @enderror" value="{{ old('cell') ?? $users->cell ?? "" }}">
                    <div class="valid-feedback">sucesso!</div>
                    <div class="invalid-feedback">Celular obrigatório!</div>
                </div>
            </div>
        </div>

        <!-- endereço -->
        <label class="mt-3"><strong>Endereço</strong></label>
        <hr class="mt-0">

        <div class="row">
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
        </div>

        <!-- Vínculo com a Previdência -->
        <label class="mt-4"><strong>Vínculo com a Previdência</strong></label>
        <hr class="mt-0">

        <div class="row mt-0">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label for="condition" id="label_condition"></label><br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="social_security" name="social_security" value="emp"/>
                        <label class="form-check-label" for="social_security">Empregado</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="social_security" name="social_security" value="aut"/>
                        <label class="form-check-label" for="social_security">Autônomo</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="social_security" name="social_security" value="des"/>
                        <label class="form-check-label" for="social_security">Desempregado</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="social_security" name="social_security" value="apo"/>
                        <label class="form-check-label" for="social_security">Aposentado</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="social_security" name="social_security" value="not_sec"/>
                        <label class="form-check-label" for="social_security">Não Segurado</label>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
