<div class="modal fade" id="sign-up-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sign up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="px-4 py-3" method="POST" action="{{ route('register') }}">
                    @csrf
                    {{--input login--}}
                    <div class="form-group">
                        <input type="email"
                               class="form-control @error('signup_login') is-invalid @enderror"
                               name="signup_login"
                               placeholder="email@example.com"
                               value="{{old('signup_login')}}"
                               autocomplete="off">
                        @include('utils.error-invalid-feedback', ["errorField" => 'signup_login'])
                    </div>
                    {{--input password--}}
                    <div class="form-group">
                        <input type="password"
                               class="form-control @error('signup_password') is-invalid @enderror"
                               name="signup_password"
                               placeholder="Password"
                               autocomplete="off">
                        @include('utils.error-invalid-feedback', ["errorField" => 'signup_password'])
                    </div>
                    {{--input password confirmation--}}
                    <div class="form-group">
                        <input type="password"
                               class="form-control"
                               name="signup_password_confirmation"
                               placeholder="Confirm Password"
                               autocomplete="off"
                               required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                    <p class="text-center m-3">or</p>
                    <div class="row">
                        {{--register with google--}}
                        <a href="{{ route('social-login', ['provider' => 'google']) }}" class="col text-right">
                            <i class="social-login fab fa-google rounded-circle" aria-hidden="true"></i>
                        </a>
                        {{--register with facebook--}}
                        <a href="{{ route('social-login', ['provider' => 'facebook']) }}" class="col text-left">
                            <i class="social-login fab fa-facebook-f rounded-circle" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
            {{--move to sign in modal--}}
            <div class="modal-footer justify-content-center">
                <p>Already have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#sign-in-modal">Sign in</a></p>
            </div>
        </div>
    </div>
</div>
