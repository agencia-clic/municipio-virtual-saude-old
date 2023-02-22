    <!-- table -- start -->
    <div class="card-body p-0">
        <div class="table-responsive scrollbar">
            <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">

                @if(!empty($admit_patient_requests->total()) AND ($admit_patient_requests->total() > 0))
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort pe-1 white-space-nowrap">Paciente</th>
                            <th class="sort pe-1 white-space-nowrap text-center" width="20%">Responsavel</th>
                            <th class="sort pe-1 white-space-nowrap text-center" width="10%">Data da Solicitação</th>
                            <th class="sort pe-1 text-center" width="10%">Status</th>
                            <th class="no-sort text-end" width="8%">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="list list-table" id="table-customers-body">
        
                        @foreach($admit_patient_requests as $val)
                            <tr class="btn-reveal-trigger" id="{{$val->IdAdmitPatientRequests}}-table">
                                <td class="border email py-2"><strong>{{ $val->patients }}</strong></td>
                                <td class="border email py-2 text-center"> 
                                    <span class="title">
                                        <strong>{{ $val->responsible }}</strong>
                                        @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))
                                            @foreach($specialty_users as $val_specialty)
                                            • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                            @endforeach
                                        @endif
                                    </span>
                                </td>
                                <td class="border email py-2 text-center"><strong>{{ $val->created_at->format('d-m-Y H:i') }}</strong></td>
                                <td class="border phone white-space-nowrap py-2 border text-end" width="5%">
                                    @if($val->status == "w")
                                        <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Solicitado
                                            <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                        </span>
                                    @else
                                        <span class="badge badge rounded-pill p-2 d-block badge-soft-primary">Aprovado
                                            <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
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
                                                <!-- aprovar -->
                                                @if($val->status == "w")
                                                    <button class="dropdown-item fw-bold" onclick="approve_reprove_modal('APROVAR', 'Realmente deseja APROVAR essa internação ?', '{{route('approve_admissions.approve', ['IdAdmitPatientRequests' => base64_encode($val->IdAdmitPatientRequests), 'status' => 'a'])}}', 'Sim', 'primary')"><span class="far fa-thumbs-up me-1"></span><span> Aprovar</span></button>
                                                    <div class="dropdown-divider"></div>
                                                @endif

                                                <!-- delete -->
                                                <button class="dropdown-item fw-bold" onclick="approve_reprove_modal('REPROVAR', 'Realmente deseja REPROVAR essa internação ?', '{{route('approve_admissions.approve', ['IdAdmitPatientRequests' => base64_encode($val->IdAdmitPatientRequests), 'status' => 'n'])}}', 'Sim', 'danger')"><span class="far fa-thumbs-down me-1"></span><span> Reprovar</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                    @else
                        <tbody>
                            <tr>
                                <td><div class="alert alert-primary mt-1" role="alert">Nenhum registro encontrado.</div></td>
                            </tr>
                        </tbody>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <!-- table -- end -->