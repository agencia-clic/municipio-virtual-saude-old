<!-- recepção -->
@if(!empty($emergency_services->note))
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center" style="margin-top:5px;">
                <h5 class="mb-0">Recepção</h5>
            </div>
        </div>
    </div>

    <div class="card-body" style="margin-top:-20px">
        <span class="common-label" style="font-size: 14px">{{ $emergency_services->note }}</span>
    </div>
</div>
@endif

<!-- acolhimentos -->
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Acolhimentos</h5>
            </div>
        </div>
    </div>

    <div class="card-body bg-light" style="margin-top:-20px">

        <!-- screenings - start -->
        <div class="col-12 mb-sm-0">
            <div class="list-group">

                @if(!empty($screenings = $emergency_services->screenings()))

                    @foreach($screenings as $index => $val)

                        <a class="list-group-item list-group-item-action  
                        @if($val->classification == 4){
                            emergency
                        @elseif($val->classification == 3)
                            very_urgent
                        @elseif($val->classification == 2)
                            urgent
                        @elseif($val->classification == 1)
                            little_urgent
                        @elseif($val->classification == 0)
                            not_urgent
                        @else
                            bg-500
                        @endif
                        text-white" data-bs-toggle="collapse" data-bs-target="#collapse{{$val->IdScreenings}}" aria-expanded="true" aria-controls="collapse{{$val->IdScreenings}}" style="font-size: 12px; padding-top:5px; padding-bottom:5px" href="#">
                            <span class="far fa-arrow-alt-circle-down"></span> Triagem • {{date('d-m-Y H:i', strtotime($val->created_at))}} •
                            @if($val->classification == 4)
                                <strong>Emergência</strong>
                            @elseif($val->classification == 3)
                                <strong>Muito Urgente</strong>
                            @elseif($val->classification == 2)
                                <strong>Urgente</strong>
                            @elseif($val->classification == 1)
                                <strong>Pouco Urgente</strong>
                            @elseif($val->classification == 0)
                                <strong>Não Urgente</strong>
                            @endif • <strong>{{ $val->responsible }}</strong>
                        </a>
                        
                        <div class="accordion-collapse collapse" id="collapse{{$val->IdScreenings}}" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                            <div class="list-group-item list-group-item-action">

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Pressão Arterial (mmHg): </strong></span>
                                        <td class="text-secondary">{{$val->blood_pressure?? "-"}}</td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Peso (Kg): </strong></span>
                                        <td class="text-secondary">{{$val->weight?? "-"}}</td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"> <strong> Temperatura (°C): </strong></span>
                                        <td class="text-secondary">{{$val->temperature?? "-"}}</td>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"> <strong> Altura: </strong> </span>
                                        <td class="text-secondary">{{$val->height ?? "-"}}</td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"> <strong> Frequência Respiratória (rpm): </strong></span>
                                        <td class="text-secondary">{{$val->respiratory_frequency ?? "-"}}</td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Frequência Cardíaca (bpm): </strong></span>
                                        <td class="text-secondary">{{$val->heart_rate ?? "-"}}</td>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Saturação O<sub>2</sub>: </strong></span>
                                        <td class="text-secondary">{{$val->O2_saturation ?? "-"}}</td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> ECG: </strong></span>
                                        <td class="text-secondary">{{$val->ecg ?? "-"}}</td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Glicemia (mg/dl): </strong></span>
                                        <td class="text-secondary">{{$val->blood_glucose ?? "-"}}</td>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Régua da Dor:</strong></span>
                                        <td class="text-white">
                                            @if($val->rule_of_pain == 1)
                                                <span class="badge pain_one">1</span>
                                            @elseif($val->rule_of_pain == 2)
                                                <span class="badge pain_two">2</span>
                                            @elseif($val->rule_of_pain == 3)
                                                <span class="badge pain_three">3</span>
                                            @elseif($val->rule_of_pain == 4)
                                                <span class="badge pain_four">4</span>
                                            @elseif($val->rule_of_pain == 5)
                                                <span class="badge pain_five">5</span>
                                            @elseif($val->rule_of_pain == 6)
                                                <span class="badge pain_six">6</span>
                                            @elseif($val->rule_of_pain == 7){
                                                <span class="badge pain_seven">7</span>
                                            @elseif($val->rule_of_pain == 8)
                                                <span class="badge pain_eight">8</span>
                                            @elseif($val->rule_of_pain == 9)
                                                <span class="badge pain_nine">9</span>
                                            @elseif($val->rule_of_pain == 10)
                                                <span class="badge pain_ten">10</span>
                                            @endif
                                            </td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Diabético: </strong></span>
                                        <td class="text-secondary">{{$val->condition_diabetic ? "SIM" : "NÃO"}}</td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Cardiopata: </strong></span>
                                        <td class="text-secondary">{{$val->condition_diabetic ? "SIM" : "NÃO"}}</td>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Hipertenso: </strong></span>
                                        <td class="text-secondary">{{$val->condition_hypertensive ? "SIM" : "NÃO"}}</td>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Gestante: </strong></span>
                                        <td class="text-secondary">{{$val->condition_pregnant ? "SIM" : "NÃO"}}</td>
                                    </div>

                                    @if(!empty($val->gestational_age))
                                        <div class="col-sm col-md col-lg no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                            <span class="common-label"><strong> Idade Gestacional:</strong></span>
                                            <td class="text-secondary">{{$val->gestational_age ?? "-"}}</td>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-12 col-lg-12 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Discriminador: </strong></span>
                                        <td class="text-secondary">{{$val->discriminator ?? "-"}}</td>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Fluxograma: </strong></span>
                                        <td class="text-secondary">{{$val->flowchart ?? "-"}}</td>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-12 col-lg-12 no-margin" style="margin-top:5px; margin-bottom:10px; font-size:14px;">
                                        <span class="common-label"><strong> Queixas: </strong></span>
                                        <td class="text-secondary">{{$val->complaints ?? "-"}}</td>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</div>

<!-- medical care -->
@if(!empty($medical_care = $emergency_services->medical_care()))
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center" style="margin-top:5px;">
                <h5 class="mb-0">Atendimentos médicos</h5>
            </div>
        </div>
    </div>

    <div class="card-body" style="margin-top:-20px">
        
        @foreach($medical_care as $index => $val)

            <a class="list-group-item list-group-item-action not_urgent text-white" data-bs-toggle="collapse" data-bs-target="#collapse_medical_care{{$val->IdMedicalCare}}" aria-expanded="true" aria-controls="collapse_medical_care{{$val->IdScreenings}}" style="font-size: 12px; padding-top:5px; padding-bottom:5px" href="#">
                <span class="far fa-arrow-alt-circle-down"></span> 
                <strong>{{ $val->responsible }} Medico clinico</strong> • {{date('d-m-Y H:i', strtotime($val->created_at))}}
            </a>

            <div class="accordion-collapse collapse" id="collapse_medical_care{{$val->IdMedicalCare}}" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="list-group-item list-group-item-action">

                    teste

                </div>
            </div>

        @endforeach

    </div>
</div>
@endif
