
@csrf <!--token--> 

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="IdMedicalSpecialties_fields" class="form-group">
            <label for="IdMedicalSpecialties" id="label_IdMedicalSpecialties" class="label_IdMedicalSpecialties">Especialidades:</label>
            <select name="IdMedicalSpecialties" class="form-control form-control-sm @error('IdMedicalSpecialties') is-invalid @enderror" required>
                <option value="">...</option>
                @if(!empty($medical_specialties))
                    @foreach($medical_specialties as $val)
                        <option value="{{ $val->IdMedicalSpecialties }}" @if(old('IdMedicalSpecialties') == $val->IdMedicalSpecialties OR (!empty($users_medical_specialties) AND ($val->IdMedicalSpecialties == $users_medical_specialties->IdMedicalSpecialties)))selected @endif><strong>{{$val->code}}</strong> • {{$val->title}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
