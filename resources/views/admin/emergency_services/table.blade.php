<!-- table -- start -->
<div class="card-body p-0">
    <div class="table-responsive scrollbar">
        <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden border">

            @if(!empty($emergency_services['data']->total()) AND ($emergency_services['data']->total() > 0))
                <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort pe-1 text-center" width="4%">...</th>
                        <th class="sort pe-1 white-space-nowrap">Paciente</th>
                        <th class="sort pe-1 text-center" width="15%">Caráter do Atendimento</th>
                        <th class="sort pe-1 text-center" width="10%">Atendimento</th>
                        <th class="sort pe-1 text-center" width="8%">Procedencia</th>
                        <th class="sort pe-1 text-center" width="8%">Status</th>
                        <th class="no-sort text-end" width="5%">Ações</th>
                    </tr>
                </thead>
                <tbody class="list list-table" id="table-customers-body">
    
                    @foreach($emergency_services['data'] as $val)
                        <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServices}}-table">

                            <td class="border phone py-2 text-center">
                                {{ $val->IdEmergencyServices }}
                            </td>

                            <td class="border name white-space-nowrap py-2">
                                <div class="d-flex d-flex align-items-center">
                                    <div class="avatar avatar-xl me-2">
                                        <div class="avatar-name 
                                        
                                        @if((!empty($val->last_screenings())) AND $val->last_screenings()->classification == 4){
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
                                        <h5 class="mb-0 fs--1">{{ $val->users_name }}</h5>
                                    </div>
                                </div>
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center" width="15%">
                                @if($val->character == "ele")<span class="badge badge rounded-pill d-block p-2 badge-soft-info">Eletivo</span> @endif
                                @if($val->character == "urg")<span class="badge badge rounded-pill d-block p-2 badge-soft-danger">Urgência</span>@endif
                                @if($val->character == "trab")Acidente no local de trabalho ou a serviço da empresa @endif
                                @if($val->character == "traj")Acidente no trajeto para o trabalho @endif
                                @if($val->character == "otra")Outros tipos de acidentes de trânsito @endif
                                @if($val->character == "oles")Outros tipos de lesões e envenenamento por agentes químicos ou físicos @endif
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center" width="10%">
                                @if($val->types == "acol")<span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Acolhimento</span>@endif
                                @if($val->types == "acol-s")<span class="badge badge rounded-pill d-block p-2 badge-soft-success">Acolhimento Realizado</span>@endif
                                @if($val->types == "atem-s")<span class="badge badge rounded-pill d-block p-2 badge-soft-success">Atendimento Médico Realizado</span>@endif
                                @if($val->types == "atem")<span class="badge badge rounded-pill d-block p-2 badge-soft-info">Atendimento Médico</span>@endif
                                @if($val->types == "bury")<span class="badge badge rounded-pill d-block p-2 badge-soft-info">Internado</span>@endif
                                @if($val->types == "pp")<span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Aguardando Paciente</span>@endif
                                @if($val->types == "ateo")Atendimento Ortopédico @endif
                                @if($val->types == "atep")Atendimento Pediátrico @endif
                                @if($val->types == "proc")Procedimentos Controlados @endif
                                @if($val->types == "proe")Procedimentos Enfermagem @endif
                                @if($val->types == "uem")<span class="badge badge rounded-pill d-block p-2 badge-soft-danger">Urgência e Emergência Médica</span>@endif
                                @if($val->types == "ueo")<span class="badge badge rounded-pill d-block p-2 badge-soft-danger">Urgência e Emergência Ortopedia</span>@endif
                                @if($val->types == "uep")<span class="badge badge rounded-pill d-block p-2 badge-soft-danger">Urgência e Emergência Pediatria</span>@endif
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-center" width="8%">
                                @if($val->provenance == "agen")Agente Penitenciário @endif
                                @if($val->provenance == "amb")Ambulância @endif
                                @if($val->provenance == "bom")Bombeiros @endif
                                @if($val->provenance == "liv")Livre Demanda @endif
                                @if($val->provenance == "mic")Microregião @endif
                                @if($val->provenance == "out")Outros @endif
                                @if($val->provenance == "poc")Polícia Civil @endif
                                @if($val->provenance == "pom")Polícia Militar @endif
                                @if($val->provenance == "rot")Retorno (Mostrar Exame) @endif
                                @if($val->provenance == "sam")SAMU @endif
                                @if($val->provenance == "tu")Transferido de Unidades @endif
                            </td>

                            <td class="border phone white-space-nowrap py-2 text-end" width="8%">
                                @if($val->status == "a")
                                    <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Ativo
                                        <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                    </span>
                                @else
                                    <span class="badge badge rounded-pill d-block badge-soft-secondary">Bloqueado
                                        <span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span>
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
                                            <!-- responsabilit -->
                                            <a class="dropdown-item fw-bold" title="Responsável"><span class="fas fa-id-card me-1"></span><span class="text-primary"> {{ $val->responsible }}</span></a>
                                            <div class="dropdown-divider"></div>

                                            <!-- edit -->
                                            <a class="dropdown-item fw-bold" href="{{route('emergency_services.form', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices)])}}"><span class="fas fa-edit me-1"></span><span> Editar</span></a>

                                            <!-- delete -->
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item fw-bold cancel-emergency_services" href="{{route('emergency_services.form.delete', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices)])}}" data-id="{{ $val->IdEmergencyServices }}" data-title="Alta Paciente"><span class="fas fa-user-alt-slash me-1"></span><span> Alta Paciente</span></a>
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