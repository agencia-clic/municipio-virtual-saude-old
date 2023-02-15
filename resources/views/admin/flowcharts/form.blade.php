@extends('layouts.admin.app')

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-sm-auto mb-2 mb-sm-0">
                <h6 class="mb-0">@if(empty($flowcharts))Inserir @else Editar @endif</h6>
            </div>
            <div class="col-sm-auto">
                <div class="row gx-2 align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('flowcharts') }}">
                            <button class="btn btn-falcon-default btn-sm me-2" role="button">Fluxogramas</button>
                        </a>
                        <button class="btn btn-falcon-primary btn-sm" role="button">@if(empty($flowcharts))Inserir @else Editar @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($flowcharts->IdFlowcharts) ? route('flowcharts.form.create') : route('flowcharts.form.update',['IdFlowcharts' => base64_encode($flowcharts->IdFlowcharts)])}}" novalidate="">

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
                    <div id="IdFlowcharts_fields" class="form-group">
                        <label for="IdFlowcharts" id="label_IdFlowcharts">Código:</label>
                        <input type="text" id="IdFlowcharts" name="IdFlowcharts" class="form-control" value="@if(!empty($flowcharts)){{ $flowcharts->IdFlowcharts }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control" value="@if(!empty($flowcharts)){{ date('d-m-Y H:i', strtotime($flowcharts->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control" value="@if(!empty($flowcharts)){{ date('d-m-Y H:i', strtotime($flowcharts->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($flowcharts) AND ($flowcharts->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($flowcharts) AND ($flowcharts->status == "b")))selected @endif>Bloqueado</option>
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
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $flowcharts->title ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content - end -->

    <!-- actions - start -->
    <div class="col-12">
        <a href="{{ route('flowcharts') }}">
            <div class="btn btn-secondary">Voltar</div>
        </a>
        <button class="btn btn-primary" type="submit">@if(empty($flowcharts))Inserir @else Editar @endif</button>
    </div>

    <!-- actions - end -->
</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
@endsection
<!-- end - start -->