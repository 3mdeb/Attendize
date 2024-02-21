@extends('Public.ViewEvent.Layouts.EventPage')

@section('head')
    @include('Public.ViewEvent.Partials.GoogleTagManager')
    @if ($event->schedule_url)
        @include('Public.ViewEvent.Partials.EventScheduleHeadSection')
    @endif
@endsection

@section('content')
    @include('Public.ViewEvent.Partials.EventHeaderSection')
    @include('Public.ViewEvent.Partials.EventDescriptionSection')
    @if ($event->schedule_url)
        @include('Public.ViewEvent.Partials.EventScheduleSection')
    @endif
    @include('Public.ViewEvent.Partials.EventTicketsSection')
    @if ($event->location_address_line_1)
        @include('Public.ViewEvent.Partials.EventMapSection')
    @endif
    @include('Public.ViewEvent.Partials.EventShareSection')
    @include('Public.ViewEvent.Partials.EventFooterSection')
@stop
