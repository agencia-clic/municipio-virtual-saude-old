
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($topics_checks['data']->total()) AND ($topics_checks['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">Título</th>
                    <th class="text-center" width="8%">Classificação</th>
                    <th class="no-sort text-end" width="10%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($topics_checks['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdTopicsChecks}}-table">
                        <td class="border name white-space-nowrap py-2">
                            <div class="d-flex d-flex align-items-center">
                                <div class="avatar avatar-xl me-2">
                                    <div class="avatar-name rounded-circle"><span>{{ $mask->AvatarShortName($val->title) }}</span></div>
                                </div>
                                <div class="flex-1">
                                    <h5 class="mb-0 text-1000 fs--1">{{ $val->title }}</h5>
                                </div>
                            </div>
                        </td>

                        <td class="border phone white-space-nowrap py-2 text-end" width="8%">
                            @if($val->classification == "zero_priority")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-danger">PRIORIDADE ZERO
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->classification == "one_priority")
                                <span class="badge badge rounded-pill d-block p-2 very_urgent">PRIORIDADE UM
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @elseif($val->classification == "two_priority")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-success">PRIORIDADE DOIS
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            @else
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">PRIORIDADE TRÊS
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
                                        <!-- edit -->
                                        <button class="dropdown-item" 
                                        type="button" title="Unidade" 
                                        iframe-form=" {{route('topics_checks.form', ['IdTopics' => base64_encode($val->IdTopics), 'IdTopicsChecks' => base64_encode($val->IdTopicsChecks)])}}" 
                                        iframe-create="{{ route('topics_checks.form.update', ['IdTopics' => base64_encode($val->IdTopics), 'IdTopicsChecks' => base64_encode($val->IdTopicsChecks)]) }}"><span class="fas fa-edit me-1"></span><span> Editar</span></button>

                                        <!-- delete -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item fw-bold" href="{{route('topics_checks.form.delete', ['IdTopicsChecks' => base64_encode($val->IdTopicsChecks)])}}" data-id="{{ $val->IdTopicsChecks }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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