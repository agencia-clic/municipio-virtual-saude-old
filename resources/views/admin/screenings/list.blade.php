@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<!-- actions - start -->
<div class="mt-3 mb-3">
    <span class="h4 text-800">Acolhimentos</span>
    <span class="badge rounded-pill badge-soft-primary">{{ $emergency_services['count'] }} de {{ $emergency_services['data']->total() }} registros</span>
</div>

<div class="col-12 mb-2">
    <div class="card border h-100 border-primary">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-sm-auto mb-2 mb-sm-0">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="btn btn-primary" title="Filtros" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2"><span class="fas fa-search"></span></button>
                        <button class="btn btn-primary collapsed" type="button" title="Limpar Filtros" data-redirect="{{ route('screenings') }}"><span class="fas fa-times"></span></button>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="row gx-2 align-items-center">
                        <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Acolhimentos</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- actions - end -->

<div class="card mb-3">

    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Atendimentos</h5>
            </div>
        </div>
    </div>
    
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <div class="accordion-collapse collapse {{ app('request')->input('screenings') ? "show" : ""}}" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <form id="formFiltro" action="{{ route('screenings') }}" method="get" enctype="multipart/form-data">
                        <div class="row">			
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="IdEmergencyServices_campo" class="form-group">
                                    <label for="IdEmergencyServices" id="label_IdEmergencyServices">Código:</label>
                                    <input type="number" min="1" id="IdEmergencyServices" name="IdEmergencyServices" class="form-control" value="{{ app('request')->input('IdEmergencyServices') }}" maxlength="11" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="status_campo" class="form-group">
                                    <label for="status" id="label_status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" selected="selected">...</option>
                                        <option value="a" {{ app('request')->input('status') == "a" ? "selected" : ""}}>Ativo</option>
                                        <option value="b" {{ app('request')->input('status') == "b" ? "selected" : ""}}>Bloqueado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="types_campo" class="form-group">
                                    <label for="types" id="label_types">Tipo:</label>
                                    <select name="types" id="types" class="form-control">
                                        <option value="acol" {{ app('request')->input('types') == "acol" ? "selected" : ""}}>Aguardando Acolhimento</option>
                                        <option value="acol-s" {{ app('request')->input('types') == "acol-s" ? "selected" : ""}}>Em Acolhimento</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="name_campo" class="form-group">
                                    <label for="name" id="label_name">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ app('request')->input('name') }}" maxlength="100" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div id="cpf_cnpj_campo" class="form-group">
                                    <label for="cpf_cnpj" id="label_cpf_cnpj">CPF</label>
                                    <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control" value="{{ app('request')->input('cpf_cnpj') }}" maxlength="100" autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="screenings" class="form-control" value="foo"/>
                        <input type="hidden" id="page" class="form-control" value="{{ app('request')->input('page') }}"/>
                        <button class="btn btn-outline-primary me-1 mb-1 mt-2 btn-sm" type="submit">FILTRAR</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- table -->
    <div id="table-screenings" url="{{ route('screenings.table') }}" data-id="{{ auth()->user()->units_current()->IdServiceUnits ?? ""}}"></div>
    
</div>
@endsection

<!-- scripts -->
@section('scripts')
<script src="{{ asset('admin/js/modules/screenings-list.js') }}"></script>
<script src="{{ asset('admin/js/modules/emergency_services.js') }}" type="text/javascript"></script>
@endsection