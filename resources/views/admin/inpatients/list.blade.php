@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<!-- actions - start -->
<div class="mt-3 mb-3">
    <span class="h4 text-800">Pacientes Internados</span>
    <span class="badge rounded-pill badge-soft-primary">{{ $hospitalization_observation['count'] }} de {{ $hospitalization_observation['data']->total() }} registros</span>
</div>

<div class="col-12 mb-2">
    <div class="card border h-100 border-primary">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-sm-auto mb-2 mb-sm-0">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="btn btn-primary" title="Filtros" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2"><span class="fas fa-search"></span></button>
                        <button class="btn btn-primary collapsed" type="button" title="Limpar Filtros" data-redirect="{{ route('inpatients') }}"><span class="fas fa-times"></span></button>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="row gx-2 align-items-center">
                        <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Pacientes Internados</li>
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
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Pacientes Internados</h5>
            </div>
        </div>
    </div>
    
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <div class="accordion-collapse collapse {{ app('request')->input('hospitalization_observation') ? "show" : ""}}" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <form id="formFiltro" action="{{ route('inpatients') }}" method="get" enctype="multipart/form-data">
                        <div class="row">			
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div id="IdRooms_campo" class="form-group">
                                    <label for="IdRooms" id="label_IdRooms">Código:</label>
                                    <input type="number" min="1" id="IdRooms" name="IdRooms" class="form-control" value="{{ app('request')->input('IdRooms') }}" maxlength="11" autocomplete="off" />
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

                        <input type="hidden" name="hospitalization_observation" class="form-control" value="foo"/>
                        <button class="btn btn-outline-primary me-1 mb-1 mt-2 btn-sm" type="submit">FILTRAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- table -- start -->
    <div class="card-body p-0">
        <div class="table-responsive scrollbar">
            <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">

                @if(!empty($hospitalization_observation['data']->total()) AND ($hospitalization_observation['data']->total() > 0))
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort pe-1 text-center" width="4%">...</th>
                            <th class="sort pe-1 text-center" width="15%">Quarto/Leito</th>
                            <th class="sort pe-1 text-center" width="22%">Paciente</th>
                            <th class="sort pe-1 text-center" width="18%">Profissional / Médico</th>
                            <th class="sort pe-1 text-center" width="25%">Diagnóstico</th>
                            <th class="no-sort text-end" width="5%">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="list list-table" id="table-customers-body">
        
                        @foreach($hospitalization_observation['data'] as $val)

                            <tr class="btn-reveal-trigger" id="{{$val->IdRooms}}-table">
                                <td class="border text-center align-middle">
                                    <div class="avatar avatar-xl me-2">
                                        @if((!empty($val->check_next())) AND ($val->check_next()->num_check == 0 OR (!$mask->nowGreater($val->check_next()->next_run))))
                                            <div class="avatar-name emergency rounded-circle" title="Prescrição Sem Checagem"><span></span></div>
                                        @elseif((!empty($val->check_next())) AND ($mask->dataDifference(date('Y-m-d H:i:m'), $val->check_next()->next_run,'m') <= 10))
                                            <div class="avatar-name very_urgent rounded-circle" title="Prescrição deve ser Checada {{ $mask->dataDifference(date('Y-m-d H:i:s'), $val->check_next()->next_run,'m') }} minutos"><span></span></div>
                                        @else
                                            <div class="avatar-name little_urgent rounded-circle" title="Prescrição Completa @if(!empty($val->check_next()->next_run)) (Proxima: {{ date('d-m-Y H:i', strtotime($val->check_next()->next_run)) }}) @endif"><span></span></div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="mb-0 fs--1"></h5>
                                    </div>
                                </td>
                                <td class="border email py-2 text-center"><strong>{{ $val->rooms }} • {{ $val->rooms_beds }}</strong></td>
                                <td class="border email py-2 text-left">
                                    <strong>{{ $val->patient }} • {{ $mask->birth($val->date_birth_patient) }} ANOS</strong><br>
                                
                                    <span class="badge rounded-pill badge-soft-primary" title="Entrada">{{ date('d-m-Y H:i', strtotime($val->created_at_services)) }}</span>
                                    <span class="badge rounded-pill badge-soft-primary" title="Último atendimento médico">{{ $val->users_responsible_care }}</span>
                                    <span class="badge rounded-pill badge-soft-primary" title="">Atendimento: {{ $val->IdEmergencyServices }}</span>
                                </td>
                                
                                <td class="border email py-2 text-center"> 
                                    <span class="title">
                                        <strong>{{ $val->responsible_doctor }}</strong>
                                        @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsibleDoctor)))
                                            @foreach($specialty_users as $val_specialty)
                                            • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                            @endforeach
                                        @endif
                                    </span>
                                </td>
                                <td class="border phone white-space-nowrap py-2 border text-center">
                                    <strong>
                                        {{$val->code_cid10}} • {{$val->cid10}} •
                                        @if(!empty($val->date_diagnostics))
                                            <span class="badge rounded-pill badge-soft-primary" title="Data Diagnóstico">{{ date('d-m-Y', strtotime($val->date_diagnostics)) }}</span>
                                        @endif
                                    </strong>
                                </td>

                                <td class="border white-space-nowrap py-2 text-end align-middle">
                                    <div class="dropdown font-sans-serif position-static">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                            <span class="fas fa-ellipsis-h fs--1"></span>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                            <div class="bg-white py-2">
                                                <!-- Conduta Médica -->
                                                <a class="dropdown-item fw-bold" href="{{ route('emergency_services_conducts', ['type' => 'i', 'IdEmergencyServices' => base64_encode($val->IdEmergencyServices)]) }}"><span class="fas fa-poll-h me-1"></span><span> Conduta Médica</span></a>
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
    {{ $hospitalization_observation['data']->appends(app('request')->all())->links() }}
    
</div>

@endsection