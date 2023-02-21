@extends('layouts.admin.auth')

@section('content')
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">
                    <!-- Logo -->
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="#">
                            <span><img src="{{ asset('admin/img/logo.png') }}" alt="" height="18"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">
                        
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold">Recuperar Acesso</h4>
                            <p class="text-muted mb-4">Use seu email para recuperar o acesso ao sistema.</p>
                        </div>

                        <form class="needs-validation" method="POST" action="{{ route('password.update') }}" novalidate>

                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-1">
                                <label class="form-label" for="validationCustomEmail">{{__('E-mail')}}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="email">@</span>
                                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" id="validationCustomEmail" value="{{ $email ?? old('email') }}" required autocomplete="email" required autocomplete="email" autofocus>
            
                                    <div class="invalid-feedback">
                                       {{trans('message.required_field')}}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="validationCustomPassword">{{__('Nova Senha')}}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="password">@</span>
                                    <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" id="validationCustomPassword" required autocomplete="Nova Senha" min="8">
            
                                    <div class="invalid-feedback">
                                       {{trans('message.required_field')}}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="validationPasswordConfirmation">{{__('Confirme a Senha')}}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="password_confirmation">@</span>
                                    <input id="password_confirmation" type="password" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="validationPasswordConfirmation" required autocomplete="Confirme a Senha" min="8">
            
                                    <div class="invalid-feedback">
                                       {{trans('message.required_field')}}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-5">
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="text-muted float-end"><small> {{ __('Fazer Login') }} </small></a>
                                @endif
                            </div>

                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> {{ __('Enviar') }} </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
