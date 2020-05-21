@extends('layouts.app')
@section('content')
<style>
body{
    margin-top: 56px !important;
}
</style>
<div class="container">
    <div class="jumbotron">
    {{ Form::open(['action' => ['EventsController@update', $event->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title', $event->title,['class'=>'form-control','placeholder'=>'Title'])}}
        </div>


        <div class="form-group">
                {{Form::label('title','event_date')}}
                {{Form::date('event_date',$event->event_date,['class'=>'form-control','placeholder'=>'event_date'])}}
        </div>


        <div class="form-group">
            {{Form::label('description','Description')}}
            {{Form::textarea('description',$event->description,['class'=>'form-control','placeholder'=>'Description Text'])}}
        </div>

        <div class="form-group">
                {{Form::label('title','tickets available (leave empty if no max number is available)')}}
                {{Form::number('tickets',$event->tickets,['class'=>'form-control','placeholder'=>''])}}
            </div>

        <div class="form-group">
                {{Form::label('Add image: ','Add image:')}}
                {{Form::file('cover_image')}}
        </div>

        {{-- SPOOFING METHOD --}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-success'])}}
    {{ Form::close() }}
</div>
</div>
@endsection
