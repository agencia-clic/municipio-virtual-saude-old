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
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div id="code_procedures_filter_fields" class="form-group">
                    <label for="code_procedures_filter" id="label_code_procedures_filter">Código FILTRO:</label>
                    <input type="text" id="code_procedures_filter" code_procedures_filter="code_procedures_filter" class="form-control" oninput="this.value = this.value.toUpperCase()"  @if((!empty($procedures_groups)) AND $procedures_groups->IdUsersResponsible != auth()->user()->IdUsers) disabled @endif>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div id="title_procedures_filter_fields" class="form-group">
                    <label for="title_procedures_filter" id="label_title_procedures_filter">Procedimento FILTRO:</label>
                    <input type="text" id="title_procedures_filter" name="title_procedures_filter" class="form-control" oninput="this.value = this.value.toUpperCase()"  @if((!empty($procedures_groups)) AND $procedures_groups->IdUsersResponsible != auth()->user()->IdUsers) disabled @endif>
                </div>
            </div>

            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="IdProcedures_fields" class="form-group">
                    <label for="IdProcedures" id="label_IdProcedures">Procedimento</label>
                    <select id="IdProcedures" name="IdProcedures" class="form-control  @error('IdProcedures') is-invalid @enderror" url-query="{{ route('procedures.form.json') }}"  @if((!empty($procedures_groups)) AND $procedures_groups->IdUsersResponsible != auth()->user()->IdUsers) disabled @endif>
                        <option value="{{old('IdProcedures') ?? $emergency_services_procedures_current->IdProcedures ?? ""}}">...</option>
                    </select>
                </div>              
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="note_fields" class="form-group">
                    <label class="form-label" for="note_label">Observação</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="5" required @if((!empty($procedures_groups)) AND $procedures_groups->IdUsersResponsible != auth()->user()->IdUsers) disabled @endif>{{old('note') ?? $procedures_groups_current->note ?? ""}}</textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary mt-2 hide" id="send-form" type="button" onclick="save_procedures()" data-url="{{ route('emergency_services_procedures.form.create', ['IdEmergencyServices' => $IdEmergencyServices, 'IdProceduresGroups' => $IdProceduresGroups]) }}">Adicionar</button>
    </div>
</div>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Procedimentos / Exames</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        <div id="table-list" data-iframe="{{ route('emergency_services_procedures.table', ['IdEmergencyServices' => $IdEmergencyServices, 'IdProceduresGroups' => $IdProceduresGroups]) }}"></div>
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