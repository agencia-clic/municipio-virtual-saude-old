@extends('layouts.admin.auth')

@section('content')
<div class="row flex-center min-vh-100 py-6">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4"><a class="d-flex flex-center mb-4" href="javascript:void(0)"><img class="me-2" src="{{ asset('admin/img/falcon.png') }}" alt="" width="58" /><span class="font-sans-serif fw-bolder fs-5 d-inline-block">falcon</span></a>
        <div class="card">
            <div class="card-body p-4 p-sm-5">
                <div class="row flex-between-center mb-2">
                    <div class="col-auto">
                        <h5>Recuperar Acesso</h5>
                    </div>
                </div>

                <form class="needs-validation" method="POST" action="{{ route('password.email') }}" novalidate>

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

                    <div class="row flex-between-center">
                        @if (Route::has('login'))
                            <div class="col-auto">
                                <a class="fs--1" href="{{ route('login') }}"> {{ __('Fazer Login') }} </a>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">{{ __('Recuperar') }}</button>
                    </div>
                </form>

                <!-- modal success -->
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('status') }}</strong>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
