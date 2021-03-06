@extends('public-layout')
@section('title')
    Forgot password
@endsection
@section('content')
    <div class="d-flex" style="margin-bottom: -30px;">
        <div class="container-welcome-image position-relative">
            <div class="overlay opacity-6"></div>
            <div class="d-flex h-100 flex-column justify-content-center align-items-center">
                <div class="col-md-8 col-lg-6 z-index-2">
                    <div class="card">
                        <div class="card-header">{{ __('Reset Password') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}" novalidate>
                                @csrf
                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">
                                        {{ __('E-Mail Address') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input id="email"
                                               type="email"
                                               class="form-control @error('login') is-invalid @enderror"
                                               name="login"
                                               value="{{ old('login') }}"
                                               required
                                               autocomplete="email"
                                               autofocus>
                                        @error('login')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
