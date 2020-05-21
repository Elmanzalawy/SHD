@extends('layouts.app')
@section('content')
<style>
body{
    margin-top: 56px !important;
}
</style>

<div class="container">
    <div class="jumbotron">
    @if(!Auth::guest())
        @if(Auth::user()->privilege == "admin")
            <a class="btn btn-lg btn-primary" href="{{ url('/events/create') }}">Create New Event</a>
        @endif
    @endif
    <h1 style="margin-top:2rem !important;" class="center">UPCOMING EVENTS</h1>
    @if(count($events) > 0)
        @foreach($events as $event)
            <div class="card p-3 my-2">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%;" src="../storage/app/public/event_images/{{$event->cover_image}}" alt="">
                    </div>
                    <div class="col-md-8 col-sm-8 text-center">
                        <h3><a href="events/{{$event->id}}">{{$event->title}}</a></h3>
                        <p style="background:lavender;padding:5px;border-radius:10px;">{{$event->description}}</p>
                        <p>Event date: {{$event->event_date}}</p>
                        @if($event->tickets > 0)
                            <p>tickets available: {{$event->tickets - DB::table('event_register')->where('event_id',$event->id)->value('tickets')}}</p>
                        @endif
                        <hr>
                        <small>Created on {{$event->created_at}} by {{$event->organizer}}</small>                </div>
                </div>
            </div>
        @endforeach
            {{$events->links()}}
    @else
        <p>No upcoming events.</p>
    @endif
</div>
</div>

@endsection