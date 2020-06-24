<div class="card">
    {{--  Parent category --}}
    <div class="card-header row py-3" id="category-{{$id}}" data-toggle="collapse" data-target="#sub-category-{{$id}}">
        <div class="col">
            {{--  category name and icon  --}}
            <i class="{{$icon}} mr-2 category-icon text-secondary"></i> {{$name}}
        </div>
        {{--  category edit controls  --}}
        <div class="col d-flex justify-content-end">
            <div class="custom-control custom-switch mr-2">
                <input type="checkbox"
                       class="custom-control-input"
                       id="{{$id}}-category-toggle"
                       name="status"
                       @if($status) checked @endif>
                <label class="custom-control-label " for="{{$id}}-category-toggle"></label>
            </div>
            <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
        </div>
    </div>
    {{--  Sub-Categories list  --}}
    <div id="sub-category-{{$id}}" class="collapse" data-parent="#accordion-categories">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($categories as $category)
                    {{--  sub category  --}}
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{--  category name  --}}
                        {{$category['name']}}
                        {{--  category edit controls  --}}
                        <div class="d-flex justify-content-end">
                            <div class="custom-control custom-switch mr-2">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="{{$id}}-category-toggle"
                                       name="status"
                                       @if($status) checked @endif>
                                <label class="custom-control-label " for="{{$id}}-category-toggle"></label>
                            </div>
                            <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
