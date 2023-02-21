
@csrf <!--token--> 

@if(app('request')->input('type') == "a")

<div class="row">
    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="type_allergies_fields" class="form-group">
            <label for="type_allergies" id="label_type_allergies" class="label_type_allergies">Tipo:</label>
            <select name="type_allergies" id="type_allergies" class="form-control form-control-sm @error('type_allergies') is-invalid @enderror" required>
                <option value="m" @if(old('type_allergies') == 'm') selected @endif>Medicamento</option>
                <option value="o" @if(old('type_allergies') == 'o') selected @endif>Outros</option>
            </select>
        </div>
    </div>
</div>

<div class="row mt-1 hide medication_prescriptions-allergies">
    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div id="title_medication_prescriptions_filter_fields" class="form-group">
            <label for="title_medication_prescriptions_filter" id="label_title_medication_prescriptions_filter">Título FILTRO:</label>
            <input type="text" id="title_medication_prescriptions_filter" name="title_medication_prescriptions_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdMedicationActivePrinciples_fields" class="form-group">
            <label for="IdMedicationActivePrinciples" id="label_IdMedicationActivePrinciples">Princípio Ativo Medicamento:</label>
            <select id="IdMedicationActivePrinciples" name="IdMedicationActivePrinciples" class="form-control form-control-sm @error('IdMedicationActivePrinciples') is-invalid @enderror" url-query="{{ route('users_diseases.query.json', ['IdUsers' => $IdUsers]) }}">
                <option value="">...</option>
            </select>
        </div>              
    </div>
</div>
@else
<input type="hidden" name="type_allergies" value="o"/>
@endif

<div class="row hide text-allergies">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="text_fields" class="form-group">
            <label class="form-label" for="text_label">Descreva</label>
            <textarea class="form-control form-control-sm @error('text') is-invalid @enderror" id="text" name="text" rows="3" required>{{old('text') ?? $users_diseases->text ?? ""}}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/modules/users_diseases.js') }}" type="text/javascript"></script>
