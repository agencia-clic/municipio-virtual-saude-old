
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($medication_entries_registrations['data']->total()) AND ($medication_entries_registrations['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">...</th>
                    <th class="sort pe-1 text-center" width="8%">Quantidade</th>
                    <th class="sort pe-1 text-center" width="8%">Data de Validade</th>
                    <th class="sort pe-1 text-center" width="8%">Lote</th>
                    <th class="sort pe-1 text-center" width="8%">Códigos Barras</th>
                    <th class="no-sort text-end" width="8%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($medication_entries_registrations['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdMedicationEntriesRegistrations}}-table">
                        <td class="border email text-1000 py-2"><strong>{{ $val->medicines }} • {{ $val->units }}</strong></td>

                        <td class="border phone text-1000 py-2 text-center">
                            {{ $val->amount }}
                        </td>

                        <td class="border phone text-1000 py-2 text-center">
                            {{ date('d-m-Y', strtotime($val->date_venc)) }}
                        </td>

                        <td class="border phone text-1000 py-2 text-center">
                            {{ $val->lote }}
                        </td>

                        <td class="border phone text-1000 py-2 text-center">
                            {{ $val->code }}
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
                                        iframe-form=" {{route('medication_entries_registrations.form', ['IdMedicationEntries' => base64_encode($val->IdMedicationEntries), 'IdMedicationEntriesRegistrations' => base64_encode($val->IdMedicationEntriesRegistrations)])}}" 
                                        iframe-create="{{ route('medication_entries_registrations.form.update', ['IdMedicationEntries' => base64_encode($val->IdMedicationEntries), 'IdMedicationEntriesRegistrations' => base64_encode($val->IdMedicationEntriesRegistrations)]) }}"><span class="fas fa-edit me-1"></span><span> Editar</span></button>
                                        <div class="dropdown-divider"></div>

                                        <!-- delete -->
                                        <a class="dropdown-item fw-bold" href="{{route('medication_entries_registrations.form.delete', ['IdMedicationEntries' => base64_encode($val->IdMedicationEntries), 'IdMedicationEntriesRegistrations' => base64_encode($val->IdMedicationEntriesRegistrations)])}}" data-id="{{ $val->IdMedicationEntriesRegistrations }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
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