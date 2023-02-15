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
                <div id="IdMedicationInfusao_fields" class="form-group">
                    <label for="IdMedicationInfusao" id="label_IdMedicationInfusao">Código:</label>
                    <input type="text" id="IdMedicationInfusao" name="IdMedicationInfusao" class="form-control" value="@if(!empty($medication_infusao)){{ $medication_infusao->IdMedicationInfusao }}@endif" readonly="">
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div id="created_at_fields" class="form-group">
                    <label for="created_at" id="label_created_at">Criação:</label>
                    <input type="text" id="created_at" name="created_at" class="form-control" value="@if(!empty($medication_infusao)){{ date('d-m-Y H:i', strtotime($medication_infusao->created_at)) }}@endif" maxlength="19" readonly="">
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div id="updated_at_fields" class="form-group">
                    <label for="updated_at" id="label_updated_at">Última edição:</label>
                    <input type="text" id="updated_at" name="updated_at" class="form-control" value="@if(!empty($medication_infusao)){{ date('d-m-Y H:i', strtotime($medication_infusao->updated_at)) }}@endif" maxlength="19" readonly="">
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div id="status_fields" class="form-group">
                    <label for="status" id="label_status" class="label_status">Status:</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="a" @if((old('status') == "a") OR (!empty($medication_infusao) AND ($medication_infusao->status == "a")))selected @endif>Ativo</option>
                        <option value="b" @if((old('status') == "b") OR (!empty($medication_infusao) AND ($medication_infusao->status == "b")))selected @endif>Bloqueado</option>
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
                    <label for="title" id="label_title">Titulo:</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $medication_infusao->title ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- content - end -->