<li class="list-group-item py-3" data-toggle="collapse" data-target="#collapse-{{$id}}">
    <div class="row">
        <div class="col">
            <i class="{{$categoryIcon}} mr-2 category-icon text-secondary"></i> {{$categoryName}}
        </div>
        <div class="col d-flex justify-content-end">
            <div class="font-weight-bold {{$amount > 0 ? 'text-success' : 'text-danger'}} mr-2">{{$amount}}</div>
            <div class="text-secondary">{{$currency}}</div>
        </div>
    </div>
</li>
<li class="list-group-item py-3 px-5 collapse bg-light" id="collapse-{{$id}}" data-parent="#accordion-accounts">
    <form>
        <div class="row">
            <div class="form-group col">
                <select class="form-control" id="wallet-select">
                    <option value="wallets" disabled>WALLETS</option>
                    <option value="1" selected>Wallet</option>
                    <option value="2">Piggy Bank</option>
                </select>
            </div>
            <div class="form-group col">
                <select class="form-control" id="category-select">
                    <option value="categories" disabled>CATEGORIES</option>
                    <option value="1">Bills</option>
                    <option value="2">Tax & Fees</option>
                    <option value="3">Income</option>
                    <option value="4">Home</option>
                    <option value="5">Health & Fitness</option>
                    <option value="6">Pets</option>
                    <option value="7" selected>Education</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="form-group col">
                        <select class="form-control" id="type-select">
                            <option value="1" selected>Expense</option>
                            <option value="2">Income</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <input type="text" class="form-control text-right" value="" placeholder="-25  ILS">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <input type="date" class="form-control" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="form-group col-6">
                <textarea class="form-control h-100" id="description-input" placeholder="Description" rows="3"></textarea>
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


