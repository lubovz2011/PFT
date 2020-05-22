<div class="card">
    <div class="card-header" id="security-header">
        <h2 class="mb-0">
            <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#email-notifications-info" aria-expanded="true" aria-controls="collapseOne">
                Email notifications
            </button>
        </h2>
    </div>
    <div id="email-notifications-info"
         class="collapse"
         aria-labelledby="email-notifications-header"
         data-parent="#accordion-settings">
        <div class="card-body">
            <form method="POST" action="{{route("settings:email-notifications")}}">
            @csrf
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="monthly-report" name="monthly_report" @if($monthlyReport) checked @endif>
                <label class="custom-control-label" for="monthly-report">Send monthly report</label>
            </div>
            <div class="row mt-4">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-secondary mr-2" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
