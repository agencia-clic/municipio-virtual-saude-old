@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<!-- actions - start -->
<div class="mt-3 mb-3">
    <span class="h4 text-800">Procedimentos</span>
    <span class="badge bg-primary">
        @if ($procedures_groups->firstItem())
            <span class="font-medium">{{ $procedures_groups->firstItem() }}</span>
            {!! __('até') !!}
            <span class="font-medium">{{ $procedures_groups->lastItem() }}</span>
        @else
            {{ $procedures_groups->count() }}
        @endif
        {!! __('de') !!}
        <span class="font-medium">{{ $procedures_groups->total() }}</span>
        {!! __('registros') !!}
    </span>    
</div>

<div class="col-12 mb-2">
    <div class="card border h-100 border-primary">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-sm-auto mb-2 mb-sm-0">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="btn btn-primary btn-sm" title="Filtros" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2"><span class="fas fa-search"></span></button>
                        <button class="btn btn-primary btn-sm collapsed" type="button" title="Limpar Filtros" data-redirect="{{ route('emergency_services_procedures.list.run') }}"><span class="fas fa-times"></span></button>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="row gx-2 align-items-center">
                        <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Procedimentos</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- actions - end -->

<div class="card mb-3" id="customersTable" data-list=''>

    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Procedimentos</h5>
            </div>
        </div>
    </div>
    
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <div class="accordion-collapse collapse {{ app('request')->input('medical_care') ? "show" : ""}}" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <form id="formFiltro" action="{{ route('emergency_services_procedures.list.run') }}" method="get" enctype="multipart/form-data">
                        <div class="row">			
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="IdEmergencyServicesProcedures_campo" class="form-group">
                                    <label for="IdEmergencyServicesProcedures" id="label_IdEmergencyServicesProcedures">Código:</label>
                                    <input type="number" min="1" id="IdEmergencyServicesProcedures" name="IdEmergencyServicesProcedures" class="form-control form-control-sm" value="{{ app('request')->input('IdEmergencyServicesProcedures') }}" maxlength="11" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="status_campo" class="form-group">
                                    <label for="status" id="label_status">Status:</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="open" {{ app('request')->input('status') == "open" ? "selected" : ""}}>Aguardando</option>
                                        <option value="executed" {{ app('request')->input('status') == "executed" ? "selected" : ""}}>Executados</option>
                                        <option value="refused" {{ app('request')->input('status') == "refused" ? "selected" : ""}}>Resusados</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="name_campo" class="form-group">
                                    <label for="name" id="label_name">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-sm" value="{{ app('request')->input('name') }}" maxlength="100" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="cpf_cnpj_campo" class="form-group">
                                    <label for="cpf_cnpj" id="label_cpf_cnpj">CPF</label>
                                    <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control form-control-sm" value="{{ app('request')->input('cpf_cnpj') }}" maxlength="100" autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="medical_care" class="form-control form-control-sm" value="foo"/>
                        <input type="hidden" id="page" class="form-control form-control-sm" value="{{ app('request')->input('page') }}"/>
                        <button class="btn btn-outline-primary me-1 mb-1 mt-2 btn-sm" type="submit">FILTRAR</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- table -- start -->
    <div class="table-responsive scrollbar mt-2">
        <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

            @if(!empty($procedures_groups->total()) AND ($procedures_groups->total() > 0))
                <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort pe-1 white-space-nowrap text-left">Paciente</th>
                        <th class="sort pe-1 white-space-nowrap text-center" width="20%">Profissional</th>
                        <th class="text-center" width="15%">
                            Procedimentos 
                            @if(app('request')->input('status') == "refused")
                                Resusados
                            @elseif(app('request')->input('status') == "executed")
                                Executados
                            @else
                                Aguardando
                            @endif
                        </th>
                        <th class="text-center" width="15%">Data</th>
                        <th class="sort pe-1 text-center" width="5%">Código</th>
                        <th class="no-sort text-end" width="5%">Ações</th>
                    </tr>
                </thead>
                <tbody class="list list-table" id="table-customers-body">

                    @foreach($procedures_groups as $val)

                        <tr class="btn-reveal-trigger" id="{{$val->IdProceduresGroups}}-table">

                            <td class="border phone py-2 text-left">
                                {{ $val->patient }}
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

                            <td class="border email py-2 text-center">
                                <strong>{{ $val->procedures_wait(app('request')->input('status') ?? "open") }}</strong>
                            </td>

                            <td class="border email py-2 text-center">
                                <strong>{{ $val->created_at->format('d-m-Y H:i') }}</strong>
                            </td>

                            <td class="border align-middle text-center fs-0 white-space-nowrap payment"> 
                                <strong>{{ $val->IdProceduresGroups }}</strong>
                            </td>

                            <td class="border white-space-nowrap py-2 text-end">
                                <div class="dropdown font-sans-serif position-static">
                                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                        <span class="fas fa-ellipsis-h fs--1"></span>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                        <div class="bg-white py-2">

                                            @if($val->IdUsersResponsible == auth()->user()->IdUsers)
                                            
                                                <!-- run -->
                                                <a class="dropdown-item procedures-run-button" href="{{ route('emergency_services_conducts', ['type' => 'p', 'IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'tab' => 'nursing', 'subtab' => 'procedures']) }}"><span class="fas fa-eye me-1"></span><span> <strong>Visualizar</strong></span></a>

                                            @else
                                                <a class="dropdown-item fw-bold disabled" href="!#"><span class="fas fa-edit me-1"></span><span> Editar</span></a>
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

    <!-- paginations -- start -->
    {{ $procedures_groups->appends(app('request')->all())->links() }}
        
</div>
@endsection