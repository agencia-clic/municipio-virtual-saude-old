
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($users_medical_specialties['data']->total()) AND ($users_medical_specialties['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap" width="5%">Código</th>
                    <th class="sort pe-1 white-space-nowrap">Especialidades</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($users_medical_specialties['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdUsersMedicalSpecialties}}-table">
                        <td width="5%" style="text-align:center; padding-right:20px"><strong>{{ $val->code }}</strong></td>
                        <td class="border email py-2"><strong>{{ $val->specialties }}</strong></td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static" style="margin-left:15px">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">
                                        <!-- edit -->
                                        <button class="dropdown-item" 
                                        type="button" title="Unidade" 
                                        iframe-form=" {{route('users_medical_specialties.form', ['IdUsers' => base64_encode($val->IdUsers), 'IdUsersMedicalSpecialties' => base64_encode($val->IdUsersMedicalSpecialties)])}}" 
                                        iframe-create="{{ route('users_medical_specialties.form.update', ['IdUsers' => base64_encode($val->IdUsers), 'IdUsersMedicalSpecialties' => base64_encode($val->IdUsersMedicalSpecialties)]) }}"><span class="fas fa-edit me-1"></span><span> <strong>Editar</strong></span></button>

                                        <!-- delete -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item fw-bold" href="{{route('users_medical_specialties.form.delete', ['IdUsersMedicalSpecialties' => base64_encode($val->IdUsersMedicalSpecialties)])}}" data-id="{{ $val->IdUsersMedicalSpecialties }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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