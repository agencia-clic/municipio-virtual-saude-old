@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h5 text-800">Diluição Medicamento</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($medication_dilutions->IdMedicationDilutions) ? route('medication_dilutions.form.create') : route('medication_dilutions.form.update',['IdMedicationDilutions' => base64_encode($medication_dilutions->IdMedicationDilutions)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary btn-sm" type="button" data-redirect="{{ route('medication_dilutions') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary btn-sm" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                  <li class="breadcrumb-item"><a href="{{route('medication_dilutions')}}">Diluição Medicamentos</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">@if(empty($medication_dilutions))Inserir @else Editar @endif</li>
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
                    <div id="IdMedicationDilutions_fields" class="form-group">
                        <label for="IdMedicationDilutions" id="label_IdMedicationDilutions">Código:</label>
                        <input type="text" id="IdMedicationDilutions" name="IdMedicationDilutions" class="form-control form-control-sm" value="@if(!empty($medication_dilutions)){{ $medication_dilutions->IdMedicationDilutions }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control form-control-sm" value="@if(!empty($medication_dilutions)){{ date('d-m-Y H:i', strtotime($medication_dilutions->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control form-control-sm" value="@if(!empty($medication_dilutions)){{ date('d-m-Y H:i', strtotime($medication_dilutions->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control form-control-sm @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($medication_dilutions) AND ($medication_dilutions->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($medication_dilutions) AND ($medication_dilutions->status == "b")))selected @endif>Bloqueado</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- basic - end -->

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
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div id="title_fields" class="form-group">
                        <label for="title" id="label_title">Título:</label>
                        <input type="text" id="title" name="title" class="form-control form-control-sm @error('title') is-invalid @enderror" value="{{old('title') ?? $medication_dilutions->title ?? "+ "}}" oninput="this.value = this.value.toUpperCase()" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content - end -->

</form>

@endsection