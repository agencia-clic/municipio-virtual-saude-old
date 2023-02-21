@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h4 text-800">Protocolos</span>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($protocols->IdProtocols) ? route('protocols.form.create') : route('protocols.form.update',['IdProtocols' => base64_encode($protocols->IdProtocols)])}}" novalidate="">

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary" type="button" data-redirect="{{ route('protocols') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                  <li class="breadcrumb-item"><a href="{{route('protocols')}}">Protocolos</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">@if(empty($flowcharts))Inserir @else Editar @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($protocols->IdProtocols) ? route('protocols.form.create') : route('protocols.form.update',['IdProtocols' => base64_encode($protocols->IdProtocols)])}}" novalidate="">

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
                    <div id="IdProtocols_fields" class="form-group">
                        <label for="IdProtocols" id="label_IdProtocols">Código:</label>
                        <input type="text" id="IdProtocols" name="IdProtocols" class="form-control form-control-sm" value="@if(!empty($protocols)){{ $protocols->IdProtocols }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control form-control-sm" value="@if(!empty($protocols)){{ date('d-m-Y H:i', strtotime($protocols->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control form-control-sm" value="@if(!empty($protocols)){{ date('d-m-Y H:i', strtotime($protocols->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control form-control-sm @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($protocols) AND ($protocols->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($protocols) AND ($protocols->status == "b")))selected @endif>Bloqueado</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- basic - end -->

    <!-- cid10 - start -->
    @if(!empty($protocols))
    <div class="card mb-3 {{$protocols && $protocols->IdProtocols ? "" : "hide"}}">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">CID10</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <div data-iframe="{{ route('protocols_cid10', ['IdProtocols' => base64_encode($protocols->IdProtocols)]) }}"></div>
            
            <div class="col-12 mt-2">
                 <button class="btn btn-primary btn-sm" type="CID10" iframe-form="{{ route('protocols_cid10.form', ['IdProtocols' => base64_encode($protocols->IdProtocols)]) }}" iframe-create="{{ route('protocols_cid10.form.create', ['IdProtocols' => base64_encode($protocols->IdProtocols)]) }}">Inserir</button>
            </div>
        </div>
    </div>
    @endif
    <!-- cid10 - end -->

    <!-- medication - start -->
    @if(!empty($protocols))
    <div class="card mb-3 {{$protocols && $protocols->IdProtocols ? "" : "hide"}}">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Medicamentos</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <div data-iframe="{{ route('protocols_medication', ['IdProtocols' => base64_encode($protocols->IdProtocols)]) }}"></div>
            
            <div class="col-12 mt-2">
                 <button class="btn btn-primary btn-sm" type="Medicamentos" iframe-form="{{ route('protocols_medication.form', ['IdProtocols' => base64_encode($protocols->IdProtocols)]) }}" iframe-create="{{ route('protocols_medication.form.create', ['IdProtocols' => base64_encode($protocols->IdProtocols)]) }}">Inserir</button>
            </div>
        </div>
    </div>
    @endif
    <!-- medication - end -->

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
                        <label for="title" id="label_title">Título:</label>
                        <input type="text" id="title" name="title" class="form-control form-control-sm @error('title') is-invalid @enderror" value="{{old('title') ?? $protocols->title ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- content - end -->

    <!-- actions - start -->
    <div class="col-12">

        <a href="{{ redirect()->getUrlGenerator()->previous() }}">
            <div class="btn btn-secondary">Voltar</div>
        </a>

        <button class="btn btn-primary" type="submit">@if(empty($protocols))Inserir @else Editar @endif</button>
    </div>

    <!-- actions - end -->
</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
@endsection
<!-- end - start -->
