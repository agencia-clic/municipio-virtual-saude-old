@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Unidade</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($service_units->IdServiceUnits) ? route('service_units.form.create') : route('service_units.form.update',['IdServiceUnits' => base64_encode($service_units->IdServiceUnits)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary btn-sm" type="button" data-redirect="{{ route('service_units') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary btn-sm" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                  <li class="breadcrumb-item"><a href="{{route('service_units')}}">Unidades</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Unidades</li>
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
                    <h5 class="mb-0">Básico</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="IdServiceUnits_fields" class="form-group">
                        <label for="IdServiceUnits" id="label_IdServiceUnits">Código:</label>
                        <input type="text" id="IdServiceUnits" name="IdServiceUnits" class="form-control form-control-sm" value="@if(!empty($service_units)){{ $service_units->IdServiceUnits }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control form-control-sm" value="@if(!empty($service_units)){{ date('d-m-Y H:i', strtotime($service_units->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control form-control-sm" value="@if(!empty($service_units)){{ date('d-m-Y H:i', strtotime($service_units->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control form-control-sm @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($service_units) AND ($service_units->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($service_units) AND ($service_units->status == "b")))selected @endif>Bloqueado</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- basic - end -->

    <!-- unidades forwarding - start -->
    @if(!empty($service_units))
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Encaminhamento</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <div data-iframe="{{ route('service_units_forwarding', ['IdServiceUnits' => base64_encode($service_units->IdServiceUnits)]) }}"></div>
            
            <div class="col-12 mt-2">
                <button class="btn btn-primary btn-sm btn-sm" type="button" title="Unidade" iframe-form="{{ route('service_units_forwarding.form', ['IdServiceUnits' => base64_encode($service_units->IdServiceUnits)]) }}" iframe-create="{{ route('service_units_forwarding.form.create', ['IdServiceUnits' => base64_encode($service_units->IdServiceUnits)]) }}">Inserir</button>
            </div>
        </div>
    </div>
    @endif
    <!-- unidades forwarding - end -->

    <!-- complemnt - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Responsável</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">

            <div class="row">		
                <div class="col-sm-3 col-md-3 col-lg-2 col-xl-3">
                    <div id="user_letter_fields" class="form-group">
                        <label for="user_letter" id="label_user_letter">FILTRO: Letra:</label>
                        <select id="user_letter" name="user_letter" class="form-control form-control-sm">
                            <option value="">...</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                            <option value="J">J</option>
                            <option value="K">K</option>
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="N">N</option>
                            <option value="O">O</option>
                            <option value="P">P</option>
                            <option value="Q">Q</option>
                            <option value="R">R</option>
                            <option value="S">S</option>
                            <option value="T">T</option>
                            <option value="U">U</option>
                            <option value="V">V</option>
                            <option value="W">W</option>
                            <option value="X">X</option>
                            <option value="Y">Y</option>
                            <option value="Z">Z</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-9 col-md-9 col-lg-5 col-xl-3">
                    <div id="user_name_fields" class="form-group">
                        <label for="user_name" id="label_user_name">FILTRO: Nome:</label>
                        <input type="text" id="user_name" name="user_name" class="form-control form-control-sm" maxlength="50" autocomplete="off">    
                    </div>
                </div>
                
                <div class="col-sm-9 col-md-3 col-lg-3 col-xl-3">
                    <div id="user_cpf_cnpj_fields" class="form-group">
                        <label for="user_cpf_cnpj" id="label_user_cpf_cnpj">FILTRO: CPF/CNPJ:</label>
                        <input type="text" id="user_cpf_cnpj" name="user_cpf_cnpj" class="form-control form-control-sm" maxlength="14" autocomplete="off">    
                    </div>
                </div>

                <div class="col-sm-9 col-md-3 col-lg-3 col-xl-3">
                    <div id="user_phone_fields" class="form-group">
                        <label for="user_phone" id="label_user_phone">FILTRO: Telefone:</label>
                        <input type="text" id="user_phone" name="user_phone" class="form-control form-control-sm" maxlength="15" autocomplete="off">    
                    </div>
                </div>
                
                <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2">
                    <div id="user_button_fields" class="form-group">
                        <label for="user_button" id="label_user_button">Buscar:</label>
                        <button type="button" class="form-control btn btn-outline-secondary btn-sm" url="{{ route('users.form.query') }}" data-id="{{old('IdUsers') ?? $service_units->IdUsers ?? ""}}" query-fields="user_letter,user_name,user_cpf_cnpj,user_phone" select="IdUsers">Buscar</button>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-12 col-xl-10">
                    <div id="IdUsers_fields" class="form-group">
                        <label for="IdUsers" id="label_IdUsers">Contribuinte</label>
                        <select id="IdUsers" name="IdUsers" class="form-control form-control-sm @error('IdUsers') is-invalid @enderror" required>
                            <option value="">...</option>
                        </select>
                    </div>              
                </div>
            </div>

        </div>
    </div>

    <!-- complemnt - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Complemento</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">

            <div class="row">

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="name_fields" class="form-group">
                        <label for="name" id="label_name">Nome:</label>
                        <input type="text" id="name" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{old('name') ?? $service_units->name ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="code_fields" class="form-group">
                        <label for="code" id="label_code">Código:</label>
                        <input type="text" id="code" name="code" class="form-control form-control-sm @error('code') is-invalid @enderror" value="{{old('code') ?? $service_units->code ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="acronym_fields" class="form-group">
                        <label for="acronym" id="label_acronym">Sigla:</label>
                        <input type="text" id="acronym" name="acronym" class="form-control form-control-sm @error('acronym') is-invalid @enderror" value="{{old('acronym') ?? $service_units->acronym ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="email_fields" class="form-group">
                        <label for="email" id="label_email">E-mail:</label>
                        <input type="email" id="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{old('email') ?? $service_units->email ?? ""}}" data-no-uppercase="true" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="phone_fields" class="form-group">
                        <label for="phone" id="label_phone">Telefone:</label>
                        <input type="text" id="phone" 
                        name="phone" class="form-control form-control-sm @error('phone') is-invalid @enderror" value="{{ old('phone') ?? $service_units->phone ?? "" }}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- complemnt - end -->

    <!-- address - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Endereço</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">

            <div class="row mt-1">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="zip_code_fields" class="form-group">
                        <label for="zip_code" id="label_zip_code">CEP:</label>
                        <input type="text" id="zip_code" name="zip_code" class="form-control form-control-sm @error('zip_code') is-invalid @enderror" value="{{ old('zip_code') ?? $service_units->zip_code ?? "" }}" query="true" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="address_fields" class="form-group">
                        <label for="address" id="label_address">Endereço:</label>
                        <input type="text" id="address" name="address" class="form-control form-control-sm @error('address') is-invalid @enderror" value="{{ old('address') ?? $service_units->address ?? "" }}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="number_fields" class="form-group">
                        <label for="number" id="label_number">Número:</label>
                        <input type="text" id="number" name="number" class="form-control form-control-sm @error('number') is-invalid @enderror" value="{{ old('number') ?? $service_units->number ?? "" }}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="district_fields" class="form-group">
                        <label for="district" id="label_district">Bairro:</label>
                        <input type="text" id="district" name="district" class="form-control form-control-sm @error('district') is-invalid @enderror" value="{{ old('district') ?? $service_units->district ?? "" }}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="city_fields" class="form-group">
                        <label for="city" id="label_city">Cidade:</label>
                        <input type="text" id="city" name="city" class="form-control form-control-sm @error('city') is-invalid @enderror" value="{{ old('city') ?? $service_units->city ?? "" }}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div id="uf_fields" class="form-group">
                        <label for="uf" id="label_uf">Estado/UF:</label>
                        <select id="uf" name="uf" class="form-control form-control-sm @error('uf') is-invalid @enderror" required>
                            <option value="" selected="selected">...</option>
                            <option value="AC" @if((old('uf') == "AC") OR (!empty($service_units) AND ($service_units->uf == "AC")))selected @endif>AC</option>
                            <option value="AL" @if((old('uf') == "AL") OR (!empty($service_units) AND ($service_units->uf == "AL")))selected @endif>AL</option>
                            <option value="AM" @if((old('uf') == "AM") OR (!empty($service_units) AND ($service_units->uf == "AM")))selected @endif>AM</option>
                            <option value="AP" @if((old('uf') == "AP") OR (!empty($service_units) AND ($service_units->uf == "AP")))selected @endif>AP</option>
                            <option value="BA" @if((old('uf') == "BA") OR (!empty($service_units) AND ($service_units->uf == "BA")))selected @endif>BA</option>
                            <option value="CE" @if((old('uf') == "CE") OR (!empty($service_units) AND ($service_units->uf == "CE")))selected @endif>CE</option>
                            <option value="DF" @if((old('uf') == "DF") OR (!empty($service_units) AND ($service_units->uf == "DF")))selected @endif>DF</option>
                            <option value="ES" @if((old('uf') == "ES") OR (!empty($service_units) AND ($service_units->uf == "ES")))selected @endif>ES</option>
                            <option value="GO" @if((old('uf') == "GO") OR (!empty($service_units) AND ($service_units->uf == "GO")))selected @endif>GO</option>
                            <option value="MA" @if((old('uf') == "MA") OR (!empty($service_units) AND ($service_units->uf == "MA")))selected @endif>MA</option>
                            <option value="MG" @if((old('uf') == "MG") OR (!empty($service_units) AND ($service_units->uf == "MG")))selected @endif>MG</option>
                            <option value="MS" @if((old('uf') == "MS") OR (!empty($service_units) AND ($service_units->uf == "MS")))selected @endif>MS</option>
                            <option value="MT" @if((old('uf') == "MT") OR (!empty($service_units) AND ($service_units->uf == "MT")))selected @endif>MT</option>
                            <option value="PA" @if((old('uf') == "PA") OR (!empty($service_units) AND ($service_units->uf == "PA")))selected @endif>PA</option>
                            <option value="PB" @if((old('uf') == "PB") OR (!empty($service_units) AND ($service_units->uf == "PB")))selected @endif>PB</option>
                            <option value="PE" @if((old('uf') == "PE") OR (!empty($service_units) AND ($service_units->uf == "PE")))selected @endif>PE</option>
                            <option value="PI" @if((old('uf') == "PI") OR (!empty($service_units) AND ($service_units->uf == "PI")))selected @endif>PI</option>
                            <option value="PR" @if((old('uf') == "PR") OR (!empty($service_units) AND ($service_units->uf == "PR")))selected @endif>PR</option>
                            <option value="RJ" @if((old('uf') == "RJ") OR (!empty($service_units) AND ($service_units->uf == "RJ")))selected @endif>RJ</option>
                            <option value="RN" @if((old('uf') == "RN") OR (!empty($service_units) AND ($service_units->uf == "RN")))selected @endif>RN</option>
                            <option value="RO" @if((old('uf') == "RO") OR (!empty($service_units) AND ($service_units->uf == "RO")))selected @endif>RO</option>
                            <option value="RR" @if((old('uf') == "RR") OR (!empty($service_units) AND ($service_units->uf == "RR")))selected @endif>RR</option>
                            <option value="RS" @if((old('uf') == "RS") OR (!empty($service_units) AND ($service_units->uf == "RS")))selected @endif>RS</option>
                            <option value="SC" @if((old('uf') == "SC") OR (!empty($service_units) AND ($service_units->uf == "SC")))selected @endif>SC</option>
                            <option value="SE" @if((old('uf') == "SE") OR (!empty($service_units) AND ($service_units->uf == "SE")))selected @endif>SE</option>
                            <option value="SP" @if((old('uf') == "SP") OR (!empty($service_units) AND ($service_units->uf == "SP")))selected @endif>SP</option>
                            <option value="TO" @if((old('uf') == "TO") OR (!empty($service_units) AND ($service_units->uf == "TO")))selected @endif>TO</option>	
                        </select>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- address - end -->
    
</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>
<script src="{{ asset('admin/js/query-zipcode.js') }}"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/query-fields.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {

    $("input[id='zip_code']").mask('99999999');
    $("input[id='phone']").mask('(99) 9999-9999');

    //region - validação
	$("#form").validate({
		rules: {
            email: {
				required: true,
                email:true,
				remote: "{{ route('service_units.existe.email', ['email_current' => $service_units->email ?? ""]) }}"
			},
		},
		messages: {

		},
		onkeyup: false,
		submitHandler: function(form) {

			$(this.submitButton).prop('disabled', true);
			form.submit();

		},
		errorElement: "label",
		errorPlacement: function (error, element) {
			//alert(JSON.stringify(error));
			error.addClass("invalid-feedback");
			if(element.parent().hasClass('input-group')){
				error.insertAfter( element.parent() );
			} else if (element.prop("type") === "checkbox") {
				error.insertAfter(element.next("label"));
			} else {
				error.insertAfter(element);
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
			$("label[id='"+$(element).attr("id")+"-error']").remove(); // exclui o label já validade (padrao validate é display: none)

		},
		ignore: true
	});
	//endregion -  validação
    
    $('#uf_naturalness').on('change', function(){
        naturalness()
    })
})

</script>

@endsection
<!-- end - start -->