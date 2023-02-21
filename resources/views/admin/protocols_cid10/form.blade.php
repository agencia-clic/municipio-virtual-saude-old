
@csrf <!--token--> 

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="IdCid10_fields" class="form-group">
            <label for="IdCid10" id="label_IdCid10" class="label_IdCid10">CID10:</label>
            <select name="IdCid10" class="form-control form-control-sm @error('IdCid10') is-invalid @enderror" required>
                <option value="">...</option>
                @if(!empty($cid10))
                    @foreach($cid10 as $val)
                        <option value="{{ $val->IdCid10 }}" @if(old('IdCid10') == $val->IdCid10 OR (!empty($protocols_cid10) AND ($val->IdCid10 == $protocols_cid10->IdCid10)))selected @endif>{{$val->title}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
