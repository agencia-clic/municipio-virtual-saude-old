@extends('layouts.admin.app')

<!-- head -->
@section('head')
<link href="{{ asset('admin/css/uploadifive.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/vendors/dropzone/dropzone.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

@csrf <!--token--> 

<!-- general data - start -->
<div class="card mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Básico</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div id="title_fields" class="form-group">
                    <label for="title" id="label_title">Título:</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $medicines->title ?? ""}}" oninput="this.value = this.value.toUpperCase()" required>
                    <div class="valid-feedback">sucesso!</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- general data - start -->
<div class="card mt-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Arquivo</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <div id="imagem_campo" class="form-group">
            <input type="file" id="file_upload" name="file_upload" multiple="multiple"/>
            <div id="queue"></div>
            <div id="imagem_retorno_html" class="imagem_retorno_html"></div>
            <div id="uploadifive-file_upload-queue" class="uploadifive-queue"></div>
        </div>
    </div>
</div>

<button type="button" class="hide" id="send-form" onclick="javascript:$('#file_upload').uploadifive('upload')">Inserir</button>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="{{ asset('admin/js/uploadifive.js') }}"></script>
<script src="{{ asset('admin/vendors/dropzone/dropzone.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
    
        $('#file_upload').uploadifive({
            'formData' : {
                '_token':		$('input[name="_token"]').val()
            },
            'val': ['title'],
            'uploadScript' 		: '{{ route('emergency_services_files.form.create', ['IdEmergencyServices' => $IdEmergencyServices]) }}', // sim
            'width'    			: '100%',
            'fileSizeLimit' 	: '5120',
            /* 'fileTypeExts' 		: '*.gif; *.jpg; *.jpeg; *.png', */
            'fileType': ["image\/gif","image\/jpeg","image\/png", "application\/pdf", "application\/vnd.ms-excel"],
            'auto'				: false,
            'buttonText'		: `<img class="me-2" src="{{ asset('admin/img/cloud-upload.svg') }}" width="25" alt=""/>Solte seus arquivos aqui`,
            //'onDialogClose' : function() {
              //	console.log(this.queueData.filesQueued);
              //},
            'onQueueComplete' : function(queueData) {
                //alert(queueData.uploadsSuccessful + ' arquivos foram inseridos com sucesso.');
                
                setTimeout(() => {
                    window.parent.reload_iframe()
                    window.parent.close_modal('#modal_iframe')
                }, 500);
            }
        });
    
    });
    </script>
@endsection
<!-- end - start -->