
@csrf <!--token-->

<div class="card mb-3 border h-100 border-primary">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-12 align-self-center">
                <h5>
                    <h6 class="alert-heading fw-semi-bold">
                        <span class="mt-1"> 
                            {{ $rooms_beds->rooms }} • {{ $rooms_beds->title }} {{  "• {$rooms_beds->note}" ?? "" }}
                        </span> 
                    </h6>
            
                    <h6 class="alert-heading fw-semi-bold">
                        <span class="h6 alert-heading fw-semi-bold"><strong>Acomodação:</strong> {{ $rooms_beds->accommodations}}</span><br>
                    </h6>

                    <h6 class="alert-heading fw-semi-bold">
                        <span class="h6 alert-heading fw-semi-bold"><strong>Sexo Determinante:</strong> 
                            @if($rooms_beds->determining_sex == "m")
                                MASCULINO
                            @elseif($rooms_beds->determining_sex == "f")
                                FEMININO
                            @else
                                INDIFERENTE
                            @endif
                        </span> 
                    </h6>
                </h5>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3 border h-100 border-primary" id="data-users"><div class="card-header">
    <div class="row flex-between-end">
            <div class="col-12 align-self-center">
                <h6 class="alert-heading fw-semi-bold">
                    Paciente: {{ $users->name ?? "" }} • {{ $mask->cpf_cnpj($users->cpf_cnpj) ?? "" }} • {{ $mask->birth($users->date_birth) }} ANOS
                </h6>

                <h6 class="alert-heading fw-semi-bold">
                    <span><strong>Endereço: {{ $users->address ?? "" }} • {{ $users->number ?? "" }} • {{ $users->complement ?? "" }} • {{ $users->district }} • {{ $users->city }} •  {{ $users->uf }}</strong></span><br>
                </h6>
            </div>
        </div>
    </div>
</div>

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
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="IdFunctionalUnits">Unid. Funcional:</label>
                <select class="form-select js-choice form-select-sm-choice @error('IdFunctionalUnits') is-invalid @enderror" id="IdFunctionalUnits" size="1" onchange="list_rooms()" name="IdFunctionalUnits" required="required" data-options='{"removeItemButton":true,"placeholder":true}'>
                    <option value="">...</option>
                    @if(!empty($functional_units))
                        @foreach ($functional_units as $val)
                            <option value="{{ $val->IdFunctionalUnits }}" @if((old('IdFunctionalUnits') == $val->IdFunctionalUnits) OR (!empty($medicines) AND ($medicines->IdFunctionalUnits == $val->IdFunctionalUnits)))selected @endif>{{ $val->title }}</option>
                        @endforeach
                    @endif
                </select>
                <div class="valid-feedback">sucesso!</div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="IdRooms">Quarto:</label>
                <select class="form-select js-choice form-select-sm-choice @error('IdRooms') is-invalid @enderror" id="IdRooms" size="1" name="IdRooms" onclick="list_rooms_beds()" required="required" data-query="{{ route('rooms.query.json') }}" disabled></select>
                <div class="valid-feedback">sucesso!</div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="IdRoomsBeds_transfer">Leito:</label>
                <select class="form-select js-choice form-select-sm-choice @error('IdRoomsBeds_transfer') is-invalid @enderror" id="IdRoomsBeds_transfer" name="IdRoomsBeds_transfer" required="required" data-query="{{ route('rooms_beds.query.json') }}" disabled></select>
                <div class="valid-feedback">sucesso!</div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h6 class="mb-0">Motivo</h6>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="note_fields" class="form-group">
                    <label class="form-label" for="note_label"></label>
                    <textarea class="form-control form-control-sm @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="Motivo">{{ old('note') }}</textarea>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/modules/central_beds_transfer.js') }}"></script>