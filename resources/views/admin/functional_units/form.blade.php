@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Unidade Funcional</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($functional_units->IdFunctionalUnits) ? route('functional_units.form.create') : route('functional_units.form.update',['IdFunctionalUnits' => base64_encode($functional_units->IdFunctionalUnits)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="{{ route('functional_units') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                  <li class="breadcrumb-item"><a href="{{route('functional_units')}}">Unidades Funcionais</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">@if(empty($functional_units))Inserir @else Editar @endif</li>
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
                    <div id="IdFunctionalUnits_fields" class="form-group">
                        <label for="IdFunctionalUnits" id="label_IdFunctionalUnits">Código:</label>
                        <input type="text" id="IdFunctionalUnits" name="IdFunctionalUnits" class="form-control" value="@if(!empty($functional_units)){{ $functional_units->IdFunctionalUnits }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control" value="@if(!empty($functional_units)){{ date('d-m-Y H:i', strtotime($functional_units->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control" value="@if(!empty($functional_units)){{ date('d-m-Y H:i', strtotime($functional_units->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($functional_units) AND ($functional_units->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($functional_units) AND ($functional_units->status == "b")))selected @endif>Bloqueado</option>
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

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="title_fields" class="form-group">
                        <label for="title" id="label_title">Título:</label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $functional_units->title ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="initials_fields" class="form-group">
                        <label for="initials" id="label_initials">Sigla:</label>
                        <input type="text" id="initials" name="initials" class="form-control @error('initials') is-invalid @enderror" value="{{old('initials') ?? $functional_units->initials ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="initials_fields" class="form-group">
                        <label for="capacity" id="label_capacity">Capacidade:</label>
                        <input type="text" id="capacity" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{old('capacity') ?? $functional_units->capacity ?? ""}}" oninput="this.value = this.value.toUpperCase()">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">

                <div class="col-sm-12 col-md col-lg col-xl">
                    <label for="IdBeds">Alas:</label>
                    <select class="form-select js-choice form-select-sm-choice" id="IdBeds" name="IdBeds">
                        <option>...</option>
                        @if(!empty($beds))
                            @foreach ($beds as $val)
                                <option value="{{ $val->IdBeds }}"
                                    @if((old('IdBeds') == $val->IdBeds) OR (!empty($functional_units) AND ($val->IdBeds == $functional_units->IdBeds)))selected @endif
                                    >{{ $val->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="valid-feedback">sucesso!</div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <label for="IdClinics">Clínicas:</label>
                    <select class="form-select js-choice form-select-sm-choice" id="IdClinics" name="IdClinics">
                        <option>...</option>
                        @if(!empty($clinics))
                            @foreach ($clinics as $val)
                                <option value="{{ $val->IdClinics }}"
                                    @if((old('IdClinics') == $val->IdClinics) OR (!empty($functional_units) AND ($val->IdClinics == $functional_units->IdClinics)))selected @endif
                                    >{{ $val->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="valid-feedback">sucesso!</div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="initials_fields" class="form-group">
                        <label for="sector" id="label_sector">Setor:</label>
                        <input type="text" id="sector" name="sector" class="form-control @error('sector') is-invalid @enderror" value="{{old('sector') ?? $functional_units->sector ?? ""}}" oninput="this.value = this.value.toUpperCase()">
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
                
            </div>

            <div class="row mt-1">

                <div class="col-sm-12 col-md col-lg col-xl">
                    <label for="IdTypeFunctionalUnits">Tipo Unid. Funcional:</label>
                    <select class="form-select js-choice form-select-sm-choice" id="IdTypeFunctionalUnits" name="IdTypeFunctionalUnits">
                        <option>...</option>
                        @if(!empty($type_functional_units))
                            @foreach ($type_functional_units as $val)
                                <option value="{{ $val->IdTypeFunctionalUnits }}"
                                    @if((old('IdTypeFunctionalUnits') == $val->IdTypeFunctionalUnits) OR (!empty($functional_units) AND ($val->IdTypeFunctionalUnits == $functional_units->IdTypeFunctionalUnits)))selected @endif
                                    >{{ $val->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="valid-feedback">sucesso!</div>
                </div>

            </div>

        </div>
    </div>
    <!-- content - end -->

</form>

@endsection