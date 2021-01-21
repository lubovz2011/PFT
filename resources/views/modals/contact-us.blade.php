<div class="modal fade" id="contact-us-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (session('send-status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('send-status') }}
                    </div>
                @endif
                @if (session('send-status-error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('send-status-error') }}
                    </div>
                @endif
                <form class="px-4 py-2" method="POST" action="{{route('contact-us')}}">
                    @csrf
                    <div class="text-center mb-4">
                        If you have any questions, comments or requests,<br>feel free to contact us
                    </div>
                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control @error('contact-email') is-invalid @enderror"
                            placeholder="email@example.com"
                            name="contact-email"
                            value="{{old('contact-email', auth()->user()->login)}}"
                            autocomplete="off">
                        @include('utils.error-invalid-feedback', ['errorField' => 'contact-email'])
                    </div>
                    <div class="form-group">
                        <input type="text"
                               class="form-control @error('contact-subject') is-invalid @enderror"
                               placeholder="Subject"
                               name="contact-subject"
                               value="{{old('contact-subject')}}"
                               autocomplete="off">
                        @include('utils.error-invalid-feedback', ['errorField' => 'contact-subject'])
                    </div>
                    <div class="form-group">
                        <textarea type="text"
                                  class="form-control @error('contact-message') is-invalid @enderror"
                                  rows="5"
                                  placeholder="Enter your message"
                                  name="contact-message">{{old('contact-message')}}</textarea>
                        @include('utils.error-invalid-feedback', ['errorField' => 'contact-message'])
                    </div>
                    <div class="col d-flex justify-content-center mt-2">
                        <button class="btn btn-secondary mr-2 px-3" type="reset" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="btn btn-primary px-4" type="submit">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
