<form class="px-3" method="GET" action="{{Request::url()}}">
    <div class="row my-3">
        <div class="col">
            <h6 class="text-white text-center">FILTERS</h6>
        </div>
    </div>

    <div class="row">
        <div class="form-group col">
            <select class="form-control" name="filter-times">
                <option></option>
                <option value="1" >Today</option>
                <option value="2">Yesterday</option>
                <option value="3">Last 7 days</option>
                <option value="4">Last 30 days</option>
                <option value="5">This Month</option>
                <option value="6">Last Month</option>
            </select>
        </div>
    </div>
    @if($showTypeSelect)
    <div class="row">
        <div class="form-group col">
            <select class="form-control" name="filter-types">
                <option></option>
                <option value="income">Income</option>
                <option value="expense">Expense</option>
            </select>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="form-group col">
            <select class="form-control" name="filter-accounts[]" multiple>
                @php /** @var \App\Models\Account[] $accounts */ @endphp
                @foreach($accounts as $account)
                    <option value="{{$account->id}}">{{$account->title}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <select class="form-control" name="filter-categories[]" multiple>
                @php /** @var \App\Models\Category[] $categories */ @endphp
                @foreach($categories as $category)
                    <optgroup label="{{$category->name}}">
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                        @foreach($category->categories as $subCategory)
                            <option value="{{$subCategory->id}}">
                                {{$subCategory->name}}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col mt-2 d-flex justify-content-center">
        <button class="btn btn-primary mr-2 px-3" type="submit">Apply filters</button>
    </div>
</form>
