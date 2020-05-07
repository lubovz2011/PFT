<div class="modal fade" id="add-transaction-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-size-400" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="px-4 py-3">
                    <div class="btn-group btn-group-toggle d-flex justify-content-center mb-3" data-toggle="buttons">
                        <label class="btn btn-outline-success font-weight-bold mr-1 py-2">
                            <input type="radio" name="options" id="option1"> Income
                        </label>
                        <label class="btn btn-outline-danger font-weight-bold py-2">
                            <input type="radio" name="options" id="option3"> Expense
                        </label>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="wallet-select">
                            <option value="wallets" selected>WALLETS</option>
                            <option value="1">Wallet</option>
                            <option value="2">Piggy Bank</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="category-select">
                            <option value="categories" selected>CATEGORIES</option>
                            <option value="1">Bills</option>
                            <option value="2">Tax & Fees</option>
                            <option value="3">Income</option>
                            <option value="4">Home</option>
                            <option value="5">Health & Fitness</option>
                            <option value="6">Pets</option>
                            <option value="7">Education</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" value="" placeholder="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-right" value="" placeholder="0 ILS">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="description-input" placeholder="Description" rows="3"></textarea>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <button class="btn btn-secondary mr-2 px-3" type="submit">Cancel</button>
                        <button class="btn btn-primary px-4" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
