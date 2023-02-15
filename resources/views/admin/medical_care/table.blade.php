<!-- table -- start -->
<div class="card-body p-0">
    <div class="table-responsive scrollbar">
        <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden border">

            @if(!empty($emergency_services['data']->total()) AND ($emergency_services['data']->total() > 0))
                <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort pe-1 text-center" width="3%"></th>
                        <th class="sort pe-1">Paciente</th>
                        <th class="sort pe-1 text-center" width="15%">Responsavel</th>
                        <th class="sort pe-1 text-center" width="10%">Idade</th>
                        <th class="sort pe-1 text-center" width="10%">Entrada</th>
                        <th class="sort pe-1 text-center" width="20%">Queixas</th>
                        <th class="no-sort text-end" width="5%">Ações</th>
                    </tr>
                </thead>
                <tbody class="list list-table" id="table-customers-body">
    
                    @foreach($emergency_services['data'] as $key => $val)
                        <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServices}}-table">

                            <td class="border phone py-2 text-center">
                                {{ $val->IdEmergencyServices }}
                            </td>

                            <td class="border name white-space-nowrap py-2">
                                <div class="d-flex d-flex align-items-center">
                                    <div class="avatar avatar-xl me-2">
                                        <div class="avatar-name 
                                        
                                            @if((!empty($val->classification)) AND $val->classification == 4)
                                                emergency
                                            @elseif((!empty($val->classification)) AND $val->classification == 3)
                                                very_urgent
                                            @elseif((!empty($val->classification)) AND $val->classification == 2)
                                                urgent
                                            @elseif((!empty($val->classification)) AND $val->classification == 1)
                                                little_urgent
                                            @elseif($val->classification == 0)
                                                not_urgent
                                            @else
                                                bg-500
                                            @endif
                                        
                                        rounded-circle" title="código"><span></span></div>
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="mb-0 fs--1">{{ $val->users_name }} 
                                            <span class="badge rounded-pill badge-soft-primary">
                                                @if($emergency_services['emergency_services_forward_internal'][$val->IdEmergencyServices]->type == "t")
                                                    (TRIAGEM)
                                                @elseif($emergency_services['emergency_services_forward_internal'][$val->IdEmergencyServices]->type->type == "c")
                                                    (CONSULTA)
                                                @else
                                                    (REAVALIAÇÂO)
                                                @endif
                                            </span>
                                        </h5>

                                        @if(!empty($val->IdUsersResponsibleMedicare) AND ($mask->dataDifference(date('Y-m-d H:i:s'), $val->updated_at, "m") < 15))
                                            <span class="badge rounded-pill badge-soft-info">Em Atendimento há: {{ $mask->dataDifference(date('Y-m-d H:i:s'), $val->updated_at, "m") }} M</span>
                                        @endif

                                        @if(!empty($val->IdUsersResponsibleMedicare) AND ($mask->dataDifference(date('Y-m-d H:i:s'), $val->updated_at, "m") >= 15))
                                            <span class="badge rounded-pill badge-soft-danger">Em Atendimento há: 
                                                @php $minutes = $mask->dataDifference(date('Y-m-d H:i:s'), $val->updated_at, "m") @endphp
                                                @if($minutes <= 59)
                                                    {{ $minutes }} Minutos
                                                @else
                                                    {{ $mask->dataDifference(date('Y-m-d H:i:s'), $val->updated_at, "h") }} H/M
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center" width="15%">
                                <strong>{{ $val->responsible_service }}</strong>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center" width="8%">
                                <strong>{{ $mask->birth($val->date_birth) }}</strong>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center" width="8%">
                                <strong>{{ date('d-m-Y H:i', strtotime($val->created_at)) }}</strong>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center" width="30%">
                                <strong>{{ $val->complaints }}</strong>
                            </td>
                           
                            <td class="border white-space-nowrap py-2 text-end">
                                <div class="dropdown font-sans-serif position-static">
                                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                        <span class="fas fa-ellipsis-h fs--1"></span>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                        <div class="bg-white py-2">

                                            <!-- atender -->
                                            <a class="dropdown-item fw-bold" href="{{ route('medical_care.form', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdFlowcharts' => $IdFlowcharts, 'IdEmergencyServicesInternal' => base64_encode($emergency_services['emergency_services_forward_internal'][$val->IdEmergencyServices]->IdEmergencyServicesForwardInternal)]) }}" moda-alert="Atenção, Tem certeza que deseja iniciar esse processo ?"><span class="fas fa-user-plus me-1"></span><span> Acolher</span></a>
                                            
                                            <!-- call -->
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item fw-bold call-save-attendance" href="{{ route('call.list', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdUsers' => base64_encode($val->IdUsers)]) }}"><span class="fas fa-bell me-1"></span><span> Chamar Paciente</span></a>
                                            <div class="dropdown-divider"></div>

                                            <!-- Liberar atendimento -->
                                            @if(!empty($val->responsible))
                                                <a class="dropdown-item fw-bold medical-care-watch" title="Realmente deseja libera esse atendimento ?" href="{{ route('medical_care.release', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices)]) }}"><span class="fas fa-arrow-alt-circle-right me-1"></span><span> Libera Atendimento</span></a>
                                                <div class="dropdown-divider"></div>
                                            @endif

                                            <!-- cancel -->
                                            <a class="dropdown-item fw-bold cancel-emergency_services" href="{{route('emergency_services.form.delete', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices)])}}" data-id="{{ $val->IdEmergencyServices }}" data-title="CANCELAR"><span class="fas fa-user-alt-slash me-1"></span><span> Cancelar</span></a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                @else
                    <tbody>
                        <tr>
                            <td><div class="alert alert-primary mt-1" role="alert">Nenhum registro encontrado.</div></td>
                        </tr>
                    </tbody>
                @endif

            </tbody>
        </table>
    </div>
</div>
<!-- table -- end -->

<!-- paginations -- start -->
{{ $emergency_services['data']->appends(app('request')->all())->links() }}