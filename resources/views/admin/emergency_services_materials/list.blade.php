
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_materials['data']->total()) AND ($emergency_services_materials['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">Materiais</th>
                    <th class="text-center" width="20%">Profissional</th>
                    <th class="text-center" width="10%">Quantidade</th>
                    <th class="text-center" width="25%">Observação</th>
                    <th class="no-sort text-end" width="5%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($emergency_services_materials['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesMaterials}}-table">
                        <td class="border email text-1000 py-2">
                            <strong>{{ $val->materials }} • {{($val->code ?? "000000") }}</strong>
                        </td>

                        <td class="border phone py-2 text-center">
                            <span class="title">
                                <strong>{{ $val->responsible }}</strong>
                                @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))
                                    @foreach($specialty_users as $val_specialty)
                                    • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                    @endforeach
                                @endif
                            </span>
                        </td>

                        <td class="border phone py-2 text-center">
                            {{ number_format($val->amount, 2, ",", ".") }}
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

                                        <!-- edit -->
                                        <button class="dropdown-item"  type="button" onclick="window.parent.materials_create('Materiais', '{{ route('emergency_services_materials.form', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesMaterials' => base64_encode($val->IdEmergencyServicesMaterials)]) }}', '{{ route('emergency_services_materials.form.update', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdEmergencyServicesMaterials' => base64_encode($val->IdEmergencyServicesMaterials)]) }}')" a="true"><span class="fas fa-edit me-1"></span><span> Editar</span></button>

                                        <!-- delete -->
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item fw-bold" onclick="window.parent.delete_modal_materials('DELETAR',  '{{$val->IdEmergencyServicesMaterials}}', '{{$val->IdEmergencyServicesMaterials}}-table-medications', '{{route('emergency_services_materials.form.delete', ['IdEmergencyServicesMaterials' => base64_encode($val->IdEmergencyServicesMaterials)]) }}')"
                                        data-id="{{ $val->IdEmergencyServicesMaterials }}">
                                            <span class="fas fa-trash-alt me-1"></span>
                                            <span>Deletar</span>
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