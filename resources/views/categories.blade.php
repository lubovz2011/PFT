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
                    <form>
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label class="" for="category-input">Name</label>
                                <input type="text" class="form-control" id="category-input" placeholder="">
                            </div>
                            <div class="col-auto">
                                <label class="" for="parent-category-select">Parent Category</label>
                                <select class="form-control" id="parent-category-select">
                                    <option value="" selected>Without parent category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="icon-category-select">Icon</label>
                                <select class="form-control" id="icon-category-select">
                                    <option value="fas fa-anchor" selected>No Icon</option>
                                    <option value="fas fa-ice-cream">ice-cream</option>
                                    <option value="fas fa-gas-pump">Gas-Pump</option>
                                    <option value="fas fa-tools">Tools</option>
                                    <option value="fas fa-book">Book</option>
                                    <option value="fas fa-bus-alt">Bus</option>
                                    <option value="fas fa-swimmer">Swimmer</option>
                                    <option value="fas fa-umbrella-beach">Umbrella Beach</option>
                                    <option value="fas fa-dumbbell">Dumbbell</option>
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
        $(document).ready(function(){
            $("select").select2({
                theme : "bootstrap"
            });
        });
    </script>
@endsection


