@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Entrada Medicamentos</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($medication_entries->IdMedicationEntries) ? route('medication_entries.form.create') : route('medication_entries.form.update',['IdMedicationEntries' => base64_encode($medication_entries->IdMedicationEntries)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="{{ route('medication_entries') }}"><span class="fas fa-arrow-left"></span></button>

                            @if((!empty($medication_entries) AND ($medication_entries->status == "a")) OR (empty($medication_entries)))
                                <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                  <li class="breadcrumb-item"><a href="{{route('medication_entries')}}">Entrada Medicamentos</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">@if(empty($medication_entries))Inserir @else Editar @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @csrf <!--token--> 

    <!-- content - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Básicos</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div id="type_fields" class="form-group">
                        <label for="type" id="label_type" class="label_type">Tipo:</label>
                        <select name="type" class="form-control form-control-sm @error('type') is-invalid @enderror" disabled>
                            <option value="m" @if((old('type') == "m") OR (!empty($medication_entries) AND ($medication_entries->type == "m")))selected @endif>Manual</option>
                            <option value="a" @if((old('type') == "a") OR (!empty($medication_entries) AND ($medication_entries->type == "a")))selected @endif>Automático</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div id="receipt_date_fields" class="form-group">
                        <label for="receipt_date" id="label_receipt_date">Data de Recebimento:</label>
                        <input type="text" id="receipt_date" name="receipt_date" class="form-control form-control-sm @error('receipt_date') is-invalid @enderror" value="@if(!empty(old('receipt_date')))@elseif((!empty($medication_entries)) AND !empty($medication_entries->receipt_date)){{date('d-m-Y', strtotime($medication_entries->receipt_date))}}@else{{ date('d-m-Y')}}@endif" @if(!empty($medication_entries))disabled @endif required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content - end -->

    <!-- specialties - start -->
    @if(!empty($medication_entries))
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Medicamentos</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <div data-iframe="{{ route('medication_entries_registrations', ['IdMedicationEntries' => base64_encode($medication_entries->IdMedicationEntries)]) }}"></div>

            @if((!empty($medication_entries) AND ($medication_entries->status == "a")) OR (empty($medication_entries)))
                <div class="col-12 mt-2">
                     <button class="btn btn-primary btn-sm" type="Medicamentos" iframe-form="{{ route('medication_entries_registrations.form', ['IdMedicationEntries' => base64_encode($medication_entries->IdMedicationEntries)]) }}" iframe-create="{{ route('medication_entries_registrations.form.create', ['IdMedicationEntries' => base64_encode($medication_entries->IdMedicationEntries)]) }}">Inserir</button>
                </div>
            @endif
        </div>
    </div>
    @endif
    <!-- specialties - end -->

    <!-- note - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Observações</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            <textarea class="form-control form-control-sm @error('text') is-invalid @enderror" id="text" name="text" rows="3" required  @if(!empty($medication_entries) AND ($medication_entries->status != "a"))disabled @endif>{{old('text') ?? $medication_entries->text ?? ""}}</textarea>
        </div>
    </div>

</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/modules/medication_entries_registrations.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("input[id='receipt_date']").mask('99-99-9999');
})
</script>

@endsection
<!-- end - start -->