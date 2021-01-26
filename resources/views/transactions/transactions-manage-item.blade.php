<li class="list-group-item py-3 border-top-0"
    data-toggle="collapse"
    data-target="#collapse-{{$transaction->id}}">
    <div class="row">
        <div class="col">
            <i class="{{$transaction->category->icon}} mr-2 category-icon text-secondary"></i>
            {{$transaction->category->name}}
        </div>
        {{--transaction amount in account currency--}}
        <div class="col d-flex justify-content-end">
            <div class="font-weight-bold {{$transaction->type == 'income' ? 'text-success' : 'text-danger'}} mr-2">
                {{\App\Helpers\Helpers::NumberFormat($transaction->amount)}}
            </div>
            <div class="text-secondary">
                {{$transaction->currency}}
            </div>
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
    {{--update transaction--}}
    <form method="POST" action="{{route('update-transaction')}}">
        @csrf
        <input type="hidden" name="id" value="{{$transaction->id}}">
        <div class="row">
            {{--update transaction account--}}
            <div class="form-group col-12 col-md-6 col-lg-6">
                <select default-value="{{$transaction->account_id}}"
                        class="form-control @error("t-{$transaction->id}-account") is-invalid @enderror" name="t-{{$transaction->id}}-account">
                    @php /** @var \App\Models\Account[] $accounts */ @endphp
                    @foreach($accounts as $account)
                        <option value="{{$account->id}}" @if(old("t-{$transaction->id}-account", $transaction->account_id) == $account->id) selected @endif>
                            {{$account->title}}
                        </option>
                    @endforeach
                </select>
                @include('utils.error-invalid-feedback', ["errorField" => "t-{$transaction->id}-account"])
            </div>

            @error("a-{$account->id}-title") is-invalid @enderror

            {{--update transaction category--}}
            <div class="form-group col">
                <select default-value="{{$transaction->category_id}}"
                        class="form-control @error("t-{$transaction->id}-category") is-invalid @enderror" name="t-{{$transaction->id}}-category">
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
                @include('utils.error-invalid-feedback', ["errorField" => "t-{$transaction->id}-category"])
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 col-md-6">
                <div class="row">
                    {{--update transaction type--}}
                    <div class="form-group col-12 col-lg-6 col-md-6">
                        <select default-value="{{$transaction->type}}"
                                class="form-control @error("t-{$transaction->id}-type") is-invalid @enderror" name="t-{{$transaction->id}}-type">
                            <option value="expense" @if(old("t-{$transaction->id}-type", $transaction->type) == "expense") selected @endif>
                                Expense
                            </option>
                            <option value="income" @if(old("t-{$transaction->id}-type", $transaction->type) == "income") selected @endif>
                                Income
                            </option>
                        </select>
                        @include('utils.error-invalid-feedback', ["errorField" => "t-{$transaction->id}-type"])
                    </div>
                    {{--update transaction amount--}}
                    <div class="form-group col">
                        <input type="text"
                               class="form-control text-right @error("t-{$transaction->id}-amount") is-invalid @enderror"
                               name="t-{{$transaction->id}}-amount"
                               autocomplete="off"
                               default-value="{{$transaction->amount}}"
                               value="{{old("t-{$transaction->id}-amount", $transaction->amount)}}">
                        @include('utils.error-invalid-feedback', ["errorField" => "t-{$transaction->id}-amount"])
                    </div>
                </div>
                <div class="row">
                    {{--update transaction date--}}
                    <div class="form-group col-12">
                        <input type="date"
                               class="form-control @error("t-{$transaction->id}-date") is-invalid @enderror"
                               name="t-{{$transaction->id}}-date"
                               default-value="{{$transaction->getDateForInput()}}"
                               value="{{old("t-{$transaction->id}-date", $transaction->getDateForInput())}}">
                        @include('utils.error-invalid-feedback', ["errorField" => "t-{$transaction->id}-date"])
                    </div>
                </div>
            </div>
            {{--update transaction description--}}
            <div class="form-group col-12 col-lg-6 col-md-6">
                <textarea class="form-control h-100 @error("t-{$transaction->id}-description") is-invalid @enderror"
                          rows="3"
                          default-value="{{$transaction->description}}"
                          name="t-{{$transaction->id}}-description">{{old("t-{$transaction->id}-description", $transaction->description)}}</textarea>
                @include('utils.error-invalid-feedback', ["errorField" => "t-{$transaction->id}-description"])
            </div>
        </div>
        {{--delete transaction--}}
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
                {{--cancel all changes--}}
                <button class="btn btn-secondary mr-2"
                        type="reset"
                        data-toggle="collapse"
                        data-target="#collapse-{{$transaction->id}}">
                    Cancel
                </button>
                {{--save all changes--}}
                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </div>
        </div>
    </form>
</li>

{{--delete transaction modal--}}
<div class="modal fade"
     id="delete-transaction-modal-{{$transaction->id}}"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this transaction?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"> No </button>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('delete-transaction-form-{{$transaction->id}}').submit();"
                   class="btn btn-primary"> Yes </a>
                <form id="delete-transaction-form-{{$transaction->id}}"
                      action="{{ route('delete-transaction') }}"
                      method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{$transaction->id}}">
                </form>
            </div>
        </div>
    </div>
</div>

