<li class="list-group-item border-top-0 py-3" data-toggle="collapse" data-target="#collapse-{{$account->id}}">
    <div class="row">
        <div class="col-6 ml-4">{{$account->title}}</div>
        <div class="col d-flex justify-content-end">
            <span class="mr-2 @if($account->balance >= 0) text-success @else text-danger @endif font-weight-bold">
                {{number_format($account->balance, 2, '.', ',')}}
            </span>
                {{$account->currency}}
        </div>
    </div>
</li>
<li class="list-group-item py-3 collapse
           @if($errors->hasAny(["id", "a-{$account->id}-title"])) show @endif"
    id="collapse-{{$account->id}}" data-parent="#accordion-accounts">
    <form method="POST" action="{{route('update-account')}}">
        @csrf
        <input type="hidden" name="id" value="{{$account->id}}">
        <div class="row">
            <div class="form-group col">
                <input name="a-{{$account->id}}-title"
                       type="text"
                       class="form-control @error("a-{$account->id}-title") is-invalid @enderror"
                       value="{{old("a-{$account->id}-title", $account->title)}}">
                @include('utils.error-invalid-feedback', ['errorField' => "a-{$account->id}-title"])
            </div>
        </div>
        <div class="row">
        {{-- Current Balance --}}
            <div class="col-4 form-group">
                <label>Current Balance</label>
                <input type="text" class="form-control text-right" id="initial-balance-Input" value="{{number_format($account->balance, 2, '.', ',')}} {{$account->currency}}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="report-account-switch">
                    <label class="custom-control-label" for="report-account-switch">Include In Reports</label>
                </div>
            </div>
            <div class="col d-flex justify-content-end">
                <button class="btn btn-secondary mr-2"
                        type="button"
                        data-toggle="modal"
                        data-target="#delete-account-modal-{{$account->id}}">
                    Delete
                </button>
                <button class="btn btn-secondary mr-2" type="submit">Cancel</button>
                <button class="btn btn-primary pr-3 pl-3" type="submit">Save</button>
            </div>
        </div>
    </form>
</li>

<div class="modal fade" id="delete-account-modal-{{$account->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    Are you sure you want to delete {{$account->title}} account?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('delete-account-form-{{$account->id}}').submit();"
                   class="btn btn-primary">Yes</a>
                <form id="delete-account-form-{{$account->id}}" action="{{ route('delete-account') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{$account->id}}">
                </form>
            </div>
        </div>
    </div>
</div>

