
@csrf <!--token-->

<div class="card mb-3 border h-100 border-primary">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-12 align-self-center">
                <h5>
                    <h6 class="alert-heading fw-semi-bold">
                        <span class="mt-1"> 
                            {{ $rooms_beds->rooms }} • {{ $rooms_beds->title }} {{  "• {$rooms_beds->note}" ?? "" }} • 
                            @if($rooms_beds->determining_sex == "m")
                                MASCULINO
                            @elseif($rooms_beds->determining_sex == "f")
                                FEMININO
                            @else
                                INDIFERENTE
                            @endif
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

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="note_fields" class="form-group">
            <label class="form-label" for="note_label">Observação</label>
            <textarea class="form-control form-control-sm" id="note" name="note" rows="3" placeholder="Observação"></textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
</div>