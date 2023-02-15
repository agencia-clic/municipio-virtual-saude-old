
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($users_diseases['data']->total()) AND ($users_diseases['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">Descrição</th>
                    <th class="no-sort text-end" width="5%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($users_diseases['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdUsersDiseases}}-table">
                        <td class="border email text-1000 py-2">
                            @if($val->type_allergies == "m")
                                {{ $val->medication_active_principles }} • (<strong>Medicamento</strong>)
                            @else
                                {{ $val->text }}
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
                                        @if(app('request')->input('type') != "a")
                                            <button class="dropdown-item"  type="button" title="
                                            
                                            @if(app('request')->input('type') == "a")
                                                Alergias Doenças
                                            @else
                                                Antecedentes
                                            @endif
                                            
                                            " iframe-form=" {{ route('users_diseases.form', ['type' => app('request')->input('type'), 'IdUsers' => base64_encode($val->IdUsers), 'IdUsersDiseases' => base64_encode($val->IdUsersDiseases)]) }}" iframe-create="{{ route('users_diseases.form.update', ['type' => app('request')->input('type'), 'IdUsers' => base64_encode($val->IdUsers), 'IdUsersDiseases' => base64_encode($val->IdUsersDiseases)]) }}" a="true"><span class="fas fa-edit me-1"></span><span> Editar</span></button>
                                            <div class="dropdown-divider"></div>
                                        @endif

                                        <!-- delete -->
                                        <a class="dropdown-item fw-bold" href="{{route('users_diseases.form.delete', ['IdUsersDiseases' => base64_encode($val->IdUsersDiseases)]) }}" data-id="{{ $val->IdUsersDiseases }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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