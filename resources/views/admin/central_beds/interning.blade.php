
@csrf <!--token-->

<div class="card mb-3 border h-100 border-primary">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-12 align-self-center">
                <h5>
                    <h6 class="alert-heading fw-semi-bold">
                        <span class="mt-1"> 
                            {{ $rooms_beds->rooms }} • {{ $rooms_beds->title }} {{  "• {$rooms_beds->note}" ?? "" }}
                        </span> 
                    </h6>
            
                    <h6 class="alert-heading fw-semi-bold">
                        <span class="h6 alert-heading fw-semi-bold"><strong>Acomodação:</strong> {{ $rooms_beds->accommodations}}</span><br>
                    </h6>

                    <h6 class="alert-heading fw-semi-bold">
                        <span class="h6 alert-heading fw-semi-bold"><strong>Sexo Determinante:</strong> 
                            @if($rooms_beds->determining_sex == "m")
                                MASCULINO
                            @elseif($rooms_beds->determining_sex == "f")
                                FEMININO
                            @else
                                INDIFERENTE
                            @endif
                        </span> 
                    </h6>
                </h5>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Pacientes</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">

        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div id="cpf_cnpj_filter_fields" class="form-group">
                    <label for="cpf_cnpj_filter" id="label_cpf_cnpj_filter">CPF FILTRO:</label>
                    <input type="text" id="cpf_cnpj_filter" name="cpf_cnpj_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>
        
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div id="name_patient_filter_fields" class="form-group">
                    <label for="name_patient_filter" id="label_name_patient_filter">NOME FILTRO:</label>
                    <input type="text" id="name_patient_filter" name="name_patient_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>
        
            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="IdUsers_fields" class="form-group">
                    <label for="IdUsers" id="label_IdUsers">Pacientes</label>
                    <select id="IdUsers" name="IdUsers" class="form-control form-control-sm @error('IdUsers') is-invalid @enderror" url-query="{{ route('users.query.responsavel.json') }}">
                        <option value="">...</option>
                    </select>
                </div>              
            </div>
        </div>

        <!-- pacientes -->
        <div class="card mt-3 border h-100 border-primary hide" id="data-users"></div>

        <!-- solicitação -->
        <div class="hide" id="admission_request" url-query="{{ route('approve_admissions.json') }}"></div>
    </div>
</div>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Solicitação de Internação</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="note_fields" class="form-group">
                    <label class="form-label" for="note_label"></label>
                    <textarea class="form-control form-control-sm" id="note" name="note" rows="3" placeholder="Observação"></textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

    </div>
</div>

<input id="IdAdmitPatientRequests" name="IdAdmitPatientRequests" class="hide" value=""/>
<script src="{{ asset('admin/js/modules/central_beds.js') }}"></script>
