@csrf <!--token-->

<div class="row">

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="type_forward_internal_fields" class="form-group">
            <label for="type_forward_internal" id="label_type_forward_internal" class="label_type_forward_internal">Tipo:</label>
            <select name="type_forward_internal" class="form-control @error('type_forward_internal') is-invalid @enderror">
                <option value="c" @if((old('type_forward_internal') == "c") OR (!empty($emergency_services_forward_internal) AND ($emergency_services_forward_internal->type == "c")))selected @endif>Consulta</option>
                <option value="r" @if((old('type_forward_internal') == "r") OR (!empty($emergency_services_forward_internal) AND ($emergency_services_forward_internal->type == "r")))selected @endif>Reavaliação</option>
            </select>
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdMedicalSpecialties_fields" class="form-group">
            <label for="IdMedicalSpecialties" id="label_IdMedicalSpecialties" class="label_IdMedicalSpecialties">Especialidades:</label>
            <select name="IdMedicalSpecialties" class="form-control @error('IdMedicalSpecialties') is-invalid @enderror" required>
                <option value="">...</option>
                @if(!empty($medical_specialties))
                    @foreach($medical_specialties as $val)
                        <option value="{{ $val->IdMedicalSpecialties }}" @if(old('IdMedicalSpecialties') == $val->IdMedicalSpecialties OR (!empty($emergency_services_forward_internal) AND ($val->IdMedicalSpecialties == $emergency_services_forward_internal->IdMedicalSpecialties)))selected @endif><strong>{{$val->code}}</strong> • {{$val->title}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="note_forward_internal_fields" class="form-group">
            <label class="form-label" for="note_forward_internal_label">Motivo</label>
            <textarea class="form-control @error('note_forward_internal') is-invalid @enderror" id="note_forward_internal" name="note_forward_internal" rows="3">{{ $emergency_services_forward_internal->note ?? "" }}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>