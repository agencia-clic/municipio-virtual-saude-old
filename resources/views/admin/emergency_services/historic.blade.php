@if(!empty($emergency_services_historic) AND (count($emergency_services_historic) > 0))

<style> 
td {
    vertical-align: top;
}
</style>

    @foreach ($emergency_services_historic as $val)
        
        @php
            $conducts = $val->conducts()
        @endphp

        <!-- emergency services historic -->
        <div class="list-group">
            <a class="list-group-item list-group-item-action bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#collapse{{$val->IdEmergencyServices ?? ""}}" aria-expanded="true" aria-controls="collapse{{$val->IdEmergencyServices ?? ""}}" href="#">
                <span class="far fa-arrow-alt-circle-down"></span> {{ $val->units }} • {{ $val->created_at->format('d-m-Y H:i') }} • Atendimento: {{ $val->IdEmergencyServices }}
            </a>
            
            <div class="accordion-collapse collapse" id="collapse{{$val->IdEmergencyServices ?? ""}}" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="list-group-item list-group-item-action">

                    <h5 class="text-primary mb-0">Entrada</h5>
                    <hr class="mt-0 text-primary">

                    <table style="width: 100%;">
                        <tr>
                            <td width="50%">
                                <p style="font-size: 15px;" class="mt-0">Identificado na Recepção: <strong>Sim</strong></p>
                            </td>
                            <td width="50%">
                                <p style="font-size: 15px" class="mb-0">Chamadas Painel Eletrônico:</p>

                                <span class="mt-0 text-primary ml-5" style="font-size: 15px;">
                                    <strong></strong>
                                </span>

                                @if(!empty($cal = $val->call()))
                                    <table style="width: 60%;"> 
                                        @foreach($cal as $val_call)
                                            <tr>
                                                <td class="table-unit" width="50%">
                                                    <span class="mt-0 text-primary ml-5" style="font-size: 15px;">
                                                        {{ $val_call->sala }}
                                                    </span>
                                                </td>
                                                <td class="table-unit" width="50%">
                                                    <span class="mt-0 text-primary ml-5" style="font-size: 15px;">
                                                        <strong>{{ $val_call->created_at->format('d-m-y H:i') }}</strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                                
                            </td>
                        </tr>
                    </table>

                    <!-- acolimentos -->
                    <h5 class="text-primary mb-0">Acolhimentos</h5>
                    <hr class="mt-0 text-primary">

                    @if(!empty($screenings = $val->screenings()))

                        @foreach($screenings as $index => $val_screenings)
                            <a class="list-group-item list-group-item-action 
                            @if($val_screenings->classification == 4){
                                emergency
                            @elseif($val_screenings->classification == 3)
                                very_urgent
                            @elseif($val_screenings->classification == 2)
                                urgent
                            @elseif($val_screenings->classification == 1)
                                little_urgent
                            @elseif($val_screenings->classification == 0)
                                not_urgent
                            @else
                                bg-500
                            @endif
                            text-white" data-bs-toggle="collapse" data-bs-target="#collapse-screenings{{$val_screenings->IdScreenings}}" aria-expanded="true" aria-controls="collapse-screenings{{$val_screenings->IdScreenings}}" href="#">
                                <span class="far fa-arrow-alt-circle-down"></span> Triagem • {{date('d-m-Y H:i', strtotime($val_screenings->created_at))}} •
                                @if($val_screenings->classification == 4)
                                    <strong>Emergência</strong>
                                @elseif($val_screenings->classification == 3)
                                    <strong>Muito Urgente</strong>
                                @elseif($val_screenings->classification == 2)
                                    <strong>Urgente</strong>
                                @elseif($val_screenings->classification == 1)
                                    <strong>Pouco Urgente</strong>
                                @elseif($val_screenings->classification == 0)
                                    <strong>Não Urgente</strong>
                                @endif • <strong>{{ $val_screenings->responsible }}</strong>
                            </a>
                            
                            <div class="accordion-collapse collapse" id="collapse-screenings{{$val_screenings->IdScreenings}}" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                                <div class="list-group-item list-group-item-action">

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Pressão Arterial (mmHg)</span>
                                            <div class="text-secondary">{{$val_screenings->blood_pressure?? "-"}}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Peso (Kg)</span>
                                            <div class="text-secondary">{{$val_screenings->weight?? "-"}}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Temperatura (°C)</span>
                                            <div class="text-secondary">{{$val_screenings->temperature?? "-"}}</div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Altura</span>
                                            <div class="text-secondary">{{$val_screenings->height ?? "-"}}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Frequência Respiratória (rpm)</span>
                                            <div class="text-secondary">{{$val_screenings->respiratory_frequency ?? "-"}}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Frequência Cardíaca (bpm)</span>
                                            <div class="text-secondary">{{$val_screenings->heart_rate ?? "-"}}</div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Saturação O<sub>2</sub></span>
                                            <div class="text-secondary">{{$val_screenings->O2_saturation ?? "-"}}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">ECG</span>
                                            <div class="text-secondary">{{$val_screenings->ecg ?? "-"}}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Glicemia (mg/dl)</span>
                                            <div class="text-secondary">{{$val_screenings->blood_glucose ?? "-"}}</div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Régua da Dor</span>
                                            <div class="text-white">
                                                @if($val_screenings->rule_of_pain == 1)
                                                    <span class="badge pain_one">1</span>
                                                @elseif($val_screenings->rule_of_pain == 2)
                                                    <span class="badge pain_two">2</span>
                                                @elseif($val_screenings->rule_of_pain == 3)
                                                    <span class="badge pain_three">3</span>
                                                @elseif($val_screenings->rule_of_pain == 4)
                                                    <span class="badge pain_four">4</span>
                                                @elseif($val_screenings->rule_of_pain == 5)
                                                    <span class="badge pain_five">5</span>
                                                @elseif($val_screenings->rule_of_pain == 6)
                                                    <span class="badge pain_six">6</span>
                                                @elseif($val_screenings->rule_of_pain == 7){
                                                    <span class="badge pain_seven">7</span>
                                                @elseif($val_screenings->rule_of_pain == 8)
                                                    <span class="badge pain_eight">8</span>
                                                @elseif($val_screenings->rule_of_pain == 9)
                                                    <span class="badge pain_nine">9</span>
                                                @elseif($val_screenings->rule_of_pain == 10)
                                                    <span class="badge pain_ten">10</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Diabético</span>
                                            <div class="text-secondary">{{$val_screenings->condition_diabetic ? "SIM" : "NÃO"}}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Cardiopata</span>
                                            <div class="text-secondary">{{$val_screenings->condition_diabetic ? "SIM" : "NÃO"}}</div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Hipertenso</span>
                                            <div class="text-secondary">{{$val_screenings->condition_hypertensive ? "SIM" : "NÃO"}}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                                            <span class="common-label">Gestante</span>
                                            <div class="text-secondary">{{$val_screenings->condition_pregnant ? "SIM" : "NÃO"}}</div>
                                        </div>

                                        @if(!empty($val_screenings->gestational_age))
                                            <div class="col-sm col-md col-lg no-margin">
                                                <span class="common-label">Idade Gestacional</span>
                                                <div class="text-secondary">{{$val_screenings->gestational_age ?? "-"}}</div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="row mt-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12 no-margin">
                                            <span class="common-label">Discriminador</span>
                                            <div class="text-secondary">{{$val_screenings->discriminator ?? "-"}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 no-margin">
                                            <span class="common-label">Fluxograma</span>
                                            <div class="text-secondary">{{$val_screenings->flowchart ?? "-"}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-12 col-lg-12 no-margin">
                                            <span class="common-label">Queixas</span>
                                            <div class="text-secondary">{{$val_screenings->complaints ?? "-"}}</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif

                    <!-- acolimentos -->
                    <h5 class="text-primary mt-3 mb-0">Atendimentos</h5>
                    <hr class="mt-0 text-primary">
                    <span class="mt-0 text-primary ml-5" style="font-size: 15px;">
                        <strong>Registros de Anamneses</strong>
                    </span>

                    @php 
                        $medical_care_note = NULL;
                        $medical_care_data = NULL
                    @endphp
                    @if($medical_care = $val->medical_care())
                        <table class="table table-sm table-striped fs--1 mt-2 mb-0 overflow-hidden">
                            <tbody>
                                <tr>
                                    <th class="bg-500" style="width:70px;">Data Anamnese</th>
                                    <th class="bg-500" style="width:100px;">Descrição</th>
                                    <th class="bg-500" style="width:100px;">Profissional</th>
                                    <th class="bg-500" style="width:100px;">Ocupação</th>
                                </tr>

                                @php $count=0;@endphp
                                @foreach ($medical_care as $val_medical_care)

                                    @php
                                        $count++;
                                        if($count == 1):
                                            $medical_care_note = $val_medical_care->note;
                                            $medical_care_data = $val_medical_care->created_at->format('d-m-Y H:i'); 
                                        endif;
                                    @endphp

                                    <tr>
                                        <td align="left" class="bg-500">{{ $val_medical_care->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="bg-500">{{ $val_medical_care->anamnesis }}</td>
                                        <td class="bg-500">{{ $val_medical_care->responsible }}</td>
                                        <td class="bg-500">
                                            <strong>
                                                @if(!empty($specialty_users = auth()->user()->specialty_users($val_medical_care->IdUsersResponsible)))
                                                    @foreach($specialty_users as $val_specialty)
                                                    {{ $val_specialty->title }} 
                                                    @endforeach
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    @endif

                    <!-- Diagnósticos -->
                    @if(!empty($emergency_services_diagnostics = $val->diagnostics()))
                        <h5 class="text-primary mt-3 mb-0">Diagnósticos</h5>
                        <hr class="mt-0 text-primary">
                        
                        <table style="width: 100%;">
                            <tr>
                                <td width="50%">
                                    <p style="font-size: 15px;" class="mt-0">
                                        Acidente de trânsito:
                                        @if($emergency_services_diagnostics->traffic_accident == 'y')
                                            <strong>Sim</strong>
                                        @else
                                            <strong>Sim</strong>
                                        @endif
                                    </p>
                                </td>
                                <td width="50%">
                                    <p style="font-size: 15px;" class="mt-0">
                                        Relacionado ao trabalho:
                                        @if($emergency_services_diagnostics->work_related == 'y')
                                            <strong>Sim</strong>
                                        @else
                                            <strong>Sim</strong>
                                        @endif
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td width="50%">
                                    <p style="font-size: 15px;" class="mt-0">
                                        Atentado violento:
                                        @if($emergency_services_diagnostics->violent_attack == 'y')
                                            <strong>Sim</strong>
                                        @else
                                            <strong>Sim</strong>
                                        @endif
                                    </p>
                                </td>
                                <td width="50%">
                                    <p style="font-size: 15px;" class="mt-0">
                                        Data Primeiros Sintomas:
                                       {{ date('d-m-Y', strtotime($emergency_services_diagnostics->date)) }}
                                    </p>
                                </td>
                            </tr>

                            @if(!empty($emergency_services_diagnostics->code))
                                <tr>
                                    <td width="50%">
                                        <p style="font-size: 15px;" class="mt-0" colspan="2">
                                            CID10: 
                                            <strong>{{ $emergency_services_diagnostics->code }} - {{ $emergency_services_diagnostics->cid10 }} </strong>
                                        </p>
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td width="50%">
                                    <p style="font-size: 15px;" class="mt-0">
                                        Diagnóstico Definitivo:
                                        @if($emergency_services_diagnostics->diagnostics == 'y')
                                            <strong>Sim</strong>
                                        @else
                                            <strong>Sim</strong>
                                        @endif
                                    </p>
                                </td>
                                <td width="50%">
                                    <p style="font-size: 15px;" class="mt-0">
                                        Diagnóstico Secundário:<strong>Não</strong>
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td width="50%">
                                    <p style="font-size: 15px;" class="mt-0" colspan="2">
                                        Orientações:<strong>{{ $medical_care_note }}</strong>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    @endif

                    <!-- Dados Antropométricos -->
                    <h5 class="text-primary mt-3 mb-0">Observação - Início: {{ $medical_care_data }}</h5>
                    <hr class="mt-0 text-primary"/>
                    <span class="mt-0 text-primary ml-5" style="font-size: 15px;">
                        <strong>Dados Antropométricos</strong>
                    </span><br><br>
                    
                    @if(($emergency_services_vital_data = $val->vital_data()) AND !empty($emergency_services_vital_data['data']))
                        @php $count=0; @endphp
                        @foreach ($emergency_services_vital_data['data'] as $val_vital_data)
                            @php $count++; @endphp

                            <table style="width: 100%;">
                                <tr>
                                    <td width="50%">
                                        <p style="font-size: 15px;  " class="mt-0">
                                            Data: <strong>{{ $val_vital_data->created_at->format('d-m-Y H:i') }}</strong>
                                        </p>
                                    </td>
                                    <td width="50%">
                                        <p style="font-size: 15px;" class="mt-0">
                                            Profissional: <strong>{{ $val_vital_data->responsible }}</strong>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="50%">
                                        <p style="font-size: 15px;" class="mt-0">
                                            Temperatura (°C): <strong>{{ $val_vital_data->temperature }}</strong>
                                        </p>
                                    </td>
                                    <td width="50%">
                                        <p style="font-size: 15px;" class="mt-0">
                                            Peso(Kg): <strong>{{ $val_vital_data->weight }}</strong>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="50%">
                                        <p style="font-size: 15px;" class="mt-0">
                                            Freq.Cardíaca(bpm): <strong>{{ $val_vital_data->heart_rate }}</strong>
                                        </p>
                                    </td>
                                    <td width="50%">
                                        <p style="font-size: 15px;" class="mt-0">
                                            Altura: <strong>{{ $val_vital_data->height }}</strong>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="50%">
                                        <p style="font-size: 15px;" class="mt-0">
                                            Freq.Respiratória(rpm): <strong>{{ $val_vital_data->respiratory_frequency }}</strong>
                                        </p>
                                    </td>
                                    <td width="50%">
                                        <p style="font-size: 15px;" class="mt-0">
                                            Saturação O2: <strong>{{ $val_vital_data->O2_saturation }}</strong>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="50%" colspan="2">
                                        <p style="font-size: 15px;" class="mt-0">
                                            Pressão Arterial: <strong>{{ $val_vital_data->blood_pressure }}</strong>
                                        </p>
                                    </td>
                                </tr>

                            </table>

                            @if($count != count($emergency_services_vital_data['data']))
                                <hr class="text-secondary mb-3" style="width: 99%; margin: auto;"/>
                            @endif
                            
                        @endforeach
                    @endif


                    @if(!empty($medication_groups = $val->medication_groups()))

                        <!-- Registros de Enfermagem -->
                        <h5 class="text-primary mt-3 mb-0">Prescrição Médica</h5>
                        <hr class="mt-0 text-primary"/>

                        @foreach ($medication_groups as $val_medication_groups)

                            <span class="mt-0 text-primary ml-5" style="font-size: 15px;">
                                <strong>{{ $val_medication_groups->responsible }}</strong>
                            </span>

                            <table class="table table-sm table-striped fs--1 mt-2 mb-0 overflow-hidden">
                                <tbody>
                                    <tr>
                                        <th class="bg-500" style="width:60%;">Medicamento</th>
                                        <th class="bg-500">Orientações</th>
                                    </tr>
                                    <tr>
                                        <td align="left" class="bg-500">{{ $val_medication_groups->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="bg-500">{{ $val_medication_groups->note }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    @endforeach
       
@else
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">
        <tbody>
            <tr>
                <td><div class="alert alert-primary mt-3" role="alert">Nenhum registro encontrado.</div></td>
            </tr>
        </tbody>
    </table>
@endif