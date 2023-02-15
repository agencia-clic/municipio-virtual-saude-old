
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($users_service_units['data']->total()) AND ($users_service_units['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">Unidades</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($users_service_units['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdUsersServiceUnits}}-table">
                        <td class="border name white-space-nowrap py-2">
                            <div class="d-flex d-flex align-items-center">
                                <div class="avatar avatar-xl me-2">
                                    <div class="avatar-name rounded-circle"><span>{{ $mask->AvatarShortName($val->units) }}</span></div>
                                </div>
                                <div class="flex-1">
                                    <h5 class="mb-0 text-1000 fs--1">{{ $val->units }}</h5>
                                </div>
                            </div>
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">
                                        <!-- edit -->
                                        @if($users->level == "u")
                                        <button class="dropdown-item" 
                                        type="button" title="{{ $val->units }}" 
                                        iframe-form=" {{route('users_service_units.form', ['IdUsers' => base64_encode($val->IdUsers), 'IdUsersServiceUnits' => base64_encode($val->IdUsersServiceUnits)])}}" 
                                        iframe-create="{{ route('users_service_units.form.update', ['IdUsers' => base64_encode($val->IdUsers), 'IdUsersServiceUnits' => base64_encode($val->IdUsersServiceUnits)]) }}"><span class="fas fa-edit me-1"></span><span> Editar</span></button>
                                        <div class="dropdown-divider"></div>
                                        @endif

                                        <!-- delete -->
                                        <a class="dropdown-item fw-bold" href="{{route('users_service_units.form.delete', ['IdUsersServiceUnits' => base64_encode($val->IdUsersServiceUnits)])}}" data-id="{{ $val->IdUsersServiceUnits }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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