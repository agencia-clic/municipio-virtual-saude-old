
@csrf <!--token--> 

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div id="title_fields" class="form-group">
            <label for="title" id="label_title">Título:</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $topics_checks->title ?? ""}}" required>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>

    <div class="col-sm-12 col-md col-lg col-xl">
        <div id="classification_fields" class="form-group">
            <label for="classification" id="label_classification" class="label_classification">Classificação:</label>
            <select name="classification" class="form-control @error('classification') is-invalid @enderror">
                <option value="zero_priority" @if((old('classification') == "zero_priority") OR (!empty($topics_checks) AND ($topics_checks->classification == "zero_priority")))selected @endif>PRIORIDADE ZERO</option>
                <option value="one_priority" @if((old('classification') == "one_priority") OR (!empty($topics_checks) AND ($topics_checks->classification == "one_priority")))selected @endif>PRIORIDADE UM</option>
                <option value="two_priority" @if((old('classification') == "two_priority") OR (!empty($topics_checks) AND ($topics_checks->classification == "two_priority")))selected @endif>PRIORIDADE DOIS</option>
                <option value="tree_priority" @if((old('classification') == "tree_priority") OR (!empty($topics_checks) AND ($topics_checks->classification == "tree_priority")))selected @endif>PRIORIDADE TRÊS</option>
            </select>
        </div>
    </div>
</div>
