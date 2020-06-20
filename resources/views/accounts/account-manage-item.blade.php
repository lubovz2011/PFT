<li class="list-group-item border-top-0 py-3" data-toggle="collapse" data-target="#collapse-{{$id}}">
    <div class="row">
        <div class="col-6">{{$accountName}}</div>
{{--        <div class="col d-flex justify-content-center text-secondary">{{$accountType}}</div>--}}
        <div class="col d-flex justify-content-center">{{number_format($balance, 2, '.', ',')}} {{$currency}}</div>
        <div class="col d-flex justify-content-center">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="bank-category-toggle" checked>
                <label class="custom-control-label " for="bank-category-toggle"></label>
            </div>
        </div>
    </div>
</li>
<li class="list-group-item py-3 collapse" id="collapse-{{$id}}" data-parent="#accordion-accounts">
    <form>
        <div class="row">
            <div class="form-group col">
                <input type="text" class="form-control" id="wallet-name-Input" placeholder="Wallet">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-7">
                <div class="input-group mb-3">
                    <label class="form-control border-right-0 col-4">Initial Balance</label>
                    <input type="text" class="form-control col-6" readonly placeholder="13.00                     ILS" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button" id="button-addon2">Change</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl input-group">
                <label class="form-control border-right-0 col">Current Balance</label>
                <input type="text" class="form-control text-right col-5" id="initial-balance-Input" value="{{number_format($balance, 2, '.', ',')}}      {{$currency}}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="report-account-switch">
                    <label class="custom-control-label" for="report-account-switch">Include In Reports</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button class="btn btn-secondary"
                        type="button"
                        data-toggle="modal"
                        data-target="#delete-account-modal-{{$id}}">
                        Delete
                </button>
            </div>
            <div class="col d-flex justify-content-end">
                <button class="btn btn-secondary mr-2" type="submit">Cancel</button>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
</li>

<div class="modal fade" id="delete-account-modal-{{$id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    Are you sure you want to delete {{$accountName}} account?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('delete-account-form-{{$id}}').submit();"
                   class="btn btn-primary">Yes</a>
                <form id="delete-account-form-{{$id}}" action="{{ route('delete-account') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                </form>
            </div>
        </div>
    </div>
</div>

