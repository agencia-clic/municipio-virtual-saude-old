@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Procedimentos / Exames</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        <div id="table-list" data-iframe="{{ route('emergency_services_procedures.table.run', ['IdEmergencyServices' => $IdEmergencyServices, 'IdProceduresGroups' => $IdProceduresGroups]) }}"></div>
    </div>
</div>

<input id="IdEmergencyServicesProcedures" name="IdEmergencyServicesProcedures" class="hide" value=""/>

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
<script src="{{ asset('admin/js/modules/emergency_services_procedures.js') }}" type="text/javascript"></script>

@endsection
<!-- end - start -->