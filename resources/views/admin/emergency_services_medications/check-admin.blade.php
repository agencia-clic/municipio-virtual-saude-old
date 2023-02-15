<!-- table -- start -->
<div class="table-responsive scrollbar mt-1">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_medication_checks['data']->total()) AND ($emergency_services_medication_checks['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap text-right" width="20%">Medicamentos</th>
                    <th class="text-left" width="15%">Responsavel Execução</th>
                    <th class="text-center" width="10%">Data Execução</th>
                    <th class="text-right" width="25%">Orientação</th>
                    <th class="text-center" width="15%">Quantidade</th>
                </tr>
            </thead>
            <tbody class="list" id="table-customers-body">

                @foreach($emergency_services_medication_checks['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesMedications}}-table-medications">

                        <td class="border phone py-2 text-right">
                            <strong>{{ $val->medicines }} • {{ $val->units }}</strong><br>

                            @if(!empty($val->administrations))
                                <span class="badge bg-primary" title="Via de Administração">{{ $val->administrations }}</span>
                            @endif

                            @if(!empty($val->dilutions))
                                • <span class="badge bg-primary" title="Diluição">{{ $val->dilutions }}</span> 
                            @endif

                            @if(!empty($val->infusao))
                                • <span class="badge bg-primary" title="Infusão">{{ $val->infusao }}</span>
                            @endif

                            @if($val->users_diseases() > 0)
                                • <span class="badge bg-danger">Alergia ao medicamento</span>
                            @endif

                            <p class="mb-0 mt-1">criado em <strong>{{ date('d-m-Y H:i', strtotime($val->created_at)) }}</strong> por <span class="title">
                                <strong>{{ $val->responsible }}</strong>
                                    @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))
                                        @foreach($specialty_users as $val_specialty)
                                        • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                        @endforeach
                                    @endif
                                </span> 
                            </p>
                        </td>

                        <td class="border phone py-2 text-left">
                            <span class="title">
                                <strong>{{ $val->responsible_run }}</strong>
                                @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsibleRun)))
                                    @foreach($specialty_users as $val_specialty)
                                    • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                    @endforeach
                                @endif
                            </span> 
                        </td>

                        <td class="border phone py-2 text-center">
                            <strong>{{ date('d-m-Y H:i', strtotime($val->check_created_at)) }}</strong>
                        </td>

                        <td class="border phone py-2 text-left data-view">
                            <span class="title"><strong>{{Str::limit( $val->guidance, 50)}}</strong></span>
                            <span class="description hide"><strong>{{ $val->guidance }}</strong></span>
                        </td>

                        <td class="border phone py-2 text-center">
                            {{ number_format($val->amount, 2, ",", ".") }} {{ $val->un_measure }}
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