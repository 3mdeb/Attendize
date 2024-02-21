<section id="schedule" class="container p0">
    <div class="row">
        <h1 class='section_head'>
            @lang("Public_ViewEvent.schedule")
        </h1>
    </div>

    <pretalx-schedule event-url="{{$event->schedule_url}}" locale="en" format="grid" style="--pretalx-clr-primary: #63A0FF"></pretalx-schedule>
    <noscript>
    <div class="pretalx-widget">
            <div class="pretalx-widget-info-message">
                JavaScript is disabled in your browser. To access our schedule without JavaScript,
                please <a target="_blank" href="{{$event->schedule_url}}schedule/">click here</a>.
            </div>
        </div>
    </noscript>
</section>
