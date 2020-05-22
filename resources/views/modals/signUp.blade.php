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
                    <div class="form-group">
                        <input type="email"
                               class="form-control @error('signup_login') is-invalid @enderror"
                               name="signup_login"
                               placeholder="email@example.com"
                               value="{{old('signup_login')}}"
                               required>
                        @include('utils.error-invalid-feedback', ["errorField" => 'signup_login'])
                    </div>
                    <div class="form-group">
                        <input type="password"
                               class="form-control @error('signup_password') is-invalid @enderror"
                               name="signup_password"
                               placeholder="Password"
                               required>
                        @include('utils.error-invalid-feedback', ["errorField" => 'signup_password'])

                    </div>
                    <div class="form-group">
                        <input type="password"
                               class="form-control"
                               name="signup_password_confirmation"
                               placeholder="Confirm Password"
                               required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck">
                                I accept the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a>.
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                    <p class="text-center m-3">or</p>
                    <div class="row">
                        <a href="#" class="col text-right">
                            <i class="social-login fab fa-google rounded-circle" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="col text-left">
                            <i class="social-login fab fa-facebook-f rounded-circle" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <p>Already have an account? <a href="#">Sign in</a></p>
            </div>
        </div>
    </div>
</div>
