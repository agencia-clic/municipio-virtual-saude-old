@csrf <!--token--> 

<!-- content - start -->
<div class="card mb-3 card-content">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Conteúdo</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">

        <div class="row mt-1">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="temperature_fields" class="form-group">
                    <label for="temperature" id="label_temperature">Temperatura:</label>
                    <input type="text" id="temperature" name="temperature" class="form-control  @error('temperature') is-invalid @enderror" value="{{old('temperature') ?? $emergency_services_vital_data->temperature ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="weight_fields" class="form-group">
                    <label for="weight" id="label_weight">Peso:</label>
                    <input type="text" id="weight" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{old('weight') ?? $emergency_services_vital_data->weight ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="heart_rate_fields" class="form-group">
                    <label for="heart_rate" id="label_heart_rate">Frequência Cardíaca (BPM):</label>
                    <input type="text" id="heart_rate" name="heart_rate" class="form-control @error('heart_rate') is-invalid @enderror" value="{{old('heart_rate') ?? $emergency_services_vital_data->heart_rate ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="height_fields" class="form-group">
                    <label for="height" id="label_height">Altura:</label>
                    <input type="text" id="height" name="height" class="form-control @error('height') is-invalid @enderror" value="{{old('height') ?? $emergency_services_vital_data->height ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="respiratory_frequency_fields" class="form-group">
                    <label for="respiratory_frequency" id="label_respiratory_frequency">Frequência Respiratória (RPM):</label>
                    <input type="text" id="respiratory_frequency" name="respiratory_frequency" class="form-control @error('respiratory_frequency') is-invalid @enderror" value="{{old('respiratory_frequency') ?? $emergency_services_vital_data->respiratory_frequency ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="O2_saturation_fields" class="form-group">
                    <label for="O2_saturation" id="label_O2_saturation">Saturação O²:</label>
                    <input type="text" id="O2_saturation" name="O2_saturation" class="form-control @error('O2_saturation') is-invalid @enderror" value="{{old('O2_saturation') ?? $emergency_services_vital_data->O2_saturation ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="blood_pressure_fields" class="form-group">
                    <label for="blood_pressure" id="label_blood_pressure">Pressão Arterial (MM/HG):</label>
                    <input type="text" id="blood_pressure" name="blood_pressure" class="form-control @error('blood_pressure') is-invalid @enderror" value="{{old('blood_pressure') ?? $emergency_services_vital_data->blood_pressure ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="ecg_fields" class="form-group">
                    <label for="ecg" id="label_ecg">ECG:</label>
                    <input type="text" id="ecg" name="ecg" class="form-control @error('ecg') is-invalid @enderror" value="{{old('ecg') ?? $emergency_services_vital_data->ecg ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="blood_glucose_fields" class="form-group">
                    <label for="blood_glucose" id="label_blood_glucose">Glicemia:</label>
                    <input type="text" id="blood_glucose" name="blood_glucose" class="form-control @error('blood_glucose') is-invalid @enderror" value="{{old('blood_glucose') ?? $emergency_services_vital_data->blood_glucose ?? ""}}" @if(!empty($emergency_services_vital_data)) disabled @endif>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="rule_of_pain_fields" class="form-group">
                    <label for="rule_of_pain" id="label_rule_of_pain"></label>
                    <label class="form-label" for="rule_of_pain">Régua da Dor: <span>{{old('rule_of_pain') ?? $emergency_services_vital_data->rule_of_pain ?? "0"}}</span></label>
                    <input class="form-range" id="rule_of_pain" name="rule_of_pain" class="form-control @error('rule_of_pain') is-invalid @enderror" value="{{old('rule_of_pain') ?? $emergency_services_vital_data->rule_of_pain ?? "0"}}" type="range" min="0" max="10" @if(!empty($emergency_services_vital_data)) disabled @endif/>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('admin/js/price_format.js') }}"></script>
<script src="{{ asset('admin/js/modules/screenings.js') }}" type="text/javascript"></script>