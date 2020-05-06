<li class="list-group-item py-3" data-toggle="collapse" data-target="#collapse-{{$id}}">
    <div class="row">
        <div class="col">{{$accountName}}</div>
        <div class="col d-flex justify-content-center text-secondary">{{$accountType}}</div>
        <div class="col d-flex justify-content-center">{{$amount}} {{$currency}}</div>
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
            <div class="col">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Initial Balance&nbsp;
                            <label class="form-check-label">Change
                                <input type="checkbox" class="invisible js-visibility-toggle">
                            </label>
                        </div>
                    </div>
                    <input type="number" class="form-control text-right js-visibility-toggled" id="initial-balance-Input" value="{{$initialAmount}} {{$currency}}" readonly>
                </div>
            </div>
            <div class="col-4 form-group">
                <input type="text" class="form-control text-right" id="initial-balance-Input" value="{{$amount}} {{$currency}}" readonly>
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
                <button class="btn btn-secondary" type="submit">Delete</button>
            </div>
            <div class="col d-flex justify-content-end">
                <button class="btn btn-secondary mr-2" type="submit">Cancel</button>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>


</li>
