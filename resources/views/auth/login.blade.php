@extends('layouts.admin.auth')

@section('content')
<div class="row flex-center min-vh-100 py-6">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4"><a class="d-flex flex-center mb-4" href="javascript:void(0)"><img class="me-2" src="{{ asset('admin/img/falcon.png') }}" alt="" width="58" /><span class="font-sans-serif fw-bolder fs-5 d-inline-block">falcon</span></a>
        <div class="card">
            <div class="card-body p-4 p-sm-5">
                <div class="row flex-between-center mb-2">
                    <div class="col-auto">
                        <h5>Login</h5>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email:</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Seu Email">
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="mb-3">
    
                        <label for="password" class="form-label">Senha:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required placeholder="Digite sua senha">
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row flex-between-center">
                        <div class="col-auto">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                <label class="form-check-label mb-0" for="basic-checkbox"> {{ __('Manter Conectado') }} </label>
                            </div>
                        </div>

                        @if(Route::has('password.request'))
                            <div class="col-auto">
                                <a class="fs--1" href="{{ route('password.request') }}">{{ __('Esqueceu a senha?') }}</a>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">{{ __('Login') }}</button>
                    </div>
                </form>

                <!--<div class="position-relative mt-4">
                    <hr class="bg-300" />
                    <div class="divider-content-center">or log in with</div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a></div>
                    <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span> facebook</a></div>
                </div>-->
            </div>
        </div>
    </div>
</div>
@endsection