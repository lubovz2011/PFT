@extends("layout")
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-10 col-lg-8">
            <div class="card shadow-card border-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <div class="media">
                        <span class="round-user-icon-container border border-success rounded-circle text-success content-box mr-3">
                            <i class="fa fa-user-circle"></i>
                        </span>
                        <div class="media-body">
                            <h5 class="uname-header">{{$userName}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-settings">
                        @include('settings.personal-info-section')
                        @include('settings.interface-section')
                        @include('settings.security-section')
                        @include('settings.email-notifications-section')
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

