
<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($emergency_services_files['data']->total()) AND ($emergency_services_files['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="text-left" width="3%"></th>
                    <th class="sort text-center" width="10%">Arquivo</th>
                    <th class="text-left" >Título</th>
                    <th class="text-center" width="25%">Responsavel</th>
                    <th class="text-center" width="10%">Data</th>
                    <th class="no-sort text-end">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">
                @foreach($emergency_services_files['data'] as $val)
                    <tr class="btn-reveal-trigger" id="{{$val->IdEmergencyServicesFiles}}-table">

                        <td class="border text-left">
                            {{ $val->IdEmergencyServicesFiles }}
                        </td>

                        <td class="border email py-2 text-center">
                            <a href="{{ Storage::url($val->path) }}" target="_blank" download>
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-cloud-download-alt fs--1"></span>
                                </button>
                            </a>
                        </td>

                        <td class="border email py-2">
                            <strong>{{ $val->title }}</strong>
                        </td>

                        <td class="border email py-2 text-center">
                            <strong>{{ $val->responsible }}</strong>
                            @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))
                                @foreach($specialty_users as $val_specialty)
                                • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                @endforeach
                            @endif
                        </td>

                        <td class="border email py-2 text-center">
                            {{ $val->created_at->format('d-m-Y H:i') }}
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">
                    
                                        <!-- delete -->
                                        @if($val->IdUsersResponsible == auth()->user()->IdUsers)
                                            <a class="dropdown-item fw-bold" href="{{route('emergency_services_files.form.delete', ['IdEmergencyServicesFiles' => base64_encode($val->IdEmergencyServicesFiles)]) }}" data-id="{{ $val->IdEmergencyServicesFiles }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
                                        @else
                                            <a class="dropdown-item fw-bold disabled" href="!#"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
                                        @endif
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