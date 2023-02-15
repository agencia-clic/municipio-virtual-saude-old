@csrf <!--token--> 

<!-- units -->
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Unidades</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row">
            <div class="form-group">
                <select name="IdServiceUnitsReceive" class="form-control @error('IdServiceUnitsReceive') is-invalid @enderror" required>
                    <option value="">...</option>
                    @if(!empty($service_units))
                        @foreach($service_units as $val)
                            <option value="{{ $val->IdServiceUnits }}" @if(old('IdServiceUnitsReceive') == $val->IdServiceUnits OR (!empty($users_service_units) AND ($val->IdServiceUnits == $users_service_units->IdServiceUnitsReceive)))selected @endif>{{$val->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>