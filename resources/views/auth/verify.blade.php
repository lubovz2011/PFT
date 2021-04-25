@extends('public-layout')
@section('title')
    Verify email
@endsection
@section('content')
    <div class="d-flex" style="margin-bottom: -30px;">
        <div class="container-welcome-image position-relative">
            <div class="overlay opacity-6"></div>
            <div class="d-flex h-100 flex-column justify-content-center align-items-center">
                <div class="col-md-8 col-lg-6 z-index-2">
                    <div class="card">
                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
