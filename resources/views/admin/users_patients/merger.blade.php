<div class="card-header border border-primary" bis_skin_checked="1">
    <div class="row flex-between-end" bis_skin_checked="1">
        <div class="col-12 align-self-center" bis_skin_checked="1">
            </h5>
                <span class="mt-1">
                    <strong>{{ $users->name }}</strong>
                </span> 
            </h5>
        </div>
    </div>
</div>

<div class="card mb-3 mt-2">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Responsável</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">

        <div class="row">		
            <div class="col-sm-3 col-md-3 col-lg-2 col-xl-3">
                <div id="user_letter_fields" class="form-group">
                    <label for="user_letter" id="label_user_letter">FILTRO: Letra:</label>
                    <select id="user_letter" name="user_letter" class="form-control form-control-sm">
                        <option value="">...</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                        <option value="L">L</option>
                        <option value="M">M</option>
                        <option value="N">N</option>
                        <option value="O">O</option>
                        <option value="P">P</option>
                        <option value="Q">Q</option>
                        <option value="R">R</option>
                        <option value="S">S</option>
                        <option value="T">T</option>
                        <option value="U">U</option>
                        <option value="V">V</option>
                        <option value="W">W</option>
                        <option value="X">X</option>
                        <option value="Y">Y</option>
                        <option value="Z">Z</option>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-9 col-md-9 col-lg-5 col-xl-3">
                <div id="user_name_fields" class="form-group">
                    <label for="user_name" id="label_user_name">FILTRO: Nome:</label>
                    <input type="text" id="user_name" name="user_name" class="form-control form-control-sm" maxlength="50" autocomplete="off">    
                </div>
            </div>
            
            <div class="col-sm-9 col-md-3 col-lg-3 col-xl-3">
                <div id="user_cpf_cnpj_fields" class="form-group">
                    <label for="user_cpf_cnpj" id="label_user_cpf_cnpj">FILTRO: CPF/CNPJ:</label>
                    <input type="text" id="user_cpf_cnpj" name="user_cpf_cnpj" class="form-control form-control-sm" maxlength="14" autocomplete="off">    
                </div>
            </div>

            <div class="col-sm-9 col-md-3 col-lg-3 col-xl-3">
                <div id="user_phone_fields" class="form-group">
                    <label for="user_phone" id="label_user_phone">FILTRO: Telefone:</label>
                    <input type="text" id="user_phone" name="user_phone" class="form-control form-control-sm" maxlength="15" autocomplete="off">    
                </div>
            </div>
            
            <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2">
                <div id="user_button_fields" class="form-group mt-2">
                    <label for="user_button" id="label_user_button"></label>
                    <button type="button" class="form-control btn btn-outline-secondary btn-sm">Adicionar</button>
                </div>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2">
                <div id="user_button_fields" class="form-group mt-2">
                    <label for="user_button" id="label_user_button"></label>
                    <button type="button" class="form-control btn btn-outline-secondary btn-sm" url="{{ route('users.form.query') }}" data-id="{{old('IdUsers') ?? $service_units->IdUsers ?? ""}}" query-fields="user_letter,user_name,user_cpf_cnpj,user_phone" select="IdUsers">Buscar</button>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                <div id="IdUsers_fields" class="form-group">
                    <label for="IdUsers" id="label_IdUsers">Contribuinte</label>
                    <select id="IdUsers" name="IdUsers" class="form-control form-control-sm @error('IdUsers') is-invalid @enderror" required>
                        <option value="">...</option>
                    </select>
                </div>              
            </div>
        </div>

    </div>
</div>

<div class="card mb-3 mt-2 hide" id="check_users">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Checks</h5>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">

        <ul class="list-group" id="">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Luiz Fernando Goulart</strong>
                <span class="rounded-pill">
                    <a class="dropdown-item fw-bold" href="#!" action="delete">
                    <span class="fas fa-trash-alt me-1"></span><span></span></a>
                </span>
            </li>
        </ul>

    </div>
</div>

<script src="{{ asset('admin/js/query-fields.js') }}"></script>
<script src="{{ asset('admin/js/modules/users_patients.js') }}" type="text/javascript"></script>