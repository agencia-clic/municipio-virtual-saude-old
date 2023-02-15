
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_vital_data['data']->total()) AND ($emergency_services_vital_data['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1">Informações</th>
                    <th class="sort pe-1 text-center" width="20%">Profissional Responsavel</th>
                    <th class="sort pe-1 text-center" width="10%">Data Hora</th>
                    <th class="no-sort text-end" width="8%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($emergency_services_vital_data['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesVitalData}}-table">

                        <td class="border email py-2">

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                    @if(!empty($val->temperature))
                                        <p><strong>Temperatura (ºC): {{ $val->temperature }}</strong></p>
                                    @endif

                                    @if(!empty($val->heart_rate))
                                        <p><strong>Frequência Cardíaca (bpm): {{ $val->heart_rate }}</strong></p>
                                    @endif

                                    @if(!empty($val->O2_saturation))
                                        <p><strong>Saturação O2: {{ $val->O2_saturation }}</strong></p>
                                    @endif

                                    @if(!empty($val->respiratory_frequency))
                                        <p><strong>Frequência Respiratória (rpm): {{ $val->respiratory_frequency }}</strong></p>
                                    @endif

                                    @if(!empty($val->blood_pressure))
                                        <p><strong>Pressão Arterial (mmHg): {{ $val->blood_pressure }}</strong></p>
                                    @endif

                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                    @if(!empty($val->blood_glucose))
                                        <p><strong>Glicemia (mg/dl): {{ $val->blood_glucose }}</strong>
                                    @endif

                                    @if(!empty($val->weight))
                                        <p><strong>Peso (Kg): {{ $val->weight }}</strong>
                                    @endif

                                    @if(!empty($val->height))
                                        <p><strong>Altura: {{ $val->height }}</strong>
                                    @endif

                                    @if(!empty($val->ecg))
                                        <p><strong>ECG: {{ $val->ecg }}</strong>
                                    @endif
                                   
                                    <p>
                                    <strong>Régua da Dor: <br><strong>
                                        @if($val->rule_of_pain == 1)
                                            <span class="badge pain_one text-white">1</span>
                                        @elseif($val->rule_of_pain == 2)
                                            <span class="badge pain_two text-white">2</span>
                                        @elseif($val->rule_of_pain == 3)
                                            <span class="badge pain_three text-white">3</span>
                                        @elseif($val->rule_of_pain == 4)
                                            <span class="badge pain_four text-white">4</span>
                                        @elseif($val->rule_of_pain == 5)
                                            <span class="badge pain_five text-white">5</span>
                                        @elseif($val->rule_of_pain == 6)
                                            <span class="badge pain_six text-white">6</span>
                                        @elseif($val->rule_of_pain == 7)
                                            <span class="badge pain_seven text-white">7</span>
                                        @elseif($val->rule_of_pain == 8)
                                            <span class="badge pain_eight text-white">8</span>
                                        @elseif($val->rule_of_pain == 9)
                                            <span class="badge pain_nine text-white">9</span>
                                        @elseif($val->rule_of_pain == 10)
                                            <span class="badge pain_ten text-white">10</span>
                                        @endif
                                    </p>
                                    
                                </div>
                            </div>
                        </td>

                        <td class="border email py-2 text-center">
                            <span class="title">
                                <strong>{{ $val->responsible }}</strong>
                                @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))
                                    @foreach($specialty_users as $val_specialty)
                                    • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                    @endforeach
                                @endif
                            </span>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ date('d-m-Y H:i', strtotime($val->created_at)) }}</strong>
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">

                                        <!-- print -->
                                        <a class="dropdown-item" href="{{ route('emergency_services_vital_data.export', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesVitalData' => base64_encode($val->IdEmergencyServicesVitalData)]) }}" title="Imprimir" target="_blanck"><strong><span class="fas fa-print me-1"></span><span> Imprimir</span></strong></a>

                                        <!-- delete -->
                                        @if(auth()->user()->IdUsers == $val->IdUsersResponsible)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item fw-bold" href="{{route('emergency_services_vital_data.form.delete', ['IdEmergencyServicesVitalData' => base64_encode($val->IdEmergencyServicesVitalData)])}}" data-id="{{ $val->IdEmergencyServicesVitalData }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                <tbody>
                    <tr>
                        <td><div class="alert alert-primary mt-3" role="alert">Nenhum registro encontrado.</div></td>
                    </tr>
                </tbody>
            @endif
    </table>
</div>
<!-- table -- end -->