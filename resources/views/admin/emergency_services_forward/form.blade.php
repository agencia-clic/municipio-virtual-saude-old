@csrf <!--token-->

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <label for="title_procedures_filter" id="label_title_procedures_filter"><strong>Nome FILTRO:</strong></label>
        <div class="input-group mb-2">
            <input type="text" id="title_procedures_filter" name="title_procedures_filter" class="form-control" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdProceduresForward_fields" class="form-group">
            <label for="IdProceduresForward" id="label_IdProceduresForward">Procedimento</label>
            <select id="IdProceduresForward" name="IdProceduresForward" class="form-control @error('IdProceduresForward') is-invalid @enderror" url-query="{{ route('procedures.form.json') }}">
                <option value="{{ $emergency_services_forward->IdProcedures ?? "1133" }}">...</option>
            </select>
        </div>              
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <label for="title_categories_filter" id="label_title_categories_filter"><strong>Nome FILTRO:</strong></label>
        <div class="input-group mb-2">
            <input type="text" id="title_categories_filter" name="title_categories_filter" class="form-control" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdSpecialtyCategories_fields" class="form-group">
            <label for="IdSpecialtyCategories" id="label_IdSpecialtyCategories">Especialidade/Categoria</label>
            <select id="IdSpecialtyCategories" name="IdSpecialtyCategories" class="form-control @error('IdSpecialtyCategories') is-invalid @enderror" url-query="{{ route('specialty_categories.json') }}">
                <option value="{{ $emergency_services_forward->IdSpecialtyCategories ?? "" }}">...</option>
            </select>
        </div>              
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="note_forward_fields" class="form-group">
            <label class="form-label" for="note_forward_label">Motivo</label>
            <textarea class="form-control @error('note_forward') is-invalid @enderror" id="note_forward" name="note_forward" rows="3">{{ $emergency_services_forward->note ?? "" }}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/modules/medication-forward.js') }}" type="text/javascript"></script>