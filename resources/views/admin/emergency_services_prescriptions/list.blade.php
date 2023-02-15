
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_prescriptions['data']->total()) AND ($emergency_services_prescriptions['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort" width="10%">Tipo</th>
                    <th class="text-center" width="15%">Medicação</th>
                    <th class="text-center" width="20%">Via de Administração</th>
                    <th class="text-center" width="20%">Orientação</th>
                    <th class="text-center" width="20%">Quantidade Medicamento</th>
                    <th class="text-center" width="20%">Unidade Medida</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($emergency_services_prescriptions['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesPrescriptions}}-table">
                        
                        <td class="border email py-2">
                            @if($val->type == 'n')
                                <strong>Normal</strong>
                            @elseif($val->type == 't')
                                <strong>Contínuo</strong>
                            @elseif($val->type == 'c')
                                <strong>Controlado</strong>
                            @endif
                        </td>
                        
                        <td class="border email py-2 text-center">
                            <strong>{{ $val->prescriptions }}</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->administrations }}</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->note }}</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            {{ $val->amount }}
                        </td>

                        <td class="border email py-2 text-center">
                            {{ $val->units }}
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">

                                        <!-- print -->
                                        <a class="dropdown-item" href="{{ route('emergency_services_prescriptions.export', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesPrescriptions' => base64_encode($val->IdEmergencyServicesPrescriptions)]) }}" title="Imprimir" target="_blanck"><strong><span class="fas fa-print me-1"></span><span> Imprimir</span></strong></a>

                                        <!-- edit -->
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" 
                                        type="button" title="Receituário" 
                                        iframe-form="{{ route('emergency_services_prescriptions.form', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesPrescriptions' => base64_encode($val->IdEmergencyServicesPrescriptions)]) }}" 
                                        iframe-create="{{ route('emergency_services_prescriptions.form.update', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesPrescriptions' => base64_encode($val->IdEmergencyServicesPrescriptions)]) }}"><strong><span class="fas fa-edit me-1"></span><span> Editar</span></strong></button>

                                        <!-- delete -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item fw-bold" href="{{route('emergency_services_prescriptions.form.delete', ['IdEmergencyServicesPrescriptions' => base64_encode($val->IdEmergencyServicesPrescriptions)])}}" data-id="{{ $val->IdEmergencyServicesPrescriptions }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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