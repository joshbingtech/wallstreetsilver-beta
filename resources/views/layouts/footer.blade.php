<div class="footer py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-1 my-2">
                <div class="outer">
                    <div class="middle">
                        <div>
                            <a class="button-secondary font-big" data-bs-toggle="tooltip" title="<h4 class='text-center'> Contact Us </h4>
                                @foreach ($contacts as $contact)
                                    <div class='contact-list text-center'>
                                        <a class='button-secondary font-big' href='{{ $contact['contact_link'] }}' target='_blank'>
                                            {{ $contact['name'] }}
                                        </a>
                                    </div>
                                @endforeach" data-bs-html="true"> Contact Us </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-2">
                <div class="outer">
                    <div class="middle">
                        <div>
                            <h4 class="text-center font-weight-light"> Wall Street Silver. We just like Silver. </h4>
                            <h6 class="text-center font-weight-light"> Join Our <br/> Community, Ape! </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 my-2">
            <div class="jcarousel" style="width:100%;">
                <ul>
                    @foreach ($supporters_for_carousel as $supporter)
                        <li><a href="{{ $supporter['url'] }}" target="_blank"><img src="{{ asset($supporter['src']) }}" /></a></li>
                    @endforeach
                </ul>
            </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('plugins/jcarousel.min.js') }}"></script>
    <script src="{{ asset('js/footer.js') }}"></script>
@endpush
