
@csrf <!--token--> 

<div class="row">
    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div id="code_procedures_filter_fields" class="form-group">
            <label for="code_procedures_filter" id="label_code_procedures_filter">Código FILTRO:</label>
            <input type="text" id="code_procedures_filter" code_procedures_filter="code_procedures_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div id="title_procedures_filter_fields" class="form-group">
            <label for="title_procedures_filter" id="label_title_procedures_filter">Procedimento FILTRO:</label>
            <input type="text" id="title_procedures_filter" name="title_procedures_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdProcedures_fields" class="form-group">
            <label for="IdProcedures" id="label_IdProcedures">Procedimento</label>
            <select id="IdProcedures" name="IdProcedures" class="form-control  @error('IdProcedures') is-invalid @enderror" url-query="{{ route('procedures.form.json') }}">
                <option value="{{old('IdProcedures') ?? $emergency_services_procedures->IdProcedures ?? ""}}">...</option>
            </select>
        </div>              
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="note_fields" class="form-group">
            <label class="form-label" for="note_label">Observação</label>
            <textarea class="form-control form-control-sm @error('note') is-invalid @enderror" id="note" name="note" rows="3" required>{{old('note') ?? $emergency_services_procedures->note ?? ""}}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>
