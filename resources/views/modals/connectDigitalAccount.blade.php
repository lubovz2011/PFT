<div class="modal fade show" id="connect-digital-account" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Connect Digital Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('connect-digital-account') }}">
                    @csrf
                    <div class="form-group">
                        <select class="form-control @error('bank') is-invalid @enderror" name="bank">
                            <option value="otsar" @if(old('bank') == "otsar") selected @endif>
                                Bank Otsar Hahayal
                            </option>
                        </select>
                        @include('utils.error-invalid-feedback', ['errorField' => 'bank'])
                    </div>
                    <div class="form-group">
                        @include('utils.secure-field', [
                            'class' => $errors->has('username') ? 'is-invalid' : '',
                            'placeholder' => 'User ID',
                            'name' => 'username',
                            'value' => old('username'),
                            'autocomplete' => 'off'
                        ])
                        @include('utils.error-invalid-feedback', ['errorField' => 'username'])
                    </div>

                    <div class="form-group">
                        @include('utils.secure-field', [
                            'class' => $errors->has('password') ? 'is-invalid' : '',
                            'placeholder' => 'Password',
                            'name' => 'password',
                            'value' => old('password'),
                            'autocomplete' => 'off'
                        ])
                        @include('utils.error-invalid-feedback', ['errorField' => 'password'])
                    </div>

                    <div class="col d-flex justify-content-center">
                        <button class="btn btn-secondary mr-2 px-3" data-dismiss="modal" type="reset">
                            Cancel
                        </button>
                        <button class="btn btn-primary px-4" type="submit" onclick="loaderStart()">
                            Connect
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
