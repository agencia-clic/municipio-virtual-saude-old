
@csrf <!--token--> 

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="IdProcedures_fields" class="form-group">
            <label for="IdProcedures" id="label_IdProcedures" class="label_IdProcedures">Medicamentos:</label>
            <select name="IdProcedures" class="form-control @error('IdProcedures') is-invalid @enderror" required>
                <option value="">...</option>
                @if(!empty($medicines))
                    @foreach($medicines as $val)
                        <option value="{{ $val->IdProcedures }}" @if(old('IdProcedures') == $val->IdProcedures OR (!empty($protocols_medication) AND ($val->IdProcedures == $protocols_medication->IdProcedures)))selected @endif>{{$val->title}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
