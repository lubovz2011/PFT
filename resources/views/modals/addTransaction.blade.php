<div class="modal fade" id="add-transaction-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-size-400" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Transaction</h5>
                <button type="reset" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="px-4 py-3" method="POST" action="{{route('add-transaction')}}">
                    @csrf
                    {{--select transaction type--}}
                    <div class="btn-group btn-group-toggle d-flex justify-content-center mb-3" data-toggle="buttons">
                        <label class="btn btn-outline-success font-weight-bold mr-1 py-2">
                            <input type="radio"
                                   name="type"
                                   value="income"
                                   @if(old('type', 'income') == 'income') checked @endif
                                   required>
                            Income
                        </label>
                        <label class="btn btn-outline-danger font-weight-bold py-2">
                            <input type="radio"
                                   name="type"
                                   value="expense"
                                   @if(old('type') == 'expense') checked @endif
                                   required>
                            Expense
                        </label>
                    </div>
                    {{--select transaction account--}}
                    <div class="form-group">
                        <select class="form-control @error('account') is-invalid @enderror" name="account" required>
                            @php /** @var \App\Models\Account[] $accounts */ @endphp
                            @foreach($accounts as $account)
                                <option
                                    value="{{$account->id}}"
                                    @if(old('account') == $account->id) selected @endif>
                                    {{$account->title}}
                                </option>
                            @endforeach
                        </select>
                        @include('utils.error-invalid-feedback', ["errorField" => 'account'])
                    </div>
                    {{--select transaction category--}}
                    <div class="form-group">
                        <select class="form-control @error('category') is-invalid @enderror" name="category" required>
                            @php /** @var \App\Models\Category[] $categories */ @endphp
                            @foreach($categories as $category)
                                @if($category->status)
                                    <optgroup label="{{$category->name}}">
                                        <option
                                                value="{{$category->id}}"
                                                @if(old('category') == $category->id) selected @endif
                                                @if(!$category->status) disabled @endif>
                                            {{$category->name}}
                                        </option>
                                        @foreach($category->categories as $subCategory)
                                            @if($subCategory->status)
                                                <option
                                                        value="{{$subCategory->id}}"
                                                        @if(old('category') == $subCategory->id) selected @endif
                                                        @if(!$subCategory->status || !$category->status) disabled @endif>
                                                    {{$subCategory->name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endif
                            @endforeach
                        </select>
                        @include('utils.error-invalid-feedback', ["errorField" => 'category'])
                    </div>
                    {{--add transaction date--}}
                    <div class="form-group">
                        <input type="date"
                               class="form-control @error('date') is-invalid @enderror"
                               name="date"
                               value="{{old('date', \Carbon\Carbon::now()->format('Y-m-d'))}}"
                               placeholder=""
                               required>
                        @include('utils.error-invalid-feedback', ["errorField" => 'date'])
                    </div>
                    {{--add transaction amount--}}
                    <div class="form-group">
                        <input type="text"
                               class="form-control @error('amount') is-invalid @enderror"
                               name="amount"
                               value="{{old('amount')}}"
                               placeholder="Amount"
                               autocomplete="off">
                        @include('utils.error-invalid-feedback', ["errorField" => 'amount'])
                    </div>
                    {{--add transaction description--}}
                    <div class="form-group">
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description"
                                  placeholder="Description"
                                  rows="3">{{old('description')}}</textarea>
                        @include('utils.error-invalid-feedback', ["errorField" => 'description'])
                    </div>
                    <div class="col d-flex justify-content-center">
                        {{--cancel all--}}
                        <button class="btn btn-secondary mr-2 px-3" type="reset" data-dismiss="modal">
                            Cancel
                        </button>
                        {{--add new transaction--}}
                        <button class="btn btn-primary px-4" type="submit">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
