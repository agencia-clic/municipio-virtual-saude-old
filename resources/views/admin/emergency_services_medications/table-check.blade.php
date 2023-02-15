<!-- table -- start -->
<div class="table-responsive scrollbar mt-1">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_medications['data']->total()) AND ($emergency_services_medications['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="text-left" width="4%"></th>
                    <th class="text-left" width="5%"></th>
                    <th class="sort pe-1 white-space-nowrap text-right" width="25%">Medicamentos</th>
                    <th class="text-right" width="25%">Orientação</th>
                    <th class="text-center" width="15%">Frequência da dose</th>
                    <th class="text-center" width="15%">Quantidade</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list" id="table-customers-body">

                @foreach($emergency_services_medications['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesMedications}}-table-medications">

                        <td class="border text-left">
                            <div class="d-flex d-flex align-items-center">
                                <div class="avatar avatar-xl me-2">

                                @php $check = false; @endphp
                                @if($val->status == "a")
                                    @if(!empty($checks_next_date = $val->checks_next_date()))

                                        @if($mask->nowGreater($checks_next_date))
                                            @if($mask->dataDifference(date('Y-m-d H:i:m'), $checks_next_date,'m') <= 10)
                                                <div class="avatar-name very_urgent rounded-circle" title="Prescrição deve ser Checada {{ $mask->dataDifference(date('Y-m-d H:i:m'), $checks_next_date,'m') }} minutos"><span></span></div>
                                            @else
                                                <div class="avatar-name little_urgent rounded-circle" title="Prescrição Completa"><span></span></div>
                                                @php  $check = true; @endphp
                                            @endif
                                        @else
                                            <div class="avatar-name emergency rounded-circle" title="Prescrição Sem Checagem"><span></span></div>
                                        @endif

                                    @else
                                        <div class="avatar-name emergency rounded-circle" title="Prescrição Sem Checagem"><span></span></div>
                                    @endif
                                @else
                                    <div class="avatar-name little_urgent rounded-circle" title="Prescrição Completa"><span></span></div>
                                    @php  $check = true; @endphp
                                @endif

                                </div>
                                <div class="flex-1">
                                    <h5 class="mb-0 fs--1"></h5>
                                </div>
                            </div>
                        </td>

                        <td class="align-middle text-center">
                            <input class="form-check-input check-medication" type="checkbox" name="check[{{$val->IdEmergencyServicesMedications}}]" value="{{$val->IdEmergencyServicesMedications}}" @if($check) disabled @endif/>
                        </td>

                        <td class="border phone py-2 text-right">
                            <strong>{{ $val->medicines }} • {{ $val->units }}</strong><br>

                            @if(!empty($val->administrations))
                                <span class="badge bg-primary" title="Via de Administração">{{ $val->administrations }}</span>
                            @endif

                            @if(!empty($val->dilutions))
                                • <span class="badge bg-primary" title="Diluição">{{ $val->dilutions }}</span> 
                            @endif

                            @if(!empty($val->infusao))
                                • <span class="badge bg-primary" title="Infusão">{{ $val->infusao }}</span>
                            @endif

                            @if($val->users_diseases() > 0)
                                • <span class="badge bg-danger">Alergia ao medicamento</span>
                            @endif
                        </td>

                        <td class="border phone py-2 text-left data-view">
                            <span class="title"><strong>{{Str::limit( $val->guidance, 50)}}</strong></span>
                            <span class="description hide"><strong>{{ $val->guidance }}</strong></span>
                        </td>

                        <td class="border phone py-2 text-center">
                            @if($val->type == "u")
                                Dose única
                            @elseif($val->type == "i")
                                Intervalo 
                                
                                @if(!empty($val->break))
                                    <strong>{{ date('H:i', strtotime($val->break)) }} H/m</strong>
                                @endif
                            @else
                                Vezes ao Dia {{ $val->number_time_day }}
                            @endif
                        </td>

                        <td class="border phone py-2 text-center">
                            {{ number_format($val->amount, 2, ",", ".") }} {{ $val->un_measure }}
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">
                                        <!-- edit -->
                                        <button class="dropdown-item" type="button" onclick="window.parent.medication_edite_check('Medicação', '{{ route('emergency_services_medications.check.update', ['IdEmergencyServicesMedications' =>      base64_encode($val->IdEmergencyServicesMedications), 'IdEmergencyServices' => base64_encode($val->IdEmergencyServices)]) }}')"><span class="fas fa-edit me-1"></span><span> <strong>Editar</strong></span></button>
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