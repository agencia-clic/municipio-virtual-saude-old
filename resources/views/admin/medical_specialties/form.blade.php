@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Especialidade</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($medical_specialties->IdMedicalSpecialties) ? route('medical_specialties.form.create') : route('medical_specialties.form.update',['IdMedicalSpecialties' => base64_encode($medical_specialties->IdMedicalSpecialties)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="{{ route('medical_specialties') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('medical_specialties')}}">Especialidades</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(empty($medical_specialties))Inserir @else Editar @endif</li>
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
                <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1">
                    <div id="IdMedicalSpecialties_fields" class="form-group">
                        <label for="IdMedicalSpecialties" id="label_IdMedicalSpecialties">Código:</label>
                        <input type="text" id="IdMedicalSpecialties" name="IdMedicalSpecialties" class="form-control" value="@if(!empty($medical_specialties)){{ $medical_specialties->IdMedicalSpecialties }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control" value="@if(!empty($medical_specialties)){{ date('d-m-Y H:i', strtotime($medical_specialties->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control" value="@if(!empty($medical_specialties)){{ date('d-m-Y H:i', strtotime($medical_specialties->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($medical_specialties) AND ($medical_specialties->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($medical_specialties) AND ($medical_specialties->status == "b")))selected @endif>Bloqueado</option>
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
                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="code_fields" class="form-group">
                        <label for="code" id="label_code">Código:</label>
                        <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{old('code') ?? $medical_specialties->code ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <div class="col-sm-12 col-md col-lg col-xl">
                    <div id="title_fields" class="form-group">
                        <label for="title" id="label_title">Título:</label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $medical_specialties->title ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- content - end -->

</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>
<script src="{{ asset('admin/js/inputmask.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {

    //region - validação
	$("#form").validate({
		rules: {
            code: "required",
            title: "required",
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
            $(element).prop('required', true)
            validate_form()
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
			$("label[id='"+$(element).attr("id")+"-error']").remove(); // exclui o label já validade (padrao validate é display: none)

		},
		ignore: true
	});
	//endregion -  validação

})
</script>

@endsection
<!-- end - start -->