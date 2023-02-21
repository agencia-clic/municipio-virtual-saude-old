
@csrf <!--token-->

<div class="row mt-1">
    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div id="title_materials_filter_fields" class="form-group">
            <label for="title_materials_filter" id="label_title_materials_filter">Título FILTRO:</label>
            <input type="text" id="title_materials_filter" name="title_materials_filter" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdMaterials_fields" class="form-group">
            <label for="IdMaterials" id="label_IdMaterials">Materiais:</label>
            <select id="IdMaterials" name="IdMaterials" class="form-control form-control-sm @error('IdMaterials') is-invalid @enderror" url-query="{{ route('materials.json') }}">
                <option value="{{  $emergency_services_materials->IdMaterials ?? "" }}">...</option>
            </select>
        </div>              
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="amount_fields" class="form-group">
            <label for="amount" id="label_amount">Quantidade:</label>
            <input type="text" id="amount" name="amount" class="form-control form-control-sm @error('amount') is-invalid @enderror" value="{{ $emergency_services_materials->amount ?? "0" }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="note_fields" class="form-group">
            <label class="form-label" for="note_label">Observação</label>
            <textarea class="form-control form-control-sm @error('note') is-invalid @enderror" id="note" name="note" rows="3" required>{{old('note') ?? $emergency_services_materials->note ?? ""}}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#amount').mask("#.##0,00", {reverse: true});
    })
</script>

<script src="{{ asset('admin/js/modules/emergency_services_materials.js') }}" type="text/javascript"></script>