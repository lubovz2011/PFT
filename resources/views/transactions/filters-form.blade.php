<form class="px-3">
    <div class="row my-3">
        <div class="col">
            <h6 class="text-white text-center">FILTERS</h6>
        </div>
    </div>

    <div class="row">
        <div class="form-group col">
            <select class="form-control" >
                <option value="allDates" selected>All Time</option>
                <option value="1" >Today</option>
                <option value="2">Yesterday</option>
                <option value="3">Last 7 days</option>
                <option value="4">Last 30 days</option>
                <option value="5">This Month</option>
                <option value="6">Last Month</option>
                <option value="7">Custom range</option>
            </select>
        </div>
    </div>
    @if($showTypeSelect)
    <div class="row">
        <div class="form-group col">
            <select class="form-control" >
                <option value="allTypes" selected>All Types</option>
                <option value="1">Income</option>
                <option value="2">Expense</option>
            </select>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="form-group col">
            <select class="form-control" >
                <option value="allAccounts" selected>All Accounts</option>
                <option value="1">Wallet</option>
                <option value="2">Piggy Bank</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <select class="form-control" >
                <option value="allCategories" selected>All Categories</option>
                <option value="1">Bills</option>
                <option value="2">Tax & Fees</option>
                <option value="3">Income</option>
                <option value="4">Home</option>
                <option value="5">Health & Fitness</option>
                <option value="6">Pets</option>
                <option value="7">Education</option>
            </select>
        </div>
    </div>
    <div class="col d-flex justify-content-center">
        <button class="btn btn-primary mr-2 px-3" type="submit">Apply filters</button>
    </div>
</form>
