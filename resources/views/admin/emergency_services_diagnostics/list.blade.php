
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_diagnostics['data']->total()) AND ($emergency_services_diagnostics['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">CID10</th>
                    <th class="sort pe-1 text-center" width="15%">Diagnóstico Principal</th>
                    <th class="sort pe-1 text-center" width="15%">Diagnóstico</th>
                    <th class="sort pe-1 text-center" width="15%">Primeiros Sintomas</th>
                    <th class="sort pe-1 text-center" width="15%">Responsável</th>
                    <th class="no-sort text-end" width="5%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($emergency_services_diagnostics['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesDiagnostics}}-table">
                        <td class="border email text-1000 py-2">
                            <strong>{{$val->code }} - {{ $val->title }}</strong>
                        </td>

                        <td class="border phone white-space-nowrap py-2 text-center" width="15%">
                            {{ $val->main_diagnosis == "y" ? "SIM" : "NÃO" }}
                        </td>

                        <td class="border phone white-space-nowrap py-2 text-center" width="15%">
                            {{$val->diagnostics == "d" ? "Definitivo" : "Provisório"}}
                        </td>

                        <td class="border phone white-space-nowrap py-2 text-center" width="15%">{{$val->date ? date('d-m-Y', strtotime($val->date)) : "" }}</td>

                        <td class="border phone white-space-nowrap py-2 text-center" width="15%">
                            {{ $val->responsible }}
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">

                                        @if($val->IdUsersResponsible == auth()->user()->IdUsers)
                                           <!-- edit -->
                                            <button class="dropdown-item" 
                                            type="button" title="Diagnósticos" 
                                            iframe-form="{{ route('emergency_services_diagnostics.form', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesDiagnostics' => base64_encode($val->IdEmergencyServicesDiagnostics)]) }}" 
                                            iframe-create="{{ route('emergency_services_diagnostics.form.update', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesDiagnostics' => base64_encode($val->IdEmergencyServicesDiagnostics)]) }}"><strong><span class="fas fa-edit me-1"></span><span> Editar</span></strong></button>

                                            <!-- delete -->
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item fw-bold" href="{{route('emergency_services_diagnostics.form.delete', ['IdEmergencyServicesDiagnostics' => base64_encode($val->IdEmergencyServicesDiagnostics)]) }}" data-id="{{ $val->IdEmergencyServicesDiagnostics }}" action="delete"><strong><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></strong></a>
                                        @else
                                            <!-- edit -->
                                            <button class="dropdown-item disabled" type="button" title="Diagnósticos"><strong><span class="fas fa-edit me-1"></span><span> Editar</span></strong></button>

                                            <!-- delete -->
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item fw-bold disabled" href="!#"><strong><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></strong></a>
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
@if($emergency_services_diagnostics['data']->total() == 0)
    <input name="validate_diagnostics" value="" class="hide" required>
@endif