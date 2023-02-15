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
                                    @if($val->check_next()->num_check == 0 OR (!$mask->nowGreater($val->check_next()->next_run)))
                                        <div class="avatar-name emergency rounded-circle" title="Prescrição Sem Checagem"><span></span></div>
                                    @elseif($mask->dataDifference(date('Y-m-d H:i:m'), $val->check_next()->next_run,'m') <= 10)
                                        <div class="avatar-name very_urgent rounded-circle" title="Prescrição deve ser Checada {{ $mask->dataDifference(date('Y-m-d H:i:s'), $val->check_next()->next_run,'m') }} minutos"><span></span></div>
                                    @else
                                        <div class="avatar-name little_urgent rounded-circle" title="Prescrição Completa (Proxima: {{ date('d-m-Y H:i', strtotime($val->check_next()->next_run))}})"><span></span></div>
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
                                        <!-- rum -->
                                        <button class="dropdown-item" type="button" onclick="check_procedures('Check-in', '{{ route('emergency_services_medications.check', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdMedicationGroups' => base64_encode($val->IdMedicationGroups)]) }}')">
                                            <span class="fas fa-check-square me-1"></span><span>
                                                <strong>Check-in</strong>
                                            </span>
                                        </button>
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

<script src="{{ asset('admin/js/modules/medication_groups.js') }}" type="text/javascript"></script>