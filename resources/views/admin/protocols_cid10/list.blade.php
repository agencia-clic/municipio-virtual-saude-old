<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($protocols_cid10['data']->total()) AND ($protocols_cid10['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap text-center" width="5%">Código</th>
                    <th class="sort pe-1 white-space-nowrap">Titulo</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($protocols_cid10['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdProtocolsCid10}}-table">
                        <td class="border email py-2 text-center" width="5%"><strong>{{ $val->code }}</strong></td>
                        <td class="border email py-2"><strong>{{ $val->cid10 }}</strong></td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">

                                        <!-- edit -->
                                        <button class="dropdown-item" 
                                        type="button" title="CID10" 
                                        iframe-form=" {{route('protocols_cid10.form', ['IdProtocols' => base64_encode($val->IdProtocols), 'IdProtocolsCid10' => base64_encode($val->IdProtocolsCid10)])}}" 
                                        iframe-create="{{ route('protocols_cid10.form.update', ['IdProtocols' => base64_encode($val->IdProtocols), 'IdProtocolsCid10' => base64_encode($val->IdProtocolsCid10)]) }}"><span class="fas fa-edit me-1"></span><span> Editar</span></button>

                                        <!-- delete -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item fw-bold" href="{{route('protocols_cid10.form.delete', ['IdProtocolsCid10' => base64_encode($val->IdProtocolsCid10)])}}" data-id="{{ $val->IdProtocolsCid10 }}"  action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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