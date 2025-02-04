@extends('layouts.app')

@section('content')

<style>
.container 
{
    font-size:14px;
}

label.col-md-4
{
    margin-top:10px;
}
label.form-check-label
{
    margin:8px;
}
button.btn 
{
    font-size:14px;
}

.card
{
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius: 10px;
}
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4" style="padding-bottom:20px;">
            <div class="card">
                
                <div class="card-header" style="background:none !important; border:none;padding:30px;">
                    <a href="{{ url('/') }}" class="header-logo mb-4" >
                      <img style="height:28px;" src="{{ asset('assets/img/logo.svg') }}" width="100%" />
                    </a>
                    <h3 class="card-title" style="margin-top:30px;">{{ __('Login') }}</h3>
                    <p class="card-text">{{ __('Welcome back! Please sign in to continue.') }}</p>
                </div><!-- card-header -->
                
                <div class="card-body" style="padding:0px 30px;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-20">
                            <label for="email" class="col-md-12 col-form-label text-md-start" style="font-weight:bold">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-20">
                            <label for="password" class="col-md-12 col-form-label text-md-start" style="font-weight:bold">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="display:none">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-30">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sign" style="width:100%;background: #01b8b0;font-weight: bold;border: 0;padding: 10px;border-radius: 10px;margin: 30px 0;">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    -->
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
