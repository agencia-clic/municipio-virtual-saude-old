
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_forward_internal['data']->total()) AND ($emergency_services_forward_internal['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="text-left" width="20%">Especialidade</th>
                    <th class="text-center" width="20%">Requisitante</th>
                    <th class="text-center" width="20%">Executante</th>
                    <th class="text-left">Motivo do Encaminhamento</th>
                    <th class="text-center" width="10%">Status</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($emergency_services_forward_internal['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesForwardInternal}}-table">

                        <td class="border email py-2 text-left">

                            @if($val->type == "t")
                                <strong>{{ $val->flowcharts }}</strong> 
                            @else
                                <strong>{{ $val->specialties }}</strong> 
                            @endif  
                            • 
                            <span class="badge rounded-pill badge-soft-primary">
                                @if($val->type == "r")
                                    Reavaliação
                                @elseif($val->type == "t")
                                    Triagem
                                @else
                                    Consulta
                                @endif
                            </span>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->responsible }}</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->medical_care_responsible }}</strong>
                        </td>

                        <td class="border phone py-2 text-left data-view">
                            <span class="title"><strong>{{Str::limit( $val->note, 50)}}</strong></span>
                            <span class="description hide"><strong>{{ $val->note }}</strong></span>
                        </td>

                        <td class="border phone white-space-nowrap py-2 text-end" width="8%">
                            @if($val->status == "a")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Ativo
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->status == "e")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Executado
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @else
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-secondary">Bloqueado
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

                                        @if($val->IdUsersResponsible == auth()->user()->IdUsers AND $val->status == "a")
                                            <!-- edit -->
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item" 
                                            type="button" title="Receituário" 
                                            iframe-form="{{ route('emergency_services_forward_internal.form', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesInternal' => base64_encode($val->IdEmergencyServicesForwardInternal)]) }}" 
                                            iframe-create="{{ route('emergency_services_forward_internal.form.update', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesInternal' => base64_encode($val->IdEmergencyServicesForwardInternal)]) }}"><strong><span class="fas fa-edit me-1"></span><span> Editar</span></strong></button>

                                            <!-- delete -->
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item fw-bold" href="{{route('emergency_services_forward_internal.form.delete', ['IdEmergencyServicesInternal' => base64_encode($val->IdEmergencyServicesForwardInternal)])}}" data-id="{{ $val->IdEmergencyServicesForwardInternal }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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