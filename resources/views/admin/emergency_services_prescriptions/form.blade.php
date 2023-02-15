@csrf <!--token-->

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <label for="title_medication_prescription_filter" id="label_title_medication_prescription_filter"><strong>Título FILTRO:</strong></label>
        <div class="input-group mb-2">
            <button class="btn btn-primary input-group-text button-medication-save" type="button" url="{{ route('medication_prescription.save') }}"><span class="fas fa-edit"></span></button>
            <input type="text" id="title_medication_prescription_filter" name="title_medication_prescription_filter" class="form-control" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdMedicationPrescription_fields" class="form-group">
            <label for="IdMedicationPrescription" id="label_IdMedicationPrescription">Medicamento</label>
            <select id="IdMedicationPrescription" name="IdMedicationPrescription" class="form-control @error('IdMedicationPrescription') is-invalid @enderror" url-query="{{ route('medication_prescription') }}">
                <option value="{{ $emergency_services_forward->IdMedicationPrescriptions ?? "" }}">...</option>
            </select>
        </div>              
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="amount_fields" class="form-group">
            <label for="amount" id="label_amount">Quantidade:</label>
            <input type="number" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{old('amount') ?? $emergency_services_forward->amount ?? ""}}" required>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div id="title_medication_units_filter_fields" class="form-group">
            <label for="title_medication_units_filter" id="label_title_medication_units_filter">Título FILTRO:</label>
            <input type="text" id="title_medication_units_filter" name="title_medication_units_filter" class="form-control" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdMedicationUnits_fields" class="form-group">
            <label for="IdMedicationUnits" id="label_IdMedicationUnits">Unidade Medida</label>
            <select id="IdMedicationUnits" name="IdMedicationUnits" class="form-control @error('IdMedicationUnits') is-invalid @enderror" url-query="{{ route('medication_units.json') }}">
                <option value="{{ $emergency_services_forward->IdMedicationUnits ?? "" }}">...</option>
            </select>
        </div>              
    </div>
</div>

<div class="row mt-1">

    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div id="title_medication_administrations_filter_fields" class="form-group">
            <label for="title_medication_administrations_filter" id="label_title_medication_administrations_filter">Título FILTRO:</label>
            <input type="text" id="title_medication_administrations_filter" name="title_medication_administrations_filter" class="form-control" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdMedicationAdministrations_fields" class="form-group">
            <label for="IdMedicationAdministrations" id="label_IdMedicationAdministrations">Via de Administração</label>
            <select id="IdMedicationAdministrations" name="IdMedicationAdministrations" class="form-control @error('IdMedicationAdministrations') is-invalid @enderror" url-query="{{ route('medication_administration.json') }}">
                <option value="{{ $emergency_services_forward->IdMedicationAdministrations ?? "" }}">...</option>
            </select>
        </div>              
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="type_medication_fields" class="form-group">
            <label for="type_medication" id="label_type_medication" class="label_type_medication">Tipo:</label>
            <select name="type_medication" class="form-control @error('type_medication') is-invalid @enderror">
                <option value="n" @if((!empty($emergency_services_forward)) AND ($emergency_services_forward->type == "n")) selected @endif>Normal</option>
                <option value="t" @if((!empty($emergency_services_forward)) AND ($emergency_services_forward->type == "t")) selected @endif>Continuo</option>
                <option value="c" @if((!empty($emergency_services_forward)) AND ($emergency_services_forward->type == "c")) selected @endif>Controlado</option>
            </select>
        </div>
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="note_prescription_fields" class="form-group">
            <label class="form-label" for="note_prescription_label">Observação</label>
            <textarea class="form-control @error('note_prescription') is-invalid @enderror" id="note_prescription" name="note_prescription" rows="3">{{ $emergency_services_forward->note ?? "" }}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/modules/medication-prescription.js') }}" type="text/javascript"></script>