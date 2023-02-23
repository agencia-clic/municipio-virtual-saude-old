<!-- table -- start -->
<div class="card-body p-0">
    <div class="table-responsive scrollbar">
        <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden border">

            @if(!empty($emergency_services->total()) AND ($emergency_services->total() > 0))
                <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort pe-1 text-center" width="3%"></th>
                        <th class="sort pe-1">Paciente</th>
                        <th class="sort pe-1 text-center" width="20%">Responsável</th>
                        <th class="sort pe-1 text-center" width="8%">Idade</th>
                        <th class="sort pe-1 text-center" width="8%">Entrada</th>
                        <th class="sort pe-1 text-left" width="30%">Observação</th>
                        <th class="no-sort text-end" width="5%">Ações</th>
                    </tr>
                </thead>
                <tbody class="list list-table" id="table-customers-body">
    
                    @foreach($emergency_services as $val)
                        <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServices}}-table">

                            <td style="padding-top:15px">
                                {{ $val->IdEmergencyServices }}
                            </td>

                            <td class="border name py-2">
                                <div class="d-flex d-flex align-items-center">
                                    <div class="avatar avatar-xl me-2">
                                        <div class="avatar-name 
                                        
                                            @if((!empty($val->last_screenings())) AND $val->last_screenings()->classification == 4)
                                                emergency
                                            @elseif((!empty($val->last_screenings())) AND $val->last_screenings()->classification == 3)
                                                very_urgent
                                            @elseif((!empty($val->last_screenings())) AND $val->last_screenings()->classification == 2)
                                                urgent
                                            @elseif((!empty($val->last_screenings())) AND $val->last_screenings()->classification == 1)
                                                little_urgent
                                            @elseif((!empty($val->last_screenings())) AND $val->last_screenings()->classification == 0)
                                                not_urgent
                                            @else
                                                bg-500
                                            @endif
                                        
                                        rounded-circle" title="código"><span></span></div>
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="mb-0 fs--1">{{ $val->users_name }} @if(!empty($val->last_screenings())) (<strong>Reclassificar</strong>) @endif</h5>

                                        @if(!empty($call = $val->call()))
                                            <span class="badge badge-soft-warning" title="Última chamada">{{ $call->responsible }} {{ $call->created_at->format('H:i') }}</span> 
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center">
                                <strong>{{ $val->users_screenings_name }}<strong>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center">
                                <strong>{{ Mask::birth($val->users_date_birth) }}</strong>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center">
                                <strong>{{ date('d-m-Y H:i', strtotime($val->created_at)) }}</strong>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-left">
                                <strong>{{ $val->note }}</strong>
                            </td>
                           
                            <td class="border white-space-nowrap py-2 text-end">
                                <div class="dropdown font-sans-serif position-static">
                                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                        <span class="fas fa-ellipsis-h fs--1"></span>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                        <div class="bg-white py-2">

                                            <!-- wellcome -->
                                            <a class="dropdown-item fw-bold" href="{{ route('screenings.form', ['action' => 'acol', 'IdEmergencyServices' => base64_encode($val->IdEmergencyServices)]) }}" modal-alert="Atenção, Tem certeza que deseja iniciar esse processo ?"><span class="fas fa-user-plus me-1"></span><span> Acolher</span></a>
                                            <div class="dropdown-divider"></div>

                                            <!-- call -->
                                            <a class="dropdown-item fw-bold call-save-attendance" href="{{ route('call.list', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdUsers' => base64_encode($val->IdUsers)]) }}"><span class="fas fa-bell me-1"></span><span> Chamar Paciente</span></a>
                                            <div class="dropdown-divider"></div>

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
{{ $emergency_services->appends(app('request')->all())->links() }}