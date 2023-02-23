@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<!-- actions - start -->
<div class="mt-3 mb-3">
    <span class="h5 text-800">Unidades</span>
    <span class="badge bg-primary">
        @if ($service_units->firstItem())
            <span class="font-medium">{{ $service_units->firstItem() }}</span>
            {!! __('até') !!}
            <span class="font-medium">{{ $service_units->lastItem() }}</span>
        @else
            {{ $service_units->count() }}
        @endif
        {!! __('de') !!}
        <span class="font-medium">{{ $service_units->total() }}</span>
        {!! __('registros') !!}
    </span>
</div>

<div class="col-12 mb-2">
    <div class="card border h-100 border-primary rounded">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-sm-auto mb-2 mb-sm-0">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="btn btn-primary btn-sm" type="button" data-redirect="{{ route('service_units.form') }}"><span class="fas fa-plus"></span></button>
                        <button class="btn btn-primary btn-sm" title="Filtros" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2"><span class="fas fa-search"></span></button>
                        <button class="btn btn-primary btn-sm collapsed" type="button" title="Limpar Filtros" data-redirect="{{ route('service_units') }}"><span class="fas fa-times"></span></button>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="row gx-2 align-items-center">
                        <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Unidades</li>
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
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Unidades</h5>
            </div>
            <div class="col-8 col-sm-auto text-end ps-2">
                <div class="d-none" id="table-customers-actions">
                    <div class="d-flex">
                        <select class="form-select form-select-sm" aria-label="Bulk actions">
                            <option selected="">Bulk actions</option>
                            <option value="Refund">Refund</option>
                            <option value="Delete">Delete</option>
                            <option value="Archive">Archive</option>
                        </select>
                        <button class="btn btn-falcon-default btn-sm ms-2" type="button">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <div class="accordion-collapse collapse {{ app('request')->input('service_units') ? "show" : ""}}" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <form id="formFiltro" action="{{ route('service_units') }}" method="get" enctype="multipart/form-data">
                        <div class="row">			
                            <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2">
                                <div id="IdServiceUnits_campo" class="form-group">
                                    <label for="IdServiceUnits" id="label_IdServiceUnits">Código:</label>
                                    <input type="number" min="1" id="IdServiceUnits" name="IdServiceUnits" class="form-control form-control-sm" value="{{ app('request')->input('IdServiceUnits') }}" maxlength="11" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2">
                                <div id="status_campo" class="form-group">
                                    <label for="status" id="label_status">Status:</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="" selected="selected">...</option>
                                        <option value="a" {{ app('request')->input('status') == "a" ? "selected" : ""}}>Ativo</option>
                                        <option value="b" {{ app('request')->input('status') == "b" ? "selected" : ""}}>Bloqueado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                <div id="name_campo" class="form-group">
                                    <label for="name" id="label_name">Nome/Razão Social</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-sm" value="{{ app('request')->input('name') }}" maxlength="100" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-2 col-xl-4">	
                                <div id="email_campo" class="form-group">
                                    <label for="email" id="label_email">E-mail:</label>
                                    <input type="text" id="email" name="email" class="form-control form-control-sm" value="{{ app('request')->input('email') }}" maxlength="100" autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="service_units" class="form-control form-control-sm" value="foo"/>
                        <button class="btn btn-outline-primary me-1 mb-1 mt-2 btn-sm" type="submit">FILTRAR</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- table -- start -->
    <div class="card-body p-0">
        <div class="table-responsive scrollbar">
            <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden">

                @if(!empty($service_units->total()) AND ($service_units->total() > 0))
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort pe-1 white-space-nowrap">Name</th>
                            <th class="sort pe-1 white-space-nowrap text-center" width="10%">Código</th>
                            <th class="sort pe-1 white-space-nowrap text-center" width="15%">Responsavel</th>
                            <th class="sort pe-1 white-space-nowrap text-center" width="10%">Email</th>
                            <th class="sort pe-1 white-space-nowrap text-center" width="10%">Telefone</th>
                            <th class="sort pe-1 white-space-nowrap text-center" width="5%">Status</th>
                            <th class="no-sort text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="list list-table" id="table-customers-body">
        
                        @foreach($service_units as $val)
                            <tr class="btn-reveal-trigger" id="{{$val->IdServiceUnits}}-table">
                                <td class="border name white-space-nowrap py-2">
                                    <div class="d-flex d-flex align-items-center">
                                        <div class="avatar avatar-xl me-2">
                                            <div class="avatar-name rounded-circle"><span>{{ $val->acronym }}</span></div>
                                        </div>
                                        <div class="flex-1">
                                            <h5 class="mb-0 fs--1">{{ $val->name }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="border email py-2 text-center">{{ $val->code }}</td>
                                <td class="border email py-2 text-center">{{ $val->responsible }}</td>
                                <td class="border email py-2 text-center">{{ $val->email }}</td>

                                <td class="border phone white-space-nowrap py-2 text-center">{{ Mask::default($val->phone, '(##) ####-####') }}</td>

                                <td class="border phone white-space-nowrap py-2 text-center">
                                    @if($val->status == "a")
                                        <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Ativo
                                            <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                        </span>
                                    @else
                                        <span class="badge badge rounded-pill d-block badge-soft-secondary">Bloqueado
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
                                                <a class="dropdown-item fw-bold" href="{{route('service_units.form', ['IdServiceUnits' => base64_encode($val->IdServiceUnits)])}}"><span class="fas fa-edit me-1"></span><span> Editar</span></a>

                                                <!-- delete -->
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item fw-bold" href="{{route('service_units.form.delete', ['IdServiceUnits' => base64_encode($val->IdServiceUnits)])}}" data-id="{{ $val->IdServiceUnits }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                    @else
                        <tbody>
                            <tr>
                                <td><div class="alert alert-primary mt-1" role="alert">Nenhum registro encontrado.</div></td>
                            </tr>
                        </tbody>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <!-- table -- end -->

    <!-- paginations -- start -->
    {{ $service_units->appends(app('request')->all())->links() }}
    
</div>

@endsection