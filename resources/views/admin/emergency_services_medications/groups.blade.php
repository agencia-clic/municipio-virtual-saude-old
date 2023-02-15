
<!-- table -- start -->
<div class="table-responsive scrollbar mt-2">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($medication_groups['data']->total()) AND ($medication_groups['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="text-left" width="5%"></th>
                    <th class="text-right" width="25%">Profissional</th>
                    <th class="sort text-center" width="15%">Data/Hora</th>
                    <th class="text-center" width="15%">Prescrições Ativas</th>
                    <th class="text-right">Observação</th>
                    <th class="no-sort text-end" width="8%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($medication_groups['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdMedicationGroups}}-table">

                        <td class="border text-left">
                            <div class="d-flex d-flex align-items-center">
                                <div class="avatar avatar-xl me-2">
                                    @if((!empty($val->check_next()->num_check)) AND $val->check_next()->num_check == 0 OR ((!empty($val->check_next()->next_run)) AND !$mask->nowGreater($val->check_next()->next_run)))
                                        <div class="avatar-name emergency rounded-circle" title="Prescrição Sem Checagem"><span></span></div>
                                    @elseif((!empty($val->check_next()->next_run)) AND  $mask->dataDifference(date('Y-m-d H:i:m'), $val->check_next()->next_run,'m') <= 10)
                                        <div class="avatar-name very_urgent rounded-circle" title="Prescrição deve ser Checada {{ $mask->dataDifference(date('Y-m-d H:i:m'), $val->check_next()->next_run,'m') }} minutos"><span></span></div>
                                    @else
                                        <div class="avatar-name little_urgent rounded-circle" title="Prescrição Sem Checagem"><span></span></div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h5 class="mb-0 fs--1"></h5>
                                </div>
                            </div>
                        </td>

                        <td class="border phone py-2 text-right">
                            <span class="title">
                                <strong>{{ $val->responsible }}</strong>
                                @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))
                                    @foreach($specialty_users as $val_specialty)
                                    • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                    @endforeach
                                @endif
                            </span>
                        </td>

                        <td class="border py-2 text-center">
                            <strong>{{ $val->created_at->format('d-m-Y H:i') }}</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{$val->medication_wait()}}</strong>
                        </td>

                        <td class="border phone py-2 text-right data-view">
                            <span class="title"><strong>{{Str::limit( $val->note, 100)}}</strong></span>
                            <span class="description hide"><strong>{{ $val->note }}</strong></span>
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">

                                        <!-- print -->
                                        <a class="dropdown-item" href="{{ route('emergency_services_medications.export', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdMedicationGroups' => base64_encode($val->IdMedicationGroups)]) }}" title="Imprimir" target="_blanck"><strong><span class="fas fa-print me-1"></span><span> Imprimir</span></strong></a>

                                        @if($val->IdUsersResponsible == auth()->user()->IdUsers)
                                           
                                            <!-- edit -->
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item procedures-button" type="button" title="Registrar Prescrição" data-url="{{ route('emergency_services_medications', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdMedicationGroups' => base64_encode($val->IdMedicationGroups)]) }}"><span class="fas fa-edit me-1"></span><span> <strong>Editar</strong></span></button>

                                        @else
                                            <!-- edit -->
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item procedures-button" type="button" title="Registrar Prescrição" data-url="{{ route('emergency_services_medications', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdMedicationGroups' => base64_encode($val->IdMedicationGroups)]) }}">
                                                <span class="fas fa-eye me-1"></span><span><strong>Visualizar</strong></span>
                                            </button>
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