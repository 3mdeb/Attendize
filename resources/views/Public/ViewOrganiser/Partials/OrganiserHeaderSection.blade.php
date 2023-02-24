<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <div>
                    <img class="center" src="{{URL::to($organiser->full_logo_path)}}" />
                </div>
            </div>
            @if($organiser->about)
            <div class="description pa10">
                {!! md_to_html($organiser->about) !!}
            </div>
            @endif
        </div>
    </div>
</section>
