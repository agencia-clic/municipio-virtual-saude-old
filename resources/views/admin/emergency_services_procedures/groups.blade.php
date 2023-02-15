
<!-- table -- start -->
<div class="table-responsive scrollbar mt-2">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($procedures_groups['data']->total()) AND ($procedures_groups['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap text-left" width="20%">Profissional</th>
                    <th class="text-center" width="15%">Aguardando Procedimentos</th>
                    <th class="text-center" width="15%">Data</th>
                    <th class="no-sort text-end" width="8%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($procedures_groups['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdProceduresGroups}}-table">
                        <td class="border phone py-2 text-left">
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
                            <strong>{{ $val->procedures_wait() }}</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->created_at->format('d-m-Y H:i') }}</strong>
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">
                                        
                                        <!-- print -->
                                        <a class="dropdown-item" href="{{ route('emergency_services_procedures.export', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdProceduresGroups' => base64_encode($val->IdProceduresGroups)]) }}" title="Imprimir" target="_blanck"><strong><span class="fas fa-print me-1"></span><span> Imprimir</span></strong></a>

                                        <!-- run -->
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item procedures-run-button" type="button" title="Execução de Procedimentos / Exames" data-url="{{ route('emergency_services_procedures.run', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdProceduresGroups' => base64_encode($val->IdProceduresGroups)]) }}"><span class="fas fa-check-square me-1"></span><span> <strong>Executar</strong></span></button>

                                        <!-- edit -->
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item procedures-button" type="button" title="Solicitação de Procedimentos / Exames" data-url="{{ route('emergency_services_procedures', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdProceduresGroups' => base64_encode($val->IdProceduresGroups)]) }}"><span class="fas fa-edit me-1"></span><span> <strong>Editar</strong></span></button>

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