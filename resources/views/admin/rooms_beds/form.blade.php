
@csrf <!--token--> 

<div class="row">

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="title_fields" class="form-group">
            <label for="title" id="label_title">Título:</label>
            <input type="text" id="title" name="title" class="form-control form-control-sm @error('title') is-invalid @enderror" value="{{old('title') ?? $rooms_beds->title ?? ""}}" required>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="code_fields" class="form-group">
            <label for="code" id="label_code">Código:</label>
            <input type="text" id="code" name="code" class="form-control form-control-sm @error('code') is-invalid @enderror" value="{{old('code') ?? $rooms_beds->code ?? ""}}">
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>

</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="note_fields" class="form-group">
            <label class="form-label" for="note_label">Observação</label>
            <textarea class="form-control form-control-sm @error('note') is-invalid @enderror" id="note" name="note" rows="3" required>{{old('note') ?? $rooms_beds->note ?? ""}}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>