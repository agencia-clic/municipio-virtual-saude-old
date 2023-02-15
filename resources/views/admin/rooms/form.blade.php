@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Quarto</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($rooms->IdRooms) ? route('rooms.form.create') : route('rooms.form.update',['IdRooms' => base64_encode($rooms->IdRooms)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="{{ route('rooms') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                  <li class="breadcrumb-item"><a href="{{route('rooms')}}">Quartos</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">@if(empty($rooms))Inserir @else Editar @endif</li>
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
                    <h5 class="mb-0">Basico</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="IdRooms_fields" class="form-group">
                        <label for="IdRooms" id="label_IdRooms">Código:</label>
                        <input type="text" id="IdRooms" name="IdRooms" class="form-control" value="@if(!empty($rooms)){{ $rooms->IdRooms }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control" value="@if(!empty($rooms)){{ date('d-m-Y H:i', strtotime($rooms->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control" value="@if(!empty($rooms)){{ date('d-m-Y H:i', strtotime($rooms->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($rooms) AND ($rooms->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($rooms) AND ($rooms->status == "b")))selected @endif>Bloqueado</option>
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
                        <label for="title" id="label_title">Titulo:</label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $rooms->title ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="initials_fields" class="form-group">
                        <label for="initials" id="label_initials">Siagla:</label>
                        <input type="text" id="initials" name="initials" class="form-control @error('initials') is-invalid @enderror" value="{{old('initials') ?? $rooms->initials ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="capacity_fields" class="form-group">
                        <label for="capacity" id="label_capacity">Capacidade:</label>
                        <input type="text" id="capacity" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{old('capacity') ?? $rooms->capacity ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-sm-12 col-md col-lg col-xl">
                    <label for="IdAccommodations">Acomodações:</label>
                    <select class="form-select js-choice form-select-sm-choice" id="IdAccommodations" name="IdAccommodations" required>
                        <option value="">...</option>
                        @if(!empty($accommodations))
                            @foreach ($accommodations as $val)
                                <option value="{{ $val->IdAccommodations }}"
                                    @if((old('IdAccommodations') == $val->IdAccommodations) OR (!empty($rooms) AND ($val->IdAccommodations == $rooms->IdAccommodations)))selected @endif
                                    >{{ $val->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="valid-feedback">sucesso!</div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <label for="IdFunctionalUnits">Unidade Funcional:</label>
                    <select class="form-select js-choice form-select-sm-choice" id="IdFunctionalUnits" name="IdFunctionalUnits" required>
                        <option value="">...</option>
                        @if(!empty($functional_units))
                            @foreach ($functional_units as $val)
                                <option value="{{ $val->IdFunctionalUnits }}"
                                    @if((old('IdFunctionalUnits') == $val->IdFunctionalUnits) OR (!empty($rooms) AND ($val->IdFunctionalUnits == $rooms->IdFunctionalUnits)))selected @endif
                                    >{{ $val->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="determining_sex_fields" class="form-group">
                        <label for="determining_sex" id="label_determining_sex" class="label_determining_sex">Sexo Determinante:</label>
                        <select name="determining_sex" class="form-control @error('determining_sex') is-invalid @enderror" required>
                            <option value="i" @if((old('determining_sex') == "i") OR (!empty($rooms) AND ($rooms->determining_sex == "i")))selected @endif>INDIFERENTE</option>
                            <option value="m" @if((old('determining_sex') == "m") OR (!empty($rooms) AND ($rooms->determining_sex == "m")))selected @endif>MASCULINO</option>
                            <option value="f" @if((old('determining_sex') == "f") OR (!empty($rooms) AND ($rooms->determining_sex == "f")))selected @endif>FEMININO</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="international_exclusive_fields" class="form-group">
                        <label for="international_exclusive" id="label_international_exclusive" class="label_international_exclusive">Exclusivo Internação:</label>
                        <select name="international_exclusive" class="form-control @error('international_exclusive') is-invalid @enderror">
                            <option value="y" @if((old('international_exclusive') == "y") OR (!empty($rooms) AND ($rooms->international_exclusive == "y")))selected @endif>Sim</option>
                            <option value="n" @if((old('international_exclusive') == "n") OR (!empty($rooms) AND ($rooms->international_exclusive == "n")))selected @endif>Não</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content - end -->

    <!-- bads - start -->
    @if(!empty($rooms))
    <div class="card mb-3 {{$rooms && $rooms->IdRooms ? "" : "hide"}}">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Leito</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <div data-iframe="{{ route('rooms_beds', ['IdRooms' => base64_encode($rooms->IdRooms)]) }}"></div>
            
            <div class="col-12 mt-2">
                <button class="btn btn-primary" type="button" title="Leitos" iframe-form="{{ route('rooms_beds.form', ['IdRooms' => base64_encode($rooms->IdRooms)]) }}" iframe-create="{{ route('rooms_beds.form.create', ['IdRooms' => base64_encode($rooms->IdRooms)]) }}">Inserir</button>
            </div>
        </div>
    </div>
    @endif

</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
@endsection