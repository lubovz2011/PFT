@extends("layout")
@section("title")
    Categories
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-10 col-lg-8">
            <div class="card shadow-card border-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Categories</h5>
                </div>
                {{--  Add new category  --}}
                <div class="card-body">
                    <form method="POST" action="{{route('add-category')}}">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="category-input">Name</label>
                                <input
                                    name="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="category-input"
                                    value="{{old('name')}}">
                            </div>
                            <div class="col-auto">
                                <label class="" for="parent-category-select">Parent Category</label>
                                <select class="form-control @error('parent') is-invalid @enderror"
                                        id="parent-category-select" name="parent">
                                    <option value="" selected>Without parent category</option>
                                    @foreach($categories as $category)
                                        @if($category['status'])
                                            <option
                                                value="{{$category['id']}}"
                                                @if(old('parent') == $category['id']) selected @endif>
                                                {{$category['name']}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="icon-category-select">Icon</label>
                                <select class="form-control @error('icon') is-invalid @enderror"
                                        id="icon-category-select" name="icon">
                                    @foreach($icons as $icon)
                                        <option value="{{$icon['class']}}"
                                                @if(old('icon') == $icon['class']) selected @endif>
                                            {{$icon['name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-auto">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary form-control">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{--  Categories list accordion  --}}
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-categories">
                        @foreach($categories as $category)
                            @include('categories.category-manage-item', $category)
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section("scripts")
    <script>
        /**
         * Run script only when document will be loaded and ready for usage
         */
        $(document).ready(function(){
            /**
             * Initialize Select2 component for each select element
             */
            $("select").select2({
                theme : "bootstrap"
            });


            $('select[name="icon"]').select2({
               theme : "bootstrap",
                templateResult: function(data) {
                   console.log(data);
                    return $(`<span><i class="${data.id}"></i> ${data.text}</span>`);
                }
            });

            /**
             *  Find all labels for custom checkboxes
             *
             * @type {jQuery|HTMLElement}
             */
            let customCheckboxLabel = $('.custom-switch  label');
            /**
             * Set event listener for each custom checkbox label
             */
            customCheckboxLabel.on('click', function(e){
                // on click we prevent 'bubbling'
                e.preventDefault();
                e.stopPropagation();
                /**
                 * Find checkbox element a label is bound to
                 * @type {jQuery}
                 */
                let checkbox = $('#' + $(this).prop('for'));
                // Change checkbox state for checked\unchecked
                changeStatus(checkbox.data('id'), +!checkbox.prop('checked'))
            });

            function changeStatus(id, status)
            {
                $.ajax(
                    {
                        method: "POST",
                        url: '{{route('change-status')}}',
                        data: {
                            "categoryId" : id,
                            "status" : status
                        }
                    }
                ).done(function(data){
                    $("#" + data.id + "-category-toggle").prop('checked', data.status === "1");
                    for(let category of data.categories) {
                        $("#" + category.id + "-category-toggle").prop('checked', category.status === "1");
                    }
                    if(data.parent_id == null){
                        if(data.status == 1){
                            $('#parent-category-select').append($('<option value="' + data.id + '">' + data.name + '</option>'));
                            let options = $('#parent-category-select option');
                            var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                            arr.sort(function(o1, o2) { return o1.v - o2.v; });
                            options.each(function(i, o) {
                                o.value = arr[i].v;
                                $(o).text(arr[i].t);
                            });
                        }
                        else{
                            $('#parent-category-select option[value="'+ data.id +'"]').remove();
                        }
                        $('#parent-category-select').select2({
                            theme : "bootstrap"
                        });

                    }

                });
            }

            let deleteButton = $('.js-delete-category');

            deleteButton.on('click', function (e) {
                // on click we prevent 'bubbling'
                e.preventDefault();
                e.stopPropagation();

                deleteCategory($(this).data('id'));
            });

            function deleteCategory(id){
                $.ajax(
                    {
                        method: "POST",
                        url: '{{route('delete-category')}}',
                        data: {
                            "categoryId" : id
                        }
                    }
                ).done(function (data) {
                    if(data.status === "success"){
                        $('.js-category-' + id + '-container').remove();
                        $('#parent-category-select option[value="'+ id +'"]').remove();
                        $('#parent-category-select').select2({
                            theme : "bootstrap"
                        });
                    }

                    else
                        alert("Ops, something went wrong. Try again.");
                });
            }
        });
    </script>
@endsection


