
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_forward['data']->total()) AND ($emergency_services_forward['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="text-center" width="25%">Procedimento</th>
                    <th class="text-center" width="20%">Requisitante</th>
                    <th class="text-center" width="20%">Especialidade</th>
                    <th class="text-center" width="20%">Motivo do Encaminhamento</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($emergency_services_forward['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesForward}}-table">

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->specialty }}  ({{ $val->categorie }})</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->responsible }}</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->specialty }} • {{ $val->categorie }}</strong>
                        </td>

                        <td class="border phone py-2 text-left data-view">
                            <span class="title"><strong>{{Str::limit( $val->note, 50)}}</strong></span>
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
                                        <a class="dropdown-item" href="{{ route('emergency_services_forward.export', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesForward' => base64_encode($val->IdEmergencyServicesForward)]) }}" title="Imprimir" target="_blanck"><strong><span class="fas fa-print me-1"></span><span> Imprimir</span></strong></a>

                                        @if($val->IdUsersResponsible == auth()->user()->IdUsers)
                                            <!-- edit -->
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item" 
                                            type="button" title="Receituário" 
                                            iframe-form="{{ route('emergency_services_forward.form', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesForward' => base64_encode($val->IdEmergencyServicesForward)]) }}" 
                                            iframe-create="{{ route('emergency_services_forward.form.update', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesForward' => base64_encode($val->IdEmergencyServicesForward)]) }}"><strong><span class="fas fa-edit me-1"></span><span> Editar</span></strong></button>

                                            <!-- delete -->
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item fw-bold" href="{{route('emergency_services_forward.form.delete', ['IdEmergencyServicesForward' => base64_encode($val->IdEmergencyServicesForward)])}}" data-id="{{ $val->IdEmergencyServicesForward }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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