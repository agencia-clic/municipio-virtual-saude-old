
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($rooms_beds['data']->total()) AND ($rooms_beds['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">Leito</th>
                    <th class="sort pe-1 text-center" width="15%">Observação</th>
                    <th class="sort pe-1 text-center" width="10%">Código</th>
                    <th class="sort pe-1 text-center" width="10%">Status</th>
                    <th class="no-sort text-end" width="5%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($rooms_beds['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdRoomsBeds}}-table">
                        <td class="border email py-2"><strong>{{ $val->title }}</strong></td>
                        <td class="border email py-2 text-center"><strong>{{ $val->note }}</strong></td>
                        <td class="border email py-2 text-center"><strong>{{ $val->code }}</strong></td>

                        <td class="border phone white-space-nowrap py-2 border text-center" width="5%">
                            @if($val->status == "d")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-success"> DISPONÍVEL
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span> 
                                </span>
                            @elseif($val->status == "l")
                                <span class="badge badge rounded-pill p-2 d-block badge-soft-primary"> LIMPEZA
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span> 
                                </span>
                            @elseif($val->status == "o")
                                <span class="badge badge rounded-pill p-2 d-block badge-soft-secondary"> OCUPADO
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
                                        <!-- edit -->
                                        <button class="dropdown-item" 
                                        type="button" title="Unidade" 
                                        iframe-form=" {{route('rooms_beds.form', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}" 
                                        iframe-create="{{ route('rooms_beds.form.update', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)]) }}"><span class="fas fa-edit me-1"></span><span> <strong>Editar</strong></span></button>

                                        <!-- delete -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item fw-bold" href="{{route('rooms_beds.form.delete', ['IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}" data-id="{{ $val->IdRoomsBeds }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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