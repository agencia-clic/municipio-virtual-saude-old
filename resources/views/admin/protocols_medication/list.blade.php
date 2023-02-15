
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($protocols_medication['data']->total()) AND ($protocols_medication['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">Medicamentos</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($protocols_medication['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdProtocolsMedication}}-protocols_medication-table">
                        <td class="border name white-space-nowrap py-2">
                            <div class="d-flex d-flex align-items-center">
                                <div class="avatar avatar-xl me-2">
                                    <div class="avatar-name rounded-circle"><span>{{ $mask->AvatarShortName($val->medicines) }}</span></div>
                                </div>
                                <div class="flex-1">
                                    <h5 class="mb-0 text-1000 fs--1">{{ $val->medicines }} • {{ $val->units }}</h5>
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
                                        <button class="dropdown-item" 
                                        type="button" title="Medicamentos" 
                                        iframe-form=" {{route('protocols_medication.form', ['IdProtocols' => base64_encode($val->IdProtocols), 'IdProtocolsMedication' => base64_encode($val->IdProtocolsMedication)])}}" 
                                        iframe-create="{{ route('protocols_medication.form.update', ['IdProtocols' => base64_encode($val->IdProtocols), 'IdProtocolsMedication' => base64_encode($val->IdProtocolsMedication)]) }}"><span class="fas fa-edit me-1"></span><span> Editar</span></button>

                                        <!-- delete -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item fw-bold" href="{{route('protocols_medication.form.delete', ['IdProtocolsMedication' => base64_encode($val->IdProtocolsMedication)])}}" data-id="{{ $val->IdProtocolsMedication }}" data-id-delete="{{$val->IdProtocolsMedication}}-protocols_medication-table" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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