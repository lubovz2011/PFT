<div class="card">
    <div class="card-header" id="security-header">
        <h2 class="mb-0">
            <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#security-info" aria-expanded="true" aria-controls="collapseOne">
                Security
            </button>
        </h2>
    </div>
    <div id="security-info"
         class="collapse @if($errors->has('password')) show @endif"
         aria-labelledby="security-header"
         data-parent="#accordion-settings">
        <div class="card-body">
            <form method="POST" action="{{route("settings:security")}}">
            @csrf
            <div class="form-group row">
                <label for="inputPassword" class="col-md-4 col-lg-4 col-form-label">New password</label>
                <div class="col-md-8 col-lg-8">
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="inputPassword"
                           name="password">
                    @include('utils.error-invalid-feedback', ["errorField" => 'password'])
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPasswordConfirmation" class="col-md-4 col-lg-4 col-form-label">Password confirmation</label>
                <div class="col-md-8 col-lg-8">
                    <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-secondary mr-2" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
