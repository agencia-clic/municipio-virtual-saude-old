@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Conteúdo</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">

        <div class="row mt-1">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="note_medication_fields" class="form-group">
                    <label class="form-label" for="note_medication_label">Observação</label>
                    <textarea class="form-control form-control-sm @error('note_medication') is-invalid @enderror" id="note_medication" name="note_medication" rows="5" required>{{ $medication_groups->note ?? "" }}</textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary btn-sm mt-2 hide" id="send-form" type="button" onclick="save_medicines()" data-url="{{ route('emergency_services_medications.form.create', ['IdEmergencyServices' => $IdEmergencyServices, 'IdMedicationGroups' => $IdMedicationGroups]) }}">Adicionar</button>
    </div>
</div>

<!-- fields medication start -->
<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Medicação</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        @include('layouts/admin/fragments.emergency_services_medications_fields')
    </div>
</div>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Prescrições</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        <div id="table-list" data-iframe="{{ route('emergency_services_medications.table', ['IdEmergencyServices' => $IdEmergencyServices, 'IdMedicationGroups' => $IdMedicationGroups]) }}"></div>
    </div>
</div>

<input id="IdEmergencyServicesMedications" name="IdEmergencyServicesMedications" class="hide" value=""/>

<!--- Prescrições Administradas -->
@if(!empty($IdMedicationGroups))
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
@endif

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

<script src="{{ asset('admin/js/modules/validate_medications.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/emergency_services_medications.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>

<link href="{{ asset('admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/pt.js"></script>
<script src="{{ asset('admin/js/flatpickr.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#amount_prescription').mask("#.##0,00", {reverse: true});
    })
</script>

@endsection
<!-- end - start -->