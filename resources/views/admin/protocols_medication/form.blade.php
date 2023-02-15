
@csrf <!--token--> 

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="IdMedicines_fields" class="form-group">
            <label for="IdMedicines" id="label_IdMedicines" class="label_IdMedicines">Medicamentos:</label>
            <select name="IdMedicines" class="form-control @error('IdMedicines') is-invalid @enderror" required>
                <option value="">...</option>
                @if(!empty($medicines))
                    @foreach($medicines as $val)
                        <option value="{{ $val->IdMedicines }}" @if(old('IdMedicines') == $val->IdMedicines OR (!empty($protocols_medication) AND ($val->IdMedicines == $protocols_medication->IdMedicines)))selected @endif>{{$val->title}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
