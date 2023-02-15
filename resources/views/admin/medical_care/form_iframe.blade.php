
@csrf <!--token-->

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="anamnesis_fields" class="form-group">
            <label class="form-label" for="anamnesis_label">Descreva</label>
            <textarea class="form-control @error('anamnesis') is-invalid @enderror" id="anamnesis" name="anamnesis" rows="3" required>{{old('anamnesis') ?? $medical_care->anamnesis ?? ""}}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>