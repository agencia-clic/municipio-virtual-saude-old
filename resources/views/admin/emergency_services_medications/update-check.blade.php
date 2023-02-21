<div class="card border h-100 mt-1">
    <div class="card-body border-success">
        <div class="row flex-between-center">
            <div class="col-sm-auto">
                <h5>
                    <h6 class="alert-heading">
                        <strong>Medicamento:</strong> {{ $emergency_services_medications->medicines }} • {{ $emergency_services_medications->units }}

                        @if(!empty($emergency_services_medications->administrations))
                            <span class="badge bg-primary" title="Via de Administração">{{ $emergency_services_medications->administrations }}</span>
                        @endif

                        @if(!empty($emergency_services_medications->dilutions))
                            • <span class="badge bg-primary" title="Diluição">{{ $emergency_services_medications->dilutions }}</span> 
                        @endif

                        @if(!empty($emergency_services_medications->infusao))
                            • <span class="badge bg-primary" title="Infusão">{{ $emergency_services_medications->infusao }}</span>
                        @endif

                        @if($emergency_services_medications->users_diseases() > 0)
                            • <span class="badge bg-danger">Alergia ao medicamento</span>
                        @endif

                        <p class="mb-0 mt-1">
                            <strong>Frequência da dose: </strong> 
                            @if($emergency_services_medications->type == "u")
                                Dose única
                            @elseif($emergency_services_medications->type == "i")
                                Intervalo 
                                
                                @if(!empty($emergency_services_medications->break))
                                    <strong>{{ date('H:i', strtotime($emergency_services_medications->break)) }} H/m</strong>
                                @endif
                            @else
                                Vezes ao Dia {{ $emergency_services_medications->number_time_day }}
                            @endif
                        </p>

                        <p class="mb-0 mt-1">
                            <strong>Quantidade: </strong> {{ number_format($emergency_services_medications->amount, 2, ",", ".") }} {{ $emergency_services_medications->un_measure }}
                        </p>

                        <p class="mb-0 mt-1">
                            <strong>Observação: </strong> {{ $emergency_services_medications->guidance }}
                        </p>

                        <p class="mb-0 mt-2">criado em <strong>{{ date('d-m-Y H:i', strtotime($emergency_services_medications->created_at)) }}</strong> por <span class="title">
                            <strong>{{ $emergency_services_medications->responsible }}</strong>
                                @if(!empty($specialty_users = $users->specialty_users($emergency_services_medications->IdUsersResponsible)))
                                    @foreach($specialty_users as $val_specialty)
                                    • <span class="badge rounded-pill badge-soft-primary">{{ $val_specialty->title }}</span>
                                    @endforeach
                                @endif
                            </span> 
                        </p>
                    </h6>
                </h5>
            </div>
        </div>

        <div class="dropdown-divider"></div>

        <div class="row mt-2">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label for="condition" id="label_condition"><strong>Ações:</strong></label><br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="finalize" name="action_type" value="f"/>
                        <label class="form-check-label" for="finalize">Finalizar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="missing_medication" name="action_type" value="mf"/>
                        <label class="form-check-label" for="missing_medication">Medicamento em Falta</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="replace_medication" name="action_type" value="sm"/>
                        <label class="form-check-label" for="replace_medication">Substituir Medicamento</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="schedule_deadline" name="action_type" value="aip"/>
                        <label class="form-check-label" for="schedule_deadline">Agendar Início do Aprazo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="denied_medication_field" name="action_type" value="pnm"/>
                        <label class="form-check-label" for="denied_medication_field">Paciente Negou a Medicação</label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- reason of termination - start -->
<div class="card mb-3 mt-2 hide" id="reason_termination">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0"><label><strong>Motivo da Finalização:</strong></label></h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row mt-1">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="note_finalize_fields" class="form-group">
                    <textarea class="form-control form-control-sm @error('note_finalize') is-invalid @enderror" id="note_finalize" name="note_finalize" placeholder="Motivo da Finalização" rows="4"></textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- reason of termination - start -->
<div class="card mb-3 mt-2 hide" id="schedule_start">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0"><label><strong>Agendar Início do Aprazo:</strong></label></h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row mt-1">
            <div class="col-sm-12 col-md col-lg col-xl">
                <div class="form-group">
                    <label for="schedule_date" id="label_schedule_date">Data:</label>
                    <input type="text" id="schedule_date" name="schedule_date" class="form-control datetimepicker" oninput="this.value = this.value.toUpperCase()" data-options='{"enableTime":false,"noCalendar":false,"dateFormat":"d-m-Y","disableMobile":true, "time_24hr": true}'>
                </div>
            </div>

            <div class="col-sm-12 col-md col-lg col-xl">
                <div class="form-group">
                    <label for="schedule_date_hour" id="label_schedule_date_hour">Hora:</label>
                    <input type="text" id="schedule_date_hour" name="schedule_date_hour" class="form-control datetimepicker" oninput="this.value = this.value.toUpperCase()" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true, "time_24hr": true}'>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- denied medication - start -->
<div class="card mb-3 mt-2 hide" id="denied_medication">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0"><label><strong>Paciente Negou a Medicação:</strong></label></h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row mt-1">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="note_denied_medication_fields" class="form-group">
                    <textarea class="form-control form-control-sm @error('note_denied_medication') is-invalid @enderror" id="note_denied_medication" name="note_denied_medication" placeholder="Paciente Negou a Medicação" rows="4"></textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- new medication -->
<div class="card mb-3 mt-2 hide" id="replace_medication_card">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0"><label><strong>Substituir Medicamento:</strong></label></h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row mt-1">
            @include('layouts/admin/fragments.emergency_services_medications_fields')
        </div>
    </div>
</div>

<button class="btn btn-primary btn-sm mt-2 hide" id="send-form-medication" type="button" data-url="{{ route('emergency_services_medications.check.send.update', ['IdEmergencyServices' => $IdEmergencyServices, 'IdEmergencyServicesMedications' => $IdEmergencyServicesMedications]) }}">Adicionar</button>

<link href="{{ asset('admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/pt.js"></script>
<script src="{{ asset('admin/js/flatpickr.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/modules/emergency_services_medications.js') }}" type="text/javascript"></script>