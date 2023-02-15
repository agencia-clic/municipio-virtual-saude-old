<!-- table -- start -->
<div class="table-responsive scrollbar mt-3">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_procedures['data']->total()) AND ($emergency_services_procedures['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap text-left" width="25%">...</th>
                    <th class="text-center" width="15%">Profissional Executante</th>
                    <th class="text-center" width="15%">Laudo/Observação</th>
                    <th class="text-center" width="15%">Data Execução</th>
                    <th class="text-center" width="15%">Status</th>
                    <th class="no-sort text-end" width="8%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($emergency_services_procedures['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesProcedures}}-table-procedures">
                        <td class="border phone py-2 text-left">
                            <strong>Procedimento:</strong>
                            <span class="title mb-2">{{ $val->code }} • {{ $val->procedures }}</span><br>

                            <strong>Observação:</strong>
                            <span class="title">{{ $val->note }}</span><br>

                            <p class="mt-3 mb-0">criado em <strong>{{ date('d-m-Y H:i', strtotime($val->created_at)) }}</strong> por <strong>{{$val->responsible}}</strong>
                            @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))
                                @foreach($specialty_users as $val_specialty)
                                • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                @endforeach
                            @endif</p>
                        </td>

                        <td class="border phone py-2 text-center">
                            {{ $val->responsible_run }}
                        </td>

                        <td class="border phone py-2 text-center data-view">
                            <span class="title"><strong>{{Str::limit( $val->medical_report ?? $val->note_refused, 100)}}</strong></span>
                            <span class="description hide"><strong>{{ $val->medical_report ?? $val->note_refused }}</strong></span>
                        </td>

                        <td class="border phone py-2 text-center">
                            {{ date('d-m-Y H:i', strtotime($val->created_at)) }}
                        </td>

                        <td class="border phone white-space-nowrap text-1000 py-2 text-center">
                            @if($val->status == "open")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Aguardando
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->status == 'accepted')
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Aceito
                                    <span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->status == 'executed')
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Executado
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->status == 'refused')
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-danger">Recusado
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

                                        @if($val->status != "refused" and $val->status != "executed")
                                           <!-- edit -->
                                            <button class="dropdown-item" type="button" id="edit-procedures" onclick="window.parent.run_procedures('Executar', '{{ route('emergency_services_procedures.form.run', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesProcedures' => base64_encode($val->IdEmergencyServicesProcedures), 'IdProceduresGroups' => base64_encode($val->IdProceduresGroups)]) }}')">
                                                <span class="fas fa-check-square me-1"></span><span>
                                                    <strong>Executar</strong>
                                                </span>
                                            </button>

                                            <!-- ban -->
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item" type="button" id="edit-procedures" onclick="window.parent.run_procedures('Recusar','{{ route('emergency_services_procedures.form.run', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesProcedures' => base64_encode($val->IdEmergencyServicesProcedures), 'IdProceduresGroups' => base64_encode($val->IdProceduresGroups), 'status' => 'refused']) }}', 'danger')"><span class="fas fa-ban me-1"></span><span> <strong>Recusar</strong></span></button>
                                            
                                        @else
                                            <a class="dropdown-item fw-bold disabled" href="!#"><span class="fas fa-check-square me-1"></span><span> Executar</span></a>
                                            <a class="dropdown-item fw-bold disabled" href="!#"><span class="fas fa-ban me-1"></span><span> Recusar</span></a>
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