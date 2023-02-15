
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($classification_manchester['data']->total()) AND ($classification_manchester['data']->total() > 0))

            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">Descrição</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($classification_manchester['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdClassificationManchester}}-table">
                        <td class="border email text-1000 py-2">{{ $val->text }}</td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">

                                        <!-- edit -->
                                        <button class="dropdown-item"  type="button" title="
                                        
                                        @if(app('request')->input('type') == "a")
                                            Alergias Doenças
                                        @else
                                            Antecedentes
                                        @endif
                                        
                                        " iframe-form=" {{ route('classification_manchester.form', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdClassificationManchester' => base64_encode($val->IdClassificationManchester)]) }}" iframe-create="{{ route('classification_manchester.form.update', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdClassificationManchester' => base64_encode($val->IdClassificationManchester)]) }}" a="true"><span class="fas fa-edit me-1"></span><span> Editar</span></button>

                                        <!-- delete -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item fw-bold" href="{{route('classification_manchester.form.delete', ['IdClassificationManchester' => base64_encode($val->IdClassificationManchester)]) }}" data-id="{{ $val->IdClassificationManchester }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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