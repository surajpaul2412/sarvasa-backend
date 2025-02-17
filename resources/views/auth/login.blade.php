@extends('layouts.app')

@section('content')
<style>
.page-sign {
    background-color: #fffffa !important;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-sign">
                @include('topmessages')
                <div class="card-header">
                    <a href="{{ url('/') }}" class="header-logo">{{ config('app.name', 'Laravel') }}</a>
                </div><!-- card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">{{ __('Email Address') }}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-flex justify-content-between">{{ __('Password') }}
                                <!-- <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a> -->
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-sign text-dark" style="font-weight: 600;">{{ __('Login') }}</button>
                    </form>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
</div>
@endsection
