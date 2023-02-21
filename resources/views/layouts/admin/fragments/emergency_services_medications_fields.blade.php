<div class="row">
    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div id="title_medicines_filter_fields" class="form-group">
            <label for="title_medicines_filter" id="label_title_medicines_filter">Medicamento FILTRO:</label>
            <input type="text" id="title_medicines_filter" name="title_medicines_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdMedicines_fields" class="form-group">
            <label for="IdMedicines" id="label_IdMedicines">Medicamentos</label>
            <select id="IdMedicines" name="IdMedicines" class="form-control  @error('IdMedicines') is-invalid @enderror" url-query="{{ route('medicines.query.json') }}" data-select="{{ route('medicines.selected', ['IdUsers' => base64_encode($emergency_services->IdUsers)]) }}">
                <option value="">...</option>
            </select>
        </div>              
    </div>
</div>

<!-- campos medicação -->
<div id="medication_fields" class="hide">

    <div class="alert alert-danger mt-4 hide" id="users_diseases" role="alert"></div>
    
    <div class="row mt-1">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div id="prescription_guidance_fields" class="form-group">
                <label class="form-label" for="prescription_guidance_label">Orientação</label>
                <textarea class="form-control form-control-sm @error('prescription_guidance') is-invalid @enderror" id="prescription_guidance" name="prescription_guidance" rows="5" required></textarea>
                <div class="valid-feedback">sucesso!</div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12 col-md col-lg col-xl">
            <div class="form-group">
                <label for="type" id="label_type"><strong>Frequência da dose:</strong></label><br/>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="type_prescription_only" name="type_prescription" value="u" checked/>
                    <label class="form-check-label" for="type_prescription_only">Dose única</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="type_prescription_break" name="type_prescription" value="i"/>
                    <label class="form-check-label" for="type_prescription_break">Intervalo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="type_prescription_frequency" name="type_prescription" value="f"/>
                    <label class="form-check-label" for="type_prescription_frequency">Frequência</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">

        <div class="col-sm-12 col-md col-lg col-xl hide" id="number_time_day_fields">
            <div class="form-group">
                <label for="number_time_day" id="label_number_time_day">Número de vezes ao Dia:</label>
                <input type="number" id="number_time_day" name="number_time_day" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
            </div>
        </div>

        <div class="col-sm-12 col-md col-lg col-xl hide" id="brack_prescription_fields">
            <div class="form-group">
                <label for="brack_prescription" id="label_brack_prescription">Intervalo:</label>
                <input type="text" id="brack_prescription" name="brack_prescription" class="form-control datetimepicker" oninput="this.value = this.value.toUpperCase()" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true, "time_24hr": true}'>
            </div>
        </div>

        <div class="col-sm-12 col-md col-lg col-xl hide" id="IdMedicationAdministrations_fields">
            <div class="form-group">
                <label for="IdMedicationAdministrations" id="label_IdMedicationAdministrations" class="label_IdMedicationAdministrations">Via de Administração:</label>
                <select id="IdMedicationAdministrations" name="IdMedicationAdministrations" class="form-control form-control-sm">
                    <option value="">...</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md col-lg col-xl">
            <div id="infusao_fields" class="form-group">
                <label for="infusao" id="label_infusao">Infusão:</label>
                <input type="text" id="infusao" name="infusao" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12 col-md col-lg col-xl hide" id="IdMedicationDilutions_fields">
            <div class="form-group">
                <label for="IdMedicationDilutions" id="label_IdMedicationDilutions" class="label_IdMedicationDilutions">Diluição:</label>
                <select id="IdMedicationDilutions" name="IdMedicationDilutions" class="form-control form-control-sm">
                    <option value="">...</option>
                </select>
            </div>
        </div>
        
        <div class="col-sm-12 col-md col-lg col-xl">
            <div id="amount_prescription_fields" class="form-group">
                <label for="amount_prescription" id="label_amount_prescription">Quantidade:</label>
                <input type="text" id="amount_prescription" name="amount_prescription" class="form-control form-control-sm" placeholder="00.0">
            </div>
        </div>

        <div class="col-sm-12 col-md col-lg col-xl">
            <div id="un_measure_fields" class="form-group">
                <label for="un_measure" id="label_un_measure">Un. Medida:</label>
                <input type="text" id="un_measure" name="un_measure" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
            </div>
        </div>
    </div>
</div>