<!-- acolhimentos -->
@if(!empty($emergency_services->note))
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Recepção</h5>
            </div>
        </div>
    </div>

    <div class="card-body">
        <span class="common-label"><strong>{{ $emergency_services->note }}</strong></span>
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

    <div class="card-body bg-light">

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
                        text-white" data-bs-toggle="collapse" data-bs-target="#collapse{{$val->IdScreenings}}" aria-expanded="true" aria-controls="collapse{{$val->IdScreenings}}" href="#">
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
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Pressão Arterial (mmHg)</span>
                                        <div class="text-secondary">{{$val->blood_pressure?? "-"}}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Peso (Kg)</span>
                                        <div class="text-secondary">{{$val->weight?? "-"}}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Temperatura (°C)</span>
                                        <div class="text-secondary">{{$val->temperature?? "-"}}</div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Altura</span>
                                        <div class="text-secondary">{{$val->height ?? "-"}}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Frequência Respiratória (rpm)</span>
                                        <div class="text-secondary">{{$val->respiratory_frequency ?? "-"}}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Frequência Cardíaca (bpm)</span>
                                        <div class="text-secondary">{{$val->heart_rate ?? "-"}}</div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Saturação O<sub>2</sub></span>
                                        <div class="text-secondary">{{$val->O2_saturation ?? "-"}}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">ECG</span>
                                        <div class="text-secondary">{{$val->ecg ?? "-"}}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Glicemia (mg/dl)</span>
                                        <div class="text-secondary">{{$val->blood_glucose ?? "-"}}</div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Régua da Dor</span>
                                        <div class="text-white">
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
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Diabético</span>
                                        <div class="text-secondary">{{$val->condition_diabetic ? "SIM" : "NÃO"}}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Cardiopata</span>
                                        <div class="text-secondary">{{$val->condition_diabetic ? "SIM" : "NÃO"}}</div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Hipertenso</span>
                                        <div class="text-secondary">{{$val->condition_hypertensive ? "SIM" : "NÃO"}}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                        <span class="common-label">Gestante</span>
                                        <div class="text-secondary">{{$val->condition_pregnant ? "SIM" : "NÃO"}}</div>
                                    </div>

                                    @if(!empty($val->gestational_age))
                                        <div class="col-sm col-md col-lg no-margin">
                                            <span class="common-label">Idade Gestacional</span>
                                            <div class="text-secondary">{{$val->gestational_age ?? "-"}}</div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-12 col-lg-12 no-margin">
                                        <span class="common-label">Discriminador</span>
                                        <div class="text-secondary">{{$val->discriminator ?? "-"}}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 no-margin">
                                        <span class="common-label">Fluxograma</span>
                                        <div class="text-secondary">{{$val->flowchart ?? "-"}}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-12 col-lg-12 no-margin">
                                        <span class="common-label">Queixas</span>
                                        <div class="text-secondary">{{$val->complaints ?? "-"}}</div>
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