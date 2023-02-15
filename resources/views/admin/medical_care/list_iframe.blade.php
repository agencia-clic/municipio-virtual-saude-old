
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($medical_care['data']->total()) AND ($medical_care['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap text-left" width="20%">Descrição</th>
                    <th class="text-center" width="15%">Data</th>
                    <th class="text-center" width="15%">Responsável</th>
                    <th class="no-sort text-end" width="8%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($medical_care['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdMedicalCare}}-table">

                        <td class="border phone py-2 text-left data-view" width="20%" data-view="{{ $val->anamnesis }}">
                            <span class="title">{{Str::limit( $val->anamnesis, 100)}}</span>
                            <span class="description hide">{{ $val->anamnesis }}</span>
                        </td>

                        <td class="border phone py-2 text-center">
                            {{ date('d-m-Y H:i', strtotime($val->created_at)) }}
                        </td>

                        <td class="border phone py-2 text-center">
                            <strong>{{ $val->responsible }}</strong>

                            @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))

                                @foreach($specialty_users as $val_specialty)
                                • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                @endforeach

                            @endif
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
                                            <button class="dropdown-item fw-bold" title="Anamnese / Exame Físico" iframe-form="{{ route('medical_care.form.iframe', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices),'IdMedicalCare' => base64_encode($val->IdMedicalCare)]) }}" iframe-create="{{ route('medical_care.update.iframe', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices), 'IdMedicalCare' => base64_encode($val->IdMedicalCare)]) }}"><span class="fas fa-edit me-1"></span><span> Editar</span></a>
                                        @else
                                            <a class="dropdown-item fw-bold disabled" href="!#"><span class="fas fa-edit me-1"></span><span> Editar</span></button>
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