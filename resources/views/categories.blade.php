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
                                    <option value="0" selected>Without parent category</option>
                                    <option value="1">Bills</option>
                                    <option value="2">Tax & Fees</option>
                                    <option value="3">Income</option>
                                    <option value="4">Home</option>
                                    <option value="5">Health & Fitness</option>
                                    <option value="6">Pets</option>
                                    <option value="7">Education</option>
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
                            {{--<div class="col-auto">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary form-control">Delete</button>
                            </div>--}}
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-categories">
                        <div class="card">
                            <div class="card-header row py-3" id="category-bills" data-toggle="collapse" data-target="#sub-category-bills" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-file-invoice-dollar mr-2 category-icon text-secondary"></i> Bills
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="bills-category-toggle" checked>
                                        <label class="custom-control-label " for="bills-category-toggle"></label>
                                    </div>
                                    <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                </div>
                            </div>
                            <div id="sub-category-bills" class="collapse" aria-labelledby="category-bills" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Internet
                                            <div class="d-flex justify-content-end">
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" id="internet-category-toggle" checked>
                                                    <label class="custom-control-label " for="internet-category-toggle"></label>
                                                </div>
                                                <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Phone
                                            <div class="d-flex justify-content-end">
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" id="phone-category-toggle" checked>
                                                    <label class="custom-control-label " for="phone-category-toggle"></label>
                                                </div>
                                                <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Rent
                                            <div class="d-flex justify-content-end">
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" id="rent-category-toggle" checked>
                                                    <label class="custom-control-label " for="rent-category-toggle"></label>
                                                </div>
                                                <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-tax" data-toggle="collapse" data-target="#sub-category-tax" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-coins mr-2 category-icon text-secondary"></i> Tax & Fees
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="tax-category-toggle" checked>
                                        <label class="custom-control-label" for="tax-category-toggle"></label>
                                    </div>
                                    <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                </div>
                            </div>
                            <div id="sub-category-tax" class="collapse" aria-labelledby="category-tax" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Bank Fees
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="bank-category-toggle" checked>
                                                <label class="custom-control-label " for="bank-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Service Fee
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="service-category-toggle" checked>
                                                <label class="custom-control-label " for="service-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Taxes
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="taxes-category-toggle" checked>
                                                <label class="custom-control-label " for="taxes-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-income" data-toggle="collapse" data-target="#sub-category-income" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-hand-holding-usd mr-2 category-icon text-secondary"></i> Income
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="income-category-toggle" checked>
                                        <label class="custom-control-label " for="income-category-toggle"></label>
                                    </div>
                                    <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                </div>
                            </div>
                            <div id="sub-category-income" class="collapse" aria-labelledby="category-income" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Salary
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="salary-category-toggle" checked>
                                                <label class="custom-control-label " for="salary-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Bonus
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="bonus-category-toggle" checked>
                                                <label class="custom-control-label " for="bonus-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Investment Income
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="investment-category-toggle" checked>
                                                <label class="custom-control-label " for="investment-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-home" data-toggle="collapse" data-target="#sub-category-home" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-home mr-2 category-icon text-secondary"></i> Home
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="home-category-toggle" checked>
                                        <label class="custom-control-label " for="home-category-toggle"></label>
                                    </div>
                                    <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                </div>
                            </div>
                            <div id="sub-category-home" class="collapse" aria-labelledby="category-home" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Home Services
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="services-category-toggle" checked>
                                                <label class="custom-control-label " for="services-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Decoration
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="decoration-category-toggle" checked>
                                                <label class="custom-control-label " for="decoration-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Home Supplies
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="supplies-category-toggle" checked>
                                                <label class="custom-control-label " for="supplies-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-health" data-toggle="collapse" data-target="#sub-category-health" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-heartbeat mr-2 category-icon text-secondary"></i> Health & Fitness
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="health-category-toggle" checked>
                                        <label class="custom-control-label " for="health-category-toggle"></label>
                                    </div>
                                    <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                </div>
                            </div>
                            <div id="sub-category-health" class="collapse" aria-labelledby="category-health" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Fitness & Sport
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="sport-category-toggle" checked>
                                                <label class="custom-control-label " for="sport-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Healthcare
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="healthcare-category-toggle" checked>
                                                <label class="custom-control-label " for="healthcare-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Personal Care
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="personal-category-toggle" checked>
                                                <label class="custom-control-label " for="personal-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-pets" data-toggle="collapse" data-target="#sub-category-pets" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-paw mr-2 category-icon text-secondary"></i> Pets
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="pets-category-toggle" checked>
                                        <label class="custom-control-label " for="pets-category-toggle"></label>
                                    </div>
                                    <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                </div>
                            </div>
                            <div id="sub-category-pets" class="collapse" aria-labelledby="category-pets" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Food
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="food-category-toggle" checked>
                                                <label class="custom-control-label " for="food-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Vet & Healthcare
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="vet-category-toggle" checked>
                                                <label class="custom-control-label " for="vet-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Toys
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="toys-category-toggle" checked>
                                                <label class="custom-control-label " for="toys-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-education" data-toggle="collapse" data-target="#sub-category-education" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-user-graduate mr-2 category-icon text-secondary"></i> Education
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="education-category-toggle" checked>
                                        <label class="custom-control-label " for="education-category-toggle"></label>
                                    </div>
                                    <div class="text-secondary"><i class="far fa-trash-alt"></i></div>
                                </div>
                            </div>
                            <div id="sub-category-education" class="collapse" aria-labelledby="category-education" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tuition
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="tuition-category-toggle" checked>
                                                <label class="custom-control-label " for="tuition-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Books & Supplies
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="books-category-toggle" checked>
                                                <label class="custom-control-label " for="books-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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


