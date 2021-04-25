<div class="card">
    <div class="card-header collapsed" id="personal-info-header" data-toggle="collapse" data-target="#section-personal-info">
        <h2 class="mb-0">
            <button class="btn shadow-none" type="button">
                Personal Info
            </button>
            <div class="float-right">
                <i class="arrow up mb-1"></i>
            </div>
        </h2>
    </div>
    <div id="section-personal-info"
         class="collapse @if($errors->has('name') || $errors->has('login')) show @endif"
         data-parent="#accordion-settings">
        <div class="card-body">
            <form method="POST" action="{{route("settings:personal-info")}}">
                @csrf
                {{--input name--}}
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="inputName"
                               placeholder="user name"
                               name="name"
                               value="{{ old('name', $name) }}"
                               default-value="{{$name}}"
                               autocomplete="off">
                        @include('utils.error-invalid-feedback', ["errorField" => 'name'])
                    </div>
                </div>
                {{--input login (mail)--}}
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control @error('login') is-invalid @enderror"
                               id="inputEmail3"
                               placeholder="email@example.com"
                               name="login"
                               value="{{ old('login', $login) }}"
                               default-value="{{$login}}"
                               autocomplete="off"
                               @if($socialLogin) disabled @endif
                        >
                        @include('utils.error-invalid-feedback', ["errorField" => 'login'])
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        {{--delete profile--}}
                        <button class="btn btn-secondary"
                                type="button"
                                data-toggle="modal"
                                data-target="#delete-profile-modal">
                            Delete Profile
                        </button>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-secondary mr-2" type="reset">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--delete modal--}}
<div class="modal fade" id="delete-profile-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
               <p>
                   Are you sure you want to delete your account?
               </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('delete-profile-form').submit();"
                   class="btn btn-primary">Yes</a>
                <form id="delete-profile-form" action="{{ route('settings:delete-profile') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
