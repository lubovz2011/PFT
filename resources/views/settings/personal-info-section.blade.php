<div class="card">
    <div class="card-header" id="personal-info-header">
        <h2 class="mb-0">
            <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#section-personal-info" aria-expanded="true" aria-controls="collapseOne">
                Personal Info
            </button>
        </h2>
    </div>
    <div id="section-personal-info"
         class="collapse @if($errors->has('name') || $errors->has('login')) show @endif"
         aria-labelledby="personal-info-header"
         data-parent="#accordion-settings">
        <div class="card-body">
            <form method="POST" action="{{route("settings:personal-info")}}">
            @csrf
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="inputName"
                           placeholder="user name"
                           name="name"
                           value="{{ old('name', $name) }}">
                    @include('utils.error-invalid-feedback', ["errorField" => 'name'])
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control @error('login') is-invalid @enderror"
                           id="inputEmail3"
                           placeholder="email@example.com"
                           name="login"
                           value="{{ old('login', $login) }}">
                    @include('utils.error-invalid-feedback', ["errorField" => 'login'])
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <button class="btn btn-secondary" type="submit">Delete Profile</button>
                </div>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-secondary mr-2" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
