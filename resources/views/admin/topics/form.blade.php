@extends('layouts.admin.app')

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-sm-auto mb-2 mb-sm-0">
                <h6 class="mb-0">@if(empty($topics))Inserir @else Editar @endif</h6>
            </div>
            <div class="col-sm-auto">
                <div class="row gx-2 align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('topics') }}">
                            <button class="btn btn-falcon-default btn-sm me-2" role="button">Tópicos</button>
                        </a>
                        <button class="btn btn-falcon-primary btn-sm" role="button">@if(empty($topics))Inserir @else Editar @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- form -- start -->
<form class="needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($topics->IdTopics) ? route('topics.form.create') : route('topics.form.update',['IdTopics' => base64_encode($topics->IdTopics)])}}" novalidate="">

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
                    <div id="IdTopics_fields" class="form-group">
                        <label for="IdTopics" id="label_IdTopics">Código:</label>
                        <input type="text" id="IdTopics" name="IdTopics" class="form-control form-control-sm" value="@if(!empty($topics)){{ $topics->IdTopics }}@endif" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="created_at_fields" class="form-group">
                        <label for="created_at" id="label_created_at">Criação:</label>
                        <input type="text" id="created_at" name="created_at" class="form-control form-control-sm" value="@if(!empty($topics)){{ date('d-m-Y H:i', strtotime($topics->created_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="updated_at_fields" class="form-group">
                        <label for="updated_at" id="label_updated_at">Última edição:</label>
                        <input type="text" id="updated_at" name="updated_at" class="form-control form-control-sm" value="@if(!empty($topics)){{ date('d-m-Y H:i', strtotime($topics->updated_at)) }}@endif" maxlength="19" readonly="">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div id="status_fields" class="form-group">
                        <label for="status" id="label_status" class="label_status">Status:</label>
                        <select name="status" class="form-control form-control-sm @error('status') is-invalid @enderror">
                            <option value="a" @if((old('status') == "a") OR (!empty($topics) AND ($topics->status == "a")))selected @endif>Ativo</option>
                            <option value="b" @if((old('status') == "b") OR (!empty($topics) AND ($topics->status == "b")))selected @endif>Bloqueado</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- basic - end -->

    <!-- unidades - start -->
    @if(!empty($topics))
    <div class="card mb-3 {{$topics && $topics->IdTopics ? "" : "hide"}}">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Tópicos Checks</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <div data-iframe="{{ route('topics_checks', ['IdTopics' => base64_encode($topics->IdTopics)]) }}"></div>
            
            <div class="col-12 mt-2">
                 <button class="btn btn-primary btn-sm btn-sm" type="Tópicos Checks" iframe-form="{{ route('topics_checks.form', ['IdTopics' => base64_encode($topics->IdTopics)]) }}" iframe-create="{{ route('topics_checks.form.create', ['IdTopics' => base64_encode($topics->IdTopics)]) }}">Inserir</button>
            </div>
        </div>
    </div>
    @endif
    <!-- unidades - end -->

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
                        <input type="text" id="title" name="title" class="form-control form-control-sm @error('title') is-invalid @enderror" value="{{old('title') ?? $topics->title ?? ""}}" required>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content - end -->

    <!-- description - start -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Descrição:</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Descrição">{{old('description') ?? $topics->description ?? ""}}</textarea>
            <div class="valid-feedback">sucesso!</div>
        </div>
    </div>
    <!-- description - end -->

    <!-- actions - start -->
    <div class="col-12">

        <a href="{{ route('topics') }}">
            <div class="btn btn-secondary">Voltar</div>
        </a>

        <button class="btn btn-primary btn-sm" type="submit">@if(empty($topics))Inserir @else Editar @endif</button>
    </div>

    <!-- actions - end -->
</form>

@endsection

<!-- scripts - start -->
@section('scripts')
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
@endsection
<!-- end - start -->