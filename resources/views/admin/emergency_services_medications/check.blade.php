@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<!-- info users current -->
<div class="col-12 mb-2">
    <div class="card border h-100 border-primary mt-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-sm-auto">
                    <h5>
                        <h6 class="alert-heading fw-semi-bold">
                            <span class="mt-1">
                                <strong>{{ $medication_groups->responsible }}</strong>
                                @if(!empty($specialty_users = $users->specialty_users($medication_groups->IdUsersResponsible)))
                                    @foreach($specialty_users as $val_specialty)
                                    • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                    @endforeach
                                @endif
                            </span> 
                        </h6>
                
                        <h6 class="alert-heading fw-semi-bold">
                            <span class="h6 alert-heading"><strong>Data/Hora:</strong> {{ date('d-m-Y H:i', strtotime($medication_groups->created_at)) }} </span>
                        </h6>

                        <h6 class="alert-heading fw-semi-bold">
                            <span class="h6 alert-heading"><strong>Observação:</strong>  {{ $medication_groups->note }} </span> 
                        </h6>
                    </h5>
                </div>

                <div class="col-sm-auto mb-2 mb-sm-0">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button class="btn btn-primary btn-sm" type="button" id="save-medication-check" data-url="{{ route('emergency_services_medications.save.check', ['IdEmergencyServices' => base64_encode($medication_groups->IdEmergencyServices), 'IdMedicationGroups' => base64_encode($medication_groups->IdMedicationGroups)]) }}"><span class="fas fa-save"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Administrar Prescrição</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        <div data-iframe="{{ route('emergency_services_medications.table.check', ['IdEmergencyServices' => $IdEmergencyServices, 'IdMedicationGroups' => $IdMedicationGroups]) }}"></div>
    </div>
</div>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Prescrições Administradas</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        <div data-iframe="{{ route('emergency_services_medications.check.admin', ['IdEmergencyServices' => $IdEmergencyServices, 'IdMedicationGroups' => $IdMedicationGroups]) }}"></div>
    </div>
</div>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Materiais Utilizados</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        <div data-iframe="{{ route('emergency_services_materials', ['IdEmergencyServices' => $IdEmergencyServices]) }}"></div>

        <div class="col-12 mt-2">
            <button class="btn btn-primary btn-sm materials-create" type="button" onclick="window.parent.materials_create('Materiais', '{{ route('emergency_services_materials.form', ['IdEmergencyServices' => $IdEmergencyServices]) }}', '{{ route('emergency_services_materials.form.create', ['IdEmergencyServices' => $IdEmergencyServices]) }}')">Inserir</button>
        </div>
    </div>
</div>

@endsection

<!-- scripts - start -->
@section('scripts')

<script>
    @if(empty($medical_care))
        //localStorage.setItem('block-item-select', '')
    @endif
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/iframe.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/medication_groups.js') }}" type="text/javascript"></script>

@endsection
<!-- end - start -->