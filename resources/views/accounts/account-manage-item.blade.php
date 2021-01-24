<li class="list-group-item border-top-0 py-3"
    data-toggle="collapse"
    data-target="#collapse-{{$account->id}}">
    <div class="row">
        <div class="col-6 ml-4">{{$account->title}}</div>
        <div class="col d-flex justify-content-end">
            {{--current balance of current account in account currency--}}
            <span class="mr-2 js-account-balance
                        @if($account->balance >= 0) text-success @else text-danger @endif font-weight-bold">
                {{\App\Helpers\Helpers::NumberFormat($account->balance)}}
            </span>
                {{$account->currency}}
        </div>
    </div>
</li>

{{--update account--}}
<li class="list-group-item py-3 collapse
           @if($errors->hasAny(["id", "a-{$account->id}-title"])) show @endif"
    id="collapse-{{$account->id}}" data-parent="#accordion-accounts">
    <form method="POST" action="{{route('update-account')}}">
        @csrf
        <input type="hidden" name="id" value="{{$account->id}}">

        {{--update account name--}}
        <div class="row">
            <div class="form-group col">
                <input name="a-{{$account->id}}-title"
                       type="text"
                       class="form-control @error("a-{$account->id}-title") is-invalid @enderror"
                       value="{{old("a-{$account->id}-title", $account->title)}}"
                       autocomplete="off">
                @include('utils.error-invalid-feedback', ['errorField' => "a-{$account->id}-title"])
            </div>
        </div>

        {{--switch to choose current account to include or not include in reports--}}
        <div class="row">
            <div class="col-6 form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox"
                           class="custom-control-input"
                           id="report-account-switch-{{$account->id}}"
                           name="a-{{$account->id}}-status"
                           @if(old("a-{$account->id}-status", $account->status)) checked @endif>
                    <label class="custom-control-label"
                           for="report-account-switch-{{$account->id}}">Include In Reports
                    </label>
                </div>
            </div>
            <div class="col d-flex justify-content-end">

                {{--delete account--}}
                <button class="btn btn-secondary mr-2"
                        type="button"
                        data-toggle="modal"
                        data-target="#delete-account-modal-{{$account->id}}">
                    Delete
                </button>

                {{--cancel changes--}}
                <button class="btn btn-secondary mr-2"
                        type="reset"
                        data-toggle="collapse"
                        data-target="#collapse-{{$account->id}}">
                    Cancel
                </button>

                {{--transactions synchronization--}}
                @if($account->type == \App\Models\Account::TYPE_CARD)
                    <button class="btn btn-primary pr-3 pl-3 mr-2 js-synchronize-buttom"
                            type="button"
                            data-account="{{$account->id}}">
                        Synchronize
                    </button>
                @endif

                {{--save all changes--}}
                <button class="btn btn-primary pr-3 pl-3"
                        type="submit">
                    Save
                </button>
            </div>
        </div>
    </form>
</li>

{{--delete account modal--}}
<div class="modal fade"
     id="delete-account-modal-{{$account->id}}"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    Are you sure you want to delete {{$account->title}} account?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"> No </button>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('delete-account-form-{{$account->id}}').submit();"
                   class="btn btn-primary"> Yes </a>
                <form id="delete-account-form-{{$account->id}}"
                      action="{{ route('delete-account') }}"
                      method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{$account->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
