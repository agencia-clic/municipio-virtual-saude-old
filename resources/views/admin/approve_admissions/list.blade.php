@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<!-- actions - start -->
<div class="mt-3 mb-3">
    <span class="h4 text-800">Aprovação de Internação</span>
    <span class="badge bg-primary">
        @if ($admit_patient_requests->firstItem())
            <span class="font-medium">{{ $admit_patient_requests->firstItem() }}</span>
            {!! __('até') !!}
            <span class="font-medium">{{ $admit_patient_requests->lastItem() }}</span>
        @else
            {{ $admit_patient_requests->count() }}
        @endif
        {!! __('de') !!}
        <span class="font-medium">{{ $admit_patient_requests->total() }}</span>
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
                        <button class="btn btn-primary btn-sm collapsed" type="button" title="Limpar Filtros" data-redirect="{{ route('approve_admissions') }}"><span class="fas fa-times"></span></button>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="row gx-2 align-items-center">
                        <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Aprovação de Internação</li>
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
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Aprovação de Internação</h5>
            </div>
        </div>
    </div>
    
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <div class="accordion-collapse collapse {{ app('request')->input('approve_admissions') ? "show" : ""}}" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <form id="formFiltro" action="{{ route('approve_admissions') }}" method="get" enctype="multipart/form-data">
                        <div class="row">			
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="IdAdmitPatientRequests_campo" class="form-group">
                                    <label for="IdAdmitPatientRequests" id="label_IdAdmitPatientRequests">Código:</label>
                                    <input type="number" min="1" id="IdAdmitPatientRequests" name="IdAdmitPatientRequests" class="form-control form-control-sm" value="{{ app('request')->input('IdAdmitPatientRequests') }}" maxlength="11" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="status_campo" class="form-group">
                                    <label for="status" id="label_status">Status:</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="" selected="selected">...</option>
                                        <option value="a" {{ app('request')->input('status') == "a" ? "selected" : ""}}>Ativo</option>
                                        <option value="b" {{ app('request')->input('status') == "b" ? "selected" : ""}}>Bloqueado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="title_campo" class="form-group">
                                    <label for="title" id="label_title">Titulo</label>
                                    <input type="text" id="title" name="title" class="form-control form-control-sm" value="{{ app('request')->input('title') }}" maxlength="100" autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="admit_patient_requests" class="form-control form-control-sm" value="foo"/>
                        <button class="btn btn-outline-primary me-1 mb-1 mt-2 btn-sm" type="submit">FILTRAR</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- table - start -->
    <div id="table-admit_patient_requests" url="{{route('approve_admissions.table', app('request')->all())}}"></div>

    <!-- paginations -- start -->
    {{ $admit_patient_requests->appends(app('request')->all())->links() }}
    
</div>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="{{ asset('admin/js/modules/approve_admissions.js') }}"></script>
@endsection