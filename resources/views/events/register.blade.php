@extends('layouts.app')
@section('content')
<style>
body{
    margin-top: 56px !important;
}
</style>
<div class="container">
    <div class="jumbotron bg-none">
        <h1 class="center">Register event "{{$event->title}}"</h1>
            {{ Form::open(['action' => ['EventsController@uploadRegister', $event->id], 'method'=>'POST']) }}

            <div class="form-group">
                {{Form::label('title','Number of tickets')}}
                {{Form::number('tickets','1',['class'=>'form-control'])}}
            </div>
    
            <div class="form-group">
                {{Form::label('notes','notes (optional)')}}
                {{Form::textarea('notes','',['class'=>'form-control','placeholder'=>'leave notes here...'])}}
            </div>
    
            {{-- SPOOFING METHOD --}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Register',['class'=>'btn btn-primary'])}}
        {{ Form::close() }}
    </div>
</div>
@endsection