@extends("layout")
@section("style")
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-10 col-lg-8">
            <div class="card shadow-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <div class="media">
                        <span class="round-user-icon-container border border-success rounded-circle text-success content-box mr-3">
                            <i class="fa fa-user-circle"></i>
                        </span>
                        <div class="media-body">
                            <h5 class="uname-header">User name</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-settings">
                        <div class="card">
                            <div class="card-header" id="personal-info-header">
                                <h2 class="mb-0">
                                    <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#section-personal-info" aria-expanded="true" aria-controls="collapseOne">
                                        Personal Info
                                    </button>
                                </h2>
                            </div>
                            <div id="section-personal-info" class="collapse" aria-labelledby="personal-info-header" data-parent="#accordion-settings">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="user name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail3" placeholder="email@example.com">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary float-right">Save</button>
                                                <button type="button" class="btn btn-secondary float-right mr-2">Delete profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="interface-header">
                                <h2 class="mb-0">
                                    <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#section-interface" aria-expanded="true" aria-controls="collapseOne">
                                        Interface
                                    </button>
                                </h2>
                            </div>
                            <div id="section-interface" class="collapse" aria-labelledby="interface-header" data-parent="#accordion-settings">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group row">
                                            <label for="language-select" class="col-md-4 col-lg-4 col-form-label">Language</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="language-select" disabled>
                                                    <option value="en">English</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date-format-select" class="col-md-4 col-lg-4 col-form-label">Date format</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="date-format-select">
                                                    <option value="Y/m/d">YYYY/MM/DD ({{date("Y/m/d")}})</option>
                                                    <option value="m/d/Y">MM/DD/YYYY ({{date("m/d/Y")}})</option>
                                                    <option value="d/m/Y">DD/MM/YYYY ({{date("d/m/Y")}})</option>
                                                    <option value="d.m.Y">DD.MM.YYYY ({{date("d.m.Y")}})</option>
                                                    <option value="d-m-Y">DD-MM-YYYY ({{date("d-m-Y")}})</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="time-format-select" class="col-md-4 col-lg-4 col-form-label">Time format</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="time-format-select">
                                                    <option value="H:i">HH:MM ({{date("H:i")}})</option>
                                                    <option value="h:i A">hh:mm A ({{date("h:i A")}})</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="week-start-select" class="col-md-4 col-lg-4 col-form-label">Week start</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="week-start-select">
                                                    <option value="0">Sunday</option>
                                                    <option value="1">Monday</option>
                                                    <option value="2">Tuesday</option>
                                                    <option value="3">Wednesday</option>
                                                    <option value="4">Thursday</option>
                                                    <option value="5">Friday</option>
                                                    <option value="6">Saturday</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="entries-per-page-select" class="col-md-4 col-lg-4 col-form-label">Entries per page</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="entries-per-page-select">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="main-currency-select" class="col-md-4 col-lg-4 col-form-label">Main currency</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="main-currency-select">
                                                    <option value="ILS">ILS Israeli new shekel</option>
                                                    <option value="USD">USD United States Dollar</option>
                                                    <option value="EUR">EUR Euro</option>
                                                    <option value="GBP">GBP British pound</option>
                                                    <option value="JPY">JPY Japanese yen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="additional-currencies-select" class="col-md-4 col-lg-4 col-form-label">Additional currencies</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="additional-currencies-select" multiple>
                                                    <option value="ILS">ILS Israeli new shekel</option>
                                                    <option value="USD">USD United States Dollar</option>
                                                    <option value="EUR">EUR Euro</option>
                                                    <option value="GBP">GBP British pound</option>
                                                    <option value="JPY">JPY Japanese yen</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary float-right">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="security-header">
                                <h2 class="mb-0">
                                    <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#security-info" aria-expanded="true" aria-controls="collapseOne">
                                        Security
                                    </button>
                                </h2>
                            </div>
                            <div id="security-info" class="collapse" aria-labelledby="security-header" data-parent="#accordion-settings">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-md-4 col-lg-4 col-form-label">New password</label>
                                            <div class="col-md-8 col-lg-8">
                                                <input type="password" class="form-control" id="inputPassword">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPasswordConfirmation" class="col-md-4 col-lg-4 col-form-label">Password confirmation</label>
                                            <div class="col-md-8 col-lg-8">
                                                <input type="password" class="form-control" id="inputPasswordConfirmation">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary float-right">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="security-header">
                                <h2 class="mb-0">
                                    <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#email-notifications-info" aria-expanded="true" aria-controls="collapseOne">
                                        Email notifications
                                    </button>
                                </h2>
                            </div>
                            <div id="email-notifications-info" class="collapse" aria-labelledby="email-notifications-header" data-parent="#accordion-settings">
                                <div class="card-body">
                                    <form>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="monthly-report" checked>
                                            <label class="custom-control-label" for="monthly-report">Send monthly report</label>
                                        </div>
                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary float-right">Save</button>
                                            </div>
                                        </div>
                                    </form>
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

