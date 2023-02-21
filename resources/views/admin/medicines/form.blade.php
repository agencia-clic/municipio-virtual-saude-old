@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Medicamentos</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($medicines->IdMedicines) ? route('medicines.form.create') : route('medicines.form.update',['IdMedicines' => base64_encode($medicines->IdMedicines)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="{{ route('medicines') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                  <li class="breadcrumb-item"><a href="{{route('medicines')}}">Medicamentos</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">@if(empty($medicines))Inserir @else Editar @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @csrf <!--token--> 

    <!-- basic - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Básico</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="IdMedicines_fields" class="form-group">
                        <label for="IdMedicines" id="label_IdMedicines">Código:</label>
                        <input type="text" id="IdMedicines" name="IdMedicines" class="form-control form-control-sm" value="@if(!empty($medicines)){{ $medicines->IdMedicines }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control form-control-sm" value="@if(!empty($medicines)){{ date('d-m-Y H:i', strtotime($medicines->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control form-control-sm" value="@if(!empty($medicines)){{ date('d-m-Y H:i', strtotime($medicines->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control form-control-sm @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($medicines) AND ($medicines->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($medicines) AND ($medicines->status == "b")))selected @endif>Bloqueado</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- basic - end -->

    <!-- description - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Caracterização</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">

            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div id="IdMedicationUnits_fields" class="form-group">
                        <div class="row">
                            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                                <label for="IdMedicationUnits">Unidade:</label>
                                <select class="form-select js-choice form-select-sm-choice" id="IdMedicationUnits" size="1" name="IdMedicationUnits" required="required" data-options='{"removeItemButton":true,"placeholder":true}'>
                                    @if(!empty($medication_units))
                                        @foreach ($medication_units as $val)
                                            <option value="{{ $val->IdMedicationUnits }}" @if((old('IdMedicationUnits') == $val->IdMedicationUnits) OR (!empty($medicines) AND ($medicines->IdMedicationUnits == $val->IdMedicationUnits)))selected @endif>{{ $val->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="valid-feedback">sucesso!</div>
                            </div>

                            <div class="col-sm-2 col-md-2 col-lg-1 mt-4">
                                <div class="btn-group mb-2" role="group">
                                     <button class="btn btn-primary btn-sm" type="Unidade" iframe-form="{{ route('medication_units.form_modal') }}" iframe-create="{{ route('medication_units.form.create_modal') }}"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span></button>                                   
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div id="IdMedicationAdministrations_fields" class="form-group">
                        <div class="row">
                            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                                <label for="IdMedicationAdministrations">Via de Administração:</label>
                                <select class="form-select js-choice form-select-sm-choice" id="IdMedicationAdministrations" multiple="multiple" name="IdMedicationAdministrations[]" required="required" data-options='{"removeItemButton":true,"placeholder":true}'>
                                    @if(!empty($medication_administrations))
                                        @foreach ($medication_administrations as $val)
                                            <option value="{{ $val->IdMedicationAdministrations }}"
                                                @if((old('IdMedicationAdministrations') == $val->IdMedicationAdministrations) OR (!empty($medicines) AND (in_array($val->IdMedicationAdministrations, explode(',', $medicines->IdMedicationAdministrations)))))selected @endif
                                                >{{ $val->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="valid-feedback">sucesso!</div>
                            </div>

                            <div class="col-sm-2 col-md-2 col-lg-1 mt-4">
                                <div class="btn-group mb-2" role="group">
                                     <button class="btn btn-primary btn-sm" type="Via de Administração" iframe-form="{{ route('medication_administrations.form_modal') }}" iframe-create="{{ route('medication_administrations.form.create_modal') }}"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span></button>                                   
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div id="IdMedicationDilutions_fields" class="form-group">
                        <div class="row">
                            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                                <label for="IdMedicationDilutions">Diluição:</label>
                                <select class="form-select js-choice form-select-sm-choice" id="IdMedicationDilutions" multiple="multiple" name="IdMedicationDilutions[]" data-options='{"removeItemButton":true,"placeholder":true}'>
                                    @if(!empty($medication_dilutions))
                                        @foreach ($medication_dilutions as $val)
                                            <option value="{{ $val->IdMedicationDilutions }}"
                                                @if((old('IdMedicationDilutions') == $val->IdMedicationDilutions) OR (!empty($medicines) AND (in_array($val->IdMedicationDilutions, explode(',', $medicines->IdMedicationDilutions)))))selected @endif
                                                >{{ $val->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="valid-feedback">sucesso!</div>
                            </div>

                            <div class="col-sm-2 col-md-2 col-lg-1 mt-4">
                                <div class="btn-group mb-2" role="group">
                                     <button class="btn btn-primary btn-sm" type="Diluição" iframe-form="{{ route('medication_dilutions.form_modal') }}" iframe-create="{{ route('medication_dilutions.form.create_modal') }}"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span></button>                                   
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
                    <div id="IdMedicationActivePrinciples_fields" class="form-group">
                        <label for="IdMedicationActivePrinciples">Princípio Ativo:</label>
                        <select class="form-select js-choice form-select-sm-choice" id="IdMedicationActivePrinciples" multiple="multiple" size="10" name="IdMedicationActivePrinciples[]" data-options='{"removeItemButton":true,"placeholder":true}'>
                            @if(!empty($medication_active_principles))
                                @foreach ($medication_active_principles as $val)
                                    <option value="{{ $val->IdMedicationActivePrinciples }}"@if((old('IdMedicationActivePrinciples') == $val->IdMedicationActivePrinciples) OR (!empty($medicines) AND (in_array($val->IdMedicationActivePrinciples, explode(',', $medicines->IdMedicationActivePrinciples)))))selected @endif>{{ $val->title }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- description - end -->

    <!-- content - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Conteúdo</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="title_fields" class="form-group">
                        <label for="title" id="label_title">Título:</label>
                        <input type="text" id="title" name="title" class="form-control form-control-sm @error('title') is-invalid @enderror" value="{{old('title') ?? $medicines->title ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content - end -->

</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/modele/medication_entries_registrations.js') }}"></script>
@endsection
<!-- end - start -->