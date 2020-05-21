@extends('layouts.app')
@section('content')
<style>
body{
    margin-top: 56px !important;
}
</style>
<div class="container">
    <div class="jumbotron">
    {{-- <a class="btn btn-success" href="{{url('events')}}">Go back</a> --}}
    <h1 class="center">{{$event->title}}</h1>
    <img class="py-2" style="width:100%;" src="../../storage/app/public/event_images/{{$event->cover_image}}" alt="">
            <div class="center">
                <br>
                <p>
                    {{$event->description}}
                </p>
            
            <hr>
            @if($event->tickets > 0)
                <p>tickets available: {{$event->tickets - DB::table('event_register')->where('event_id',$event->id)->value('tickets')}}</p>
                <hr>
            @endif
            <p>Date: {{$event->event_date}}</p>
            <hr>
            <small>Created on {{$event->created_at}} by {{$event->organizer}}</small>
        </div>
        <hr>
    
    {{-- REGISTER EVENT FUNCTIONS --}}
    @if(!Auth::guest())
        {{-- REGISTER EVENT --}}
        {{-- check if there's a record in event_register table with the same user id as the current user --}}
        @if(DB::table('event_register')->where('user_id', Auth::user()->id)->where('event_id',$event->id)->doesntExist())
            <a href="{{$event->id}}/register" class="btn btn-success">Register Event</a>
            @else
            <span>You have registered <b class="secondary-color">{{DB::table('event_register')->where('user_id', Auth::user()->id)->where('event_id',$event->id)->value('tickets')}}</b> ticket(s)</span>

            {{-- CANCEL REGISTERATION --}}
            {{-- if there are more than 48h before the event, display cancel registeration option --}}
            @if(DB::table('events')->where($event->id,50))
            {!!Form::open(['action'=>['EventsController@cancelRegisteration', $event->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
            {{-- SPOOFING METHOD --}}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Cancel Registeration',['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
            @endif
        @endif
    @endif

    {{-- EDIT & DELETE FUNCTIONS --}}
    @if(!Auth::guest())
        {{-- ADMINISTRATOR PRIVILEGES --}}
        @if(Auth::user()->id == $event->organizer_id || Auth::user()->privilege == 'admin')
        <hr>
            {{-- EDIT EVENT --}}
            <a href="{{$event->id}}/edit" class="btn btn-warning">Edit Event</a>

            {{-- DELETE EVENT --}}
            {!!Form::open(['action'=>['EventsController@destroy', $event->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                {{-- SPOOFING METHOD --}}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
            <a href="{{$event->id}}/viewRegister" class="btn btn-primary">View Registeration</a>
        @endif
    @endif
</div>
</div>
@endsection