
<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <label for="name_users_run_filter_filter" id="label_name_users_run_filter"><strong>Nome FILTRO:</strong></label>
        <div class="input-group mb-2">
            <input type="text" id="name_users_run_filter" name="name_users_run_filter" class="form-control" oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="IdUsersResponsibleRunProcedures_fields" class="form-group">
            <label for="IdUsersResponsibleRunProcedures" id="label_IdUsersResponsibleRunProcedures">Profissional Responsável</label>
            <select id="IdUsersResponsibleRunProcedures" name="IdUsersResponsibleRunProcedures" class="form-control @error('IdUsersResponsibleRunProcedures') is-invalid @enderror" url-query="{{ route('users.query.responsavel.json') }}">
                <option value="{{ auth()->user()->IdUsers }}">...</option>
            </select>
        </div>              
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <label for="date_run" id="label_date_run"><strong>Data:</strong></label>
        <div class="input-group mb-2">
            <input type="text" id="date_run" name="date_run" class="form-control datetimepicker @error('date') is-invalid @enderror" oninput="this.value = this.value.toUpperCase()" value="{{ date('d-m-Y') }}">
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <label for="date_time_run" id="label_date_time_run"><strong>Hora:</strong></label>
        <div class="input-group mb-2">
            <input type="text" id="date_time_run" name="date_time_run" class="form-control datetimepicker  @error('date') is-invalid @enderror" oninput="this.value = this.value.toUpperCase()" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' value="{{ date('H:i') }}">
        </div>
    </div>
</div>

@if(app('request')->input('status') == "refused")
    <div class="row mt-1">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div id="note_refused_fields" class="form-group">
                <label class="form-label" for="note_refused_label">Observação</label>
                <textarea class="form-control @error('note_refused') is-invalid @enderror" id="note_refused" name="note_refused" rows="6" required></textarea>
                <div class="valid-feedback">sucesso!</div>
            </div>
        </div>
    </div>
@else
    <div class="row mt-1">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div id="medical_report_fields" class="form-group">
                <label class="form-label" for="medical_report_label">Laudo</label>
                <textarea class="form-control @error('medical_report') is-invalid @enderror" id="medical_report" name="medical_report" rows="6" required></textarea>
                <div class="valid-feedback">sucesso!</div>
            </div>
        </div>
    </div>
@endif

<div id="route-save" data-url="{{ route('emergency_services_procedures.save.run', ['IdEmergencyServicesProcedures' => $IdEmergencyServicesProcedures, 'status' => app('request')->input('status') ?? 'executed']) }}"></div>
<script src="{{ asset('admin/js/modules/run_procedures.js') }}" type="text/javascript"></script>
<link href="{{ asset('admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/pt.js"></script>
<script src="{{ asset('admin/js/flatpickr.js') }}" type="text/javascript"></script>