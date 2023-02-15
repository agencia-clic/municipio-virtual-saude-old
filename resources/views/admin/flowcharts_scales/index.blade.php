@extends('layouts.admin.app')

@section('content')

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ route('flowcharts.scales.create') }}" novalidate="">


    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" onclick="save_form_items()" type="button"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Inserir</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @csrf <!--token--> 
        
    @if(!empty($flowcharts))
        <div class="card mb-3">
            <div class="card-header">
                <div class="row flex-between-end">
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0">Fluxogramas</h5>
                    </div>
                </div>
            </div>
            
            <div class="card-body bg-light">
            
                @foreach ($flowcharts['data'] as $val)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input flowcharts-save" id="IdFlowcharts-{{ $val->IdFlowcharts }}" name="IdFlowcharts[]" type="checkbox" value="{{ $val->IdFlowcharts }}" @if(!empty($flowcharts_service_units_check) AND (in_array($val->IdFlowcharts, $flowcharts_service_units_check))) checked @endif/>
                        <label class="form-check-label" for="IdFlowcharts-{{ $val->IdFlowcharts }}">{{ $val->title }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- kanban container -->
    <div class="kanban-container scrollbar me-n3">

        <div class="kanban-column border h-100 border-primary rounded" style="width: 400px">
            <div class="kanban-column-header">
                <h5 class="fs-0 mb-0">Colaboradores <span class="text-500">{{ count($users) }}</span></h5>
                <div class="dropdown font-sans-serif btn-reveal-trigger"></div>
            </div>
        
            <div class="kanban-items-container scrollbar" style="min-height: 200px">
        
                @if(!empty($users))

                    @foreach($users as $val)
                        <div class="kanban-item">
                            <div class="card kanban-item-card hover-actions-trigger">
                                <div class="card-body border h-100 border-primary rounded">
                
                                    <input type="hidden" value="{{ $val->IdUsers }}">
                                    <p class="mb-0 fw-medium font-sans-serif stretched-link" data-bs-toggle="modal" data-bs-target="#kanban-modal-1">
                                        <span class="title">
                                            <strong>{{ $val->name }}</strong>
                                            @if(!empty($specialty_users = $val->specialty_users($val->IdUsers)))
                                                @foreach($specialty_users as $val_specialty)
                                                    <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                                @endforeach
                                            @endif
                                        </span>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif

            </div>
        </div>

        @if(!empty($flowcharts_service_units))

            @php $count=0; @endphp
            @foreach ($flowcharts_service_units as $val)

                @if($count++ == 2)
                    @php $count=1; @endphp
                    </div>
                    <div class="kanban-container scrollbar me-n3">
                @endif

                <div class="kanban-column border h-100 border-primary rounded" style="width: 400px">
                    <div class="kanban-column-header">
                        <h5 class="fs-0 mb-0">{{$val->title}} <span class="text-500">({{ $val->count() }})</span></h5>
                        <div class="dropdown font-sans-serif btn-reveal-trigger"></div>
                    </div>

                    <div class="kanban-items-container scrollbar kanban-items-save" id="IdFlowchartsServiceUnits-{{ $val->IdFlowchartsServiceUnits }}" data-IdFlowcharts="{{ $val->IdFlowcharts }}" data-IdFlowchartsServiceUnits="{{ $val->IdFlowchartsServiceUnits }}" style="min-height: 200px">

                        <div id="IdFlowchartsServiceUnits-input-{{ $val->IdFlowchartsServiceUnits }}"></div>

                        @if(!empty($flowcharts_users = $val->users()))
                            @foreach($flowcharts_users as $user_val)

                                <div class="kanban-item">
                                    <div class="card kanban-item-card hover-actions-trigger">
                                        <div class="card-body border h-100 border-primary rounded">

                                            <div class="row d-flex align-items-center">
                                                <input type="hidden" value="{{ $user_val->IdUsers }}">
                                                <p class="mb-0 fw-medium font-sans-serif stretched-link" data-bs-toggle="modal" data-bs-target="#kanban-modal-1">
                                                    <span class="title">
                                                        <strong>{{ $user_val->name }}</strong>
                                                        @if(!empty($specialty_users = $_users->specialty_users($user_val->IdUsers)))
                                                            @foreach($specialty_users as $val_specialty)
                                                            • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                                            @endforeach
                                                        @endif
                                                    </span>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</form>


@endsection

<!-- scripts - start -->
@section('scripts')
<script src="{{ asset('admin/js/modules/flowcharts.js') }}"></script>
<script src="{{ asset('admin/vendors/glightbox/glightbox.min.js') }}"> </script>
<script src="{{ asset('admin/vendors/draggable/draggable.bundle.legacy.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{ asset('admin/vendors/list.js/list.min.js') }}"></script>
@endsection
<!-- end - start -->