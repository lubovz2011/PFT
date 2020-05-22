<div class="modal fade" id="sign-in-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sign in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="px-4 py-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email"
                               class="form-control @error('login') is-invalid @enderror"
                               name="login"
                               placeholder="email@example.com"
                               value="{{old('login')}}"
                               required>
                        @include('utils.error-invalid-feedback', ["errorField" => 'login'])
                    </div>
                    <div class="form-group">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               placeholder="Password"
                               required>
                        @include('utils.error-invalid-feedback', ["errorField" => 'password'])
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="dropdownCheck">
                                <label class="form-check-label" for="dropdownCheck">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="col text-right">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
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
                <p>Don't have an account? <a href="#">Sign up</a></p>
            </div>
        </div>
    </div>
</div>
