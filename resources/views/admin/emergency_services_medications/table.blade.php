<!-- table -- start -->
<div class="table-responsive scrollbar mt-1">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_medications['data']->total()) AND ($emergency_services_medications['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="text-left" width="4%"></th>
                    <th class="sort pe-1 white-space-nowrap text-right" width="25%">Medicamentos</th>
                    <th class="text-right" width="15%">Orientação</th>
                    <th class="text-center" width="10%">Frequência da dose</th>
                    <th class="text-center" width="10%">Quantidade</th>
                    <th class="text-center" width="10%">Status</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list" id="table-customers-body">

                @foreach($emergency_services_medications['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesMedications}}-table-medications">

                        <td class="border text-left">
                            <div class="d-flex d-flex align-items-center">
                                <div class="avatar avatar-xl me-2">

                                @if($val->status == "a")
                                    @if(!empty($checks_next_date = $val->checks_next_date()))

                                        @if($mask->nowGreater($checks_next_date))
                                            @if($mask->dataDifference(date('Y-m-d H:i:m'), $checks_next_date,'m') <= 10)
                                                <div class="avatar-name very_urgent rounded-circle" title="Prescrição deve ser Checada {{ $mask->dataDifference(date('Y-m-d H:i:m'), $checks_next_date,'m') }} minutos"><span></span></div>
                                            @else
                                                <div class="avatar-name little_urgent rounded-circle" title="Prescrição Completa"><span></span></div>
                                            @endif
                                        @else
                                            <div class="avatar-name emergency rounded-circle" title="Prescrição Sem Checagem"><span></span></div>
                                        @endif

                                    @else
                                        <div class="avatar-name emergency rounded-circle" title="Prescrição Sem Checagem"><span></span></div>
                                    @endif
                                @else
                                    <div class="avatar-name little_urgent rounded-circle" title="Prescrição Completa"><span></span></div>
                                @endif

                                </div>
                                <div class="flex-1">
                                    <h5 class="mb-0 fs--1"></h5>
                                </div>
                            </div>
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

                        <td class="border phone white-space-nowrap py-2 text-end" width="5%">
                            @if($val->status == "a")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Ativo
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->status == "bf")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-danger">Medicamento Falta
                                    <span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->status == "bs")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-danger">Medicamento Substituído
                                    <span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->status == "bn")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Negou Medicação
                                    <span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->status == "b")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Finalizado
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @endif
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">

                                        @if(($val->IdUsersResponsible == auth()->user()->IdUsers AND $val->status == "a") AND (empty($checks_next_date)))
                                           <!-- edit -->
                                            <button class="dropdown-item" type="button" id="edit-medications" onclick="editMedications('{{ route('emergency_services_medications.data.update', ['IdEmergencyServicesMedications' => $val->IdEmergencyServicesMedications, 'IdEmergencyServices' => $val->IdEmergencyServices, 'IdMedicationsGroups' => $val->IdMedicationsGroups]) }}')"><span class="fas fa-edit me-1"></span><span> <strong>Editar</strong></span></button>

                                            <!-- delete -->
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item fw-bold" onclick="window.parent.delete_modal('DELETAR',  '{{$val->IdEmergencyServicesMedications}}', '{{$val->IdEmergencyServicesMedications}}-table-medications', '{{ route('emergency_services_medications.form.delete', ['IdEmergencyServicesMedications' => base64_encode($val->IdEmergencyServicesMedications)]) }}')"
                                            data-id="{{ $val->IdEmergencyServicesMedications }}">
                                                <span class="fas fa-trash-alt me-1"></span>
                                                <span>Deletar</span>
                                            </button>
                                        @else
                                            <a class="dropdown-item fw-bold disabled" href="!#"><span class="fas fa-edit me-1"></span><span> Editar</span></a>
                                            <a class="dropdown-item fw-bold disabled" href="!#"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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