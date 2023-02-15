<!-- table -- start -->
<div class="table-responsive scrollbar mt-1">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_procedures['data']->total()) AND ($emergency_services_procedures['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap text-left" width="20%">Procedimento</th>
                    <th class="text-right" width="25%">Observação</th>
                    <th class="text-center" width="15%">Data</th>
                    <th class="text-center" width="15%">Status</th>
                    <th class="no-sort text-end" width="8%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($emergency_services_procedures['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesProcedures}}-table-procedures">
                        <td class="border phone py-2 text-left data-view">
                            <span class="title"><strong>{{ $val->code }} • {{Str::limit( $val->procedures, 50)}}</strong></span>
                            <span class="description hide"><strong>{{ $val->code }} • {{ $val->procedures }}</strong></span>
                        </td>

                        <td class="border phone py-2 text-right data-view">
                            <span class="title"><strong>{{Str::limit( $val->note, 100)}}</strong></span>
                            <span class="description hide"><strong>{{ $val->note }}</strong></span>
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

                                        @if($val->IdUsersResponsible == auth()->user()->IdUsers AND $val->status == "open")
                                           <!-- edit -->
                                            <button class="dropdown-item" type="button" id="edit-procedures" onclick="editProcedures('{{ route('emergency_services_procedures.data.update', ['IdEmergencyServicesProcedures' => $val->IdEmergencyServicesProcedures, 'IdEmergencyServices' => $val->IdEmergencyServices, 'IdProceduresGroups' => $val->IdProceduresGroups]) }}')"><span class="fas fa-edit me-1"></span><span> <strong>Editar</strong></span></button>

                                            <!-- delete -->
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item fw-bold" href="{{ route('emergency_services_procedures.form.delete', ['IdEmergencyServicesProcedures' => base64_encode($val->IdEmergencyServicesProcedures)]) }}" data-id="{{ $val->IdEmergencyServicesProcedures }}" data-id-delete="{{$val->IdEmergencyServicesProcedures}}-table-procedures" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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