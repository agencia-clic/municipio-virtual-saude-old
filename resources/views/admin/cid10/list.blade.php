@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<!-- actions - start -->
<div class="mt-3 mb-3">
    <span class="h4 text-800">CID10</span>
    <span class="badge rounded-pill badge-soft-primary">{{ $cid10['count'] }} de {{ $cid10['data']->total() }} registros</span>
</div>

<div class="col-12 mb-2">
    <div class="card border h-100 border-primary">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-sm-auto mb-2 mb-sm-0">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="btn btn-primary" type="button" data-redirect="{{ route('cid10.form') }}"><span class="fas fa-plus"></span></button>
                        <button class="btn btn-primary" title="Filtros" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2"><span class="fas fa-search"></span></button>
                        <button class="btn btn-primary collapsed" type="button" title="Limpar Filtros" data-redirect="{{ route('cid10') }}"><span class="fas fa-times"></span></button>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="row gx-2 align-items-center">
                        <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">CID10</li>
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
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">CID10</h5>
            </div>
        </div>
    </div>
    
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <div class="accordion-collapse collapse {{ app('request')->input('cid10') ? "show" : ""}}" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <form id="formFiltro" action="{{ route('cid10') }}" method="get" enctype="multipart/form-data">
                        <div class="row">			
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="IdCid10_campo" class="form-group">
                                    <label for="IdCid10" id="label_IdCid10">C??digo:</label>
                                    <input type="number" min="1" id="IdCid10" name="IdCid10" class="form-control" value="{{ app('request')->input('IdCid10') }}" maxlength="11" autocomplete="off" />
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

                        <input type="hidden" name="cid10" class="form-control" value="foo"/>
                        <button class="btn btn-outline-primary me-1 mb-1 mt-2 btn-sm" type="submit">FILTRAR</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- table -- start -->
    <div class="card-body p-0">
        <div class="table-responsive scrollbar">
            <table class="table table-sm table-striped fs--1 border mb-0 overflow-hidden">

                @if(!empty($cid10['data']->total()) AND ($cid10['data']->total() > 0))
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort pe-1 white-space-nowrap text-center" width="5%">C??digo</th>
                            <th class="sort pe-1 white-space-nowrap">Titulo</th>
                            <th class="sort pe-1 text-center" width="8%">Status</th>
                            <th class="no-sort text-end" width="5%">A????es</th>
                        </tr>
                    </thead>
                    <tbody class="list list-table" id="table-customers-body">
        
                        @foreach($cid10['data'] as $val)
                            <tr class="btn-reveal-trigger" id="{{$val->IdCid10}}-table">
                                <td class="border email py-2 text-center" width="5%">{{ $val->code }}</td>
                                <td class="border email py-2">{{ $val->title }}</td>
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

                                                @can('roles', ['cid10.update'])
                                                <!-- edit -->
                                                <a class="dropdown-item fw-bold" href="{{route('cid10.form', ['IdCid10' => base64_encode($val->IdCid10)])}}"><span class="fas fa-edit me-1"></span><span> Editar</span></a>
                                                <div class="dropdown-divider"></div>
                                                @endcan

                                                @can('roles', ['cid10.delete'])
                                                <!-- delete -->
                                                <a class="dropdown-item fw-bold" href="{{route('cid10.form.delete', ['IdCid10' => base64_encode($val->IdCid10)])}}" data-id="{{ $val->IdCid10 }}" action="delete"><span class="fas fa-trash-alt me-1"></span><span> Deletar</span></a>
                                                @endcan
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
    {{ $cid10['data']->appends(app('request')->all())->links() }}
    
</div>

@endsection