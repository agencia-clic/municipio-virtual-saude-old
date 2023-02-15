@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-sm-auto mb-2 mb-sm-0">
                <h6 class="mb-0">{{ $screenings['count'] }} de {{ $screenings['data']->total() }} registros</h6>
            </div>
            <div class="col-sm-auto">
                <div class="row gx-2 align-items-center">
                    <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('screenings')}}">Acolhimento</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Todos Acolhimento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- info users current -->
<div class="col-sm-12 col-md-12">
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5>
                        <h6 class="alert-heading fw-semi-bold">
                        <span class="mt-1"> {{ $emergency_services->users_name }}
                            @if($emergency_services->users_cpf_cnpj)
                                • {{ $mask->cpf_cnpj($emergency_services->users_cpf_cnpj) }}
                            @endif
                
                            @if($emergency_services->users_date_birth)
                                • {{ $mask->birth($emergency_services->users_date_birth) }} ANOS
                            @endif</span> 
                        </h6>
                
                        <h6 class="alert-heading fw-semi-bold">
                            <span class="h6 alert-heading fw-semi-bold"><strong>Atendimento:</strong> {{$emergency_services->IdEmergencyServices}}</span>
                            • <span class="h6 alert-heading fw-semi-bold"><strong>Entrada:</strong> {{ $emergency_services->created_at->format('d-m-Y H:i') }}</span> 
                        </h6>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card mb-3" id="customersTable" data-list=''>

    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Acolhimento Triagens</h5>
            </div>
            <div class="col-8 col-sm-auto text-end ps-2">
                <div id="table-customers-replace-element">

                    <!-- new data -->
                    <a href="{{ route('screenings.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}">
                        <button class="btn btn-falcon-default btn-sm" type="button">
                            <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                            <span class="d-none d-sm-inline-block ms-1">Novo registro</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- table -- start -->
    <div class="card-body p-0">
        <div class="table-responsive scrollbar">
            <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden border">

                @if(!empty($screenings['data']->total()) AND ($screenings['data']->total() > 0))
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort pe-1 white-space-nowrap">Atendimento</th>
                            <th class="sort pe-1 text-center" width="8%">Especialista</th>
                            <th class="sort pe-1 text-center" width="8%">Classificação</th>
                            <th class="sort pe-1 text-center" width="4%">Data</th>
                            <th class="no-sort text-end" width="5%">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="list list-table" id="table-customers-body">

                        @foreach($screenings['data'] as $val)
                            <tr class="btn-reveal-trigger" id="{{$val->IdScreenings}}-table">

                                <td class="border phone white-space-nowrap py-2">
                                    @if($val->type == "a")
                                        Atendimento Medico
                                    @elseif($val->type == "l")
                                        Paciente Liberado
                                    @else
                                        Paciente Encaminhado
                                    @endif
                                </td>

                                <td class="border phone white-space-nowrap py-2 text-center" width="8%">{{ $val->specialties }}</td>

                                <td class="border phone white-space-nowrap py-2 text-center" width="8%">
                                    @if($val->classification == 4)
                                       <span class="badge emergency">Emergência</span>
                                    @elseif($val->classification == 3)
                                        <span class="badge very_urgent">Muito Urgente</span>
                                    @elseif($val->classification == 2)
                                       <span class="badge urgent">Urgente</span>
                                    @elseif($val->classification == 1)
                                       <span class="badge little_urgent">Pouco Urgente</span>
                                    @else
                                        <span class="badge not_urgent">Não urgente</span>
                                    @endif
                                 </td>

                                <td class="border phone white-space-nowrap py-2 text-center" width="5%">
                                   {{ date('d-m-Y H:i', strtotime($val->created_at)) }}
                                </td>
                               
                                <td class="border white-space-nowrap py-2 text-end">
                                    <div class="dropdown font-sans-serif position-static">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                            <span class="fas fa-ellipsis-h fs--1"></span>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                            <div class="bg-white py-2">
                                                <!-- responsabilit -->
                                                <a class="dropdown-item fw-bold"><span class="fas fa-id-card me-1"></span><span class="text-primary"> {{ $val->responsible }}</span></a>
                                                <div class="dropdown-divider"></div>

                                                <!-- edit -->
                                                <a class="dropdown-item fw-bold" href="{{ route('screenings.form', ['action' => app('request')->input('action'), 'IdEmergencyServices' => base64_encode($val->IdEmergencyServices),'IdScreenings' => base64_encode($val->IdScreenings)]) }}"><span class="fas fa-eye me-1"></span><span> Visualizar</span></a>
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
    {{ $screenings['data']->appends(app('request')->all())->links() }}
    
</div>

@endsection