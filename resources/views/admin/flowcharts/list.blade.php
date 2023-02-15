@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-sm-auto mb-2 mb-sm-0">
                <h6 class="mb-0">{{ $flowcharts['count'] }} de {{ $flowcharts['data']->total() }} registros</h6>
            </div>
            <div class="col-sm-auto">
                <div class="row gx-2 align-items-center">
                    <div class="col-auto">
                        <button class="btn btn-falcon-default btn-sm me-2" role="button">Fluxogramas</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3" id="customersTable" data-list=''>

    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Fluxogramas</h5>
            </div>
            <div class="col-8 col-sm-auto text-end ps-2">
                <div id="table-customers-replace-element">
                    <a href="{{ route('flowcharts.form') }}">
                        <button class="btn btn-falcon-default btn-sm" type="button">
                            <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                            <span class="d-none d-sm-inline-block ms-1">Novo registro</span>
                        </button>
                    </a>

                    <button class="btn btn-falcon-default btn-sm mx-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        <span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span>
                        <span class="d-none d-sm-inline-block ms-1">Filtros</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <div class="accordion-collapse collapse {{ app('request')->input('flowcharts') ? "show" : ""}}" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <form id="formFiltro" action="{{ route('flowcharts') }}" method="get" enctype="multipart/form-data">
                        <div class="row">			
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="IdFlowcharts_campo" class="form-group">
                                    <label for="IdFlowcharts" id="label_IdFlowcharts">Código:</label>
                                    <input type="number" min="1" id="IdFlowcharts" name="IdFlowcharts" class="form-control" value="{{ app('request')->input('IdFlowcharts') }}" maxlength="11" autocomplete="off" />
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
                                <div id="title_campo" class="form-group">
                                    <label for="title" id="label_title">Titulo</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ app('request')->input('title') }}" maxlength="100" autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="flowcharts" class="form-control" value="foo"/>
                        <button class="btn btn-outline-primary me-1 mb-1 mt-2 btn-sm" type="submit">FILTRAR</button>
                        <a href="{{ route('flowcharts') }}"><button class="btn btn-outline-primary me-1 mb-1 mt-2 btn-sm" type="button">LIMPAR FILTROS</button></a>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- table -- start -->
    <div class="card-body p-0">
        <div class="table-responsive scrollbar">
            <table class="table table-sm table-striped fs--1 border mb-0 overflow-hidden">

                @if(!empty($flowcharts['data']->total()) AND ($flowcharts['data']->total() > 0))
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort pe-1 white-space-nowrap">Titulo</th>
                            <th class="sort pe-1 text-center" width="8%">Status</th>
                            <th class="no-sort text-end" width="5%">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="list list-table" id="table-customers-body">
        
                        @foreach($flowcharts['data'] as $val)
                            <tr class="btn-reveal-trigger" id="{{$val->IdFlowcharts}}-table">
                                
                                <td class="border email py-2">
                                    <strong>{{ $val->title }}</strong>
                                </td>

                                <td class="border phone white-space-nowrap py-2 text-end" width="5%">
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
                                                <a class="dropdown-item fw-bold" href="{{route('flowcharts.form', ['IdFlowcharts' => base64_encode($val->IdFlowcharts)])}}"><span class="fas fa-edit me-1"></span><span> Editar</span></a>

                                                <!-- delete -->
                                                @canany(['isSuper'])
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item fw-bold" href="{{route('flowcharts.form.delete', ['IdFlowcharts' => base64_encode($val->IdFlowcharts)])}}" data-id="{{ $val->IdFlowcharts }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
                                                @endcanany
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
    {{ $flowcharts['data']->appends(app('request')->all())->links() }}
    
</div>

@endsection