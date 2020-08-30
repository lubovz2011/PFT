<li class="list-group-item py-3" data-toggle="collapse" data-target="#collapse-{{$transaction->id}}">
    <div class="row">
        <div class="col">
            <i class="{{$transaction->category->icon}} mr-2 category-icon text-secondary"></i> {{$transaction->category->name}}
        </div>
        <div class="col d-flex justify-content-end">
            <div class="font-weight-bold {{$transaction->type == 'income' ? 'text-success' : 'text-danger'}} mr-2">{{$transaction->getPrettyAmount()}}</div>
            <div class="text-secondary">{{$transaction->currency}}</div>
        </div>
    </div>
</li>
<li class="list-group-item py-3 px-5 collapse bg-light
           @if($errors->hasAny(["id",
                                "t-{$transaction->id}-type",
                                "t-{$transaction->id}-account",
                                "t-{$transaction->id}-category",
                                "t-{$transaction->id}-amount",
                                "t-{$transaction->id}-description",
                                "t-{$transaction->id}-date"])) show @endif"
    id="collapse-{{$transaction->id}}" data-parent="#accordion-accounts">
    <form method="POST" action="{{route('update-transaction')}}">
        @csrf
        <input type="hidden" name="id" value="{{$transaction->id}}">
        <div class="row">
            <div class="form-group col">
                <select class="form-control" name="t-{{$transaction->id}}-account">
                    @php /** @var \App\Models\Account[] $accounts */ @endphp
                    @foreach($accounts as $account)
                        <option value="{{$account->id}}" @if(old("t-{$transaction->id}-account", $transaction->account_id) == $account->id) selected @endif>
                            {{$account->title}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col">
                <select class="form-control" name="t-{{$transaction->id}}-category">
                    @php /** @var \App\Models\Category[] $categories */ @endphp
                    @foreach($categories as $category)
                        <optgroup label="{{$category->name}}">
                            <option value="{{$category->id}}" @if(old("t-{$transaction->id}-category", $transaction->category_id) == $category->id) selected @endif>
                                {{$category->name}}
                            </option>
                            @foreach($category->categories as $subCategory)
                                <option value="{{$subCategory->id}}" @if(old("t-{$transaction->id}-category", $transaction->category_id) == $subCategory->id) selected @endif>
                                    {{$subCategory->name}}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="form-group col">
                        <select class="form-control" name="t-{{$transaction->id}}-type">
                            <option value="expense" @if(old("t-{$transaction->id}-type", $transaction->type) == "expense") selected @endif>Expense</option>
                            <option value="income" @if(old("t-{$transaction->id}-type", $transaction->type) == "income") selected @endif>Income</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <input type="text" class="form-control text-right" name="t-{{$transaction->id}}-amount" value="{{old("t-{$transaction->id}-amount", $transaction->getPrettyAmount())}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <input type="date" class="form-control" name="t-{{$transaction->id}}-date" value="{{old("t-{$transaction->id}-date", $transaction->getDateForInput())}}">
                    </div>
                </div>
            </div>
            <div class="form-group col-6">
                <textarea class="form-control h-100" rows="3" name="t-{{$transaction->id}}-description">{{old("t-{$transaction->id}-description", $transaction->description)}}</textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <button class="btn btn-secondary"
                        type="button"
                        data-toggle="modal"
                        data-target="#delete-transaction-modal-{{$transaction->id}}">
                    Delete
                </button>
            </div>
            <div class="col d-flex justify-content-end">
                <button class="btn btn-secondary mr-2" type="reset" data-toggle="collapse" data-target="#collapse-{{$transaction->id}}">Cancel</button>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
</li>
<div class="modal fade" id="delete-transaction-modal-{{$transaction->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this transaction?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('delete-transaction-form-{{$transaction->id}}').submit();"
                   class="btn btn-primary">Yes</a>
                <form id="delete-transaction-form-{{$transaction->id}}" action="{{ route('delete-transaction') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{$transaction->id}}">
                </form>
            </div>
        </div>
    </div>
</div>

