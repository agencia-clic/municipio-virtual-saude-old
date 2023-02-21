@csrf <!--token-->

<div class="card mb-3 card-users-patient-register mt-1">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Conteúdo</h5>
            </div>
        </div>
    </div>

    <div class="card-body bg-light">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div id="lote_fields" class="form-group">
                    <label for="lote" id="label_lote">Lote:</label>
                    <input type="text" id="lote" name="lote" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm @error('lote') is-invalid @enderror" value="{{old('lote') ?? $medication_entries_registrations->lote ?? ""}}">
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div id="date_venc_fields" class="form-group">
                    <label for="date_venc" id="label_date_venc">Data Vencimento:</label>
                    <input type="text" id="date_venc" name="date_venc" class="form-control form-control-sm @error('date_venc') is-invalid @enderror" value="@if(!empty(old('date_venc'))){{old('date_venc')}}@elseif((empty(!$medication_entries_registrations)) AND empty(!$medication_entries_registrations->date_venc)){{date('d-m-Y', strtotime($medication_entries_registrations->date_venc))}}@endif" required>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div id="amount_fields" class="form-group">
                    <label for="amount" id="label_amount">Quantidade:</label>
                    <input type="number" id="amount" name="amount" class="form-control form-control-sm @error('amount') is-invalid @enderror" value="{{old('amount') ?? $medication_entries_registrations->IdMedicines ?? ""}}">
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div id="code_fields" class="form-group">
                    <label for="code" id="label_code">Código:</label>
                    <input type="number" id="code" name="code" class="form-control form-control-sm @error('code') is-invalid @enderror" value="{{old('code') ?? $medication_entries_registrations->IdMedicines ?? ""}}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3 card-medications-patient-register mt-1">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Medicamento</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">

        <div class="row">
            @empty($medication_entries_registrations)
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    <div id="medication_name_fields" class="form-group">
                        <label for="medication_name" id="label_medication_name">FILTRO: Nome:</label>
                        <input type="text" id="medication_name" name="medication_name" class="form-control form-control-sm" maxlength="50" autocomplete="off">    
                    </div>
                </div>
            @endempty

            <div class="col-sm-12 col-md col-lg col-xl">
                <div id="IdMedicines_fields" class="form-group">
                    <label for="IdMedicines" id="label_IdMedicines">Medicamento</label>
                    <select id="IdMedicines" name="IdMedicines" class="form-control form-control-sm @error('IdMedicines') is-invalid @enderror" url-query="{{ route('medicines.query.json') }}" @empty(!$medication_entries_registrations)disabled @endempty>
                        <option value="{{old('IdMedicines') ?? $medication_entries_registrations->IdMedicines ?? ""}}">...</option>
                    </select>
                </div>              
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("input[id='date_venc']").mask('99-99-9999');

    if($('#IdMedicines').val() != null && $('#IdMedicines').val() != ""){
        medication_reload($('#IdMedicines').val())
    }
})
</script>