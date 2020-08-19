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
                @foreach(\App\Classes\Utils\DataSets::getDateOptions() as $key => $option)
                    <option value="{{$key}}" @if(request()->get('filter-times') == $key) selected @endif>{{$option}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <select class="form-control" name="filter-types">
                <option></option>
                @foreach(\App\Classes\Utils\DataSets::getTypeOptions() as $key => $option)
                    <option value="{{$key}}" @if(request()->get('filter-types') == $key) selected @endif>{{$option}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <select class="form-control" name="filter-accounts[]" multiple>
                @php /** @var \App\Models\Account[] $accounts */ @endphp
                @foreach($accounts as $account)
                    <option value="{{$account->id}}" @if(in_array($account->id, request()->get('filter-accounts') ?? [])) selected @endif>{{$account->title}}</option>
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
                        <option value="{{$category->id}}" @if(in_array($category->id, request()->get('filter-categories') ?? [])) selected @endif>
                            {{$category->name}}
                        </option>
                        @foreach($category->categories as $subCategory)
                            <option value="{{$subCategory->id}}" @if(in_array($subCategory->id, request()->get('filter-categories') ?? [])) selected @endif>
                                {{$subCategory->name}}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-2 d-flex justify-content-center">
        <button class="btn btn-primary mr-2 px-3" type="submit">Apply filters</button>
        <a href="{{Request::url()}}" class="btn btn-secondary mr-2 px-3" type="button">Clear filters</a>
    </div>
</form>
