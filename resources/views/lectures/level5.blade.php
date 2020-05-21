@extends('layouts.app')
@section('content')

<div class="jumbotron">
  <div class="container">
      <h1 class="center">Level {{$level}} Lecture Archive</h1>
      <div>
        @if(!Auth::guest())
          @if(Auth::user()->privilege == "admin" || Auth::user()->privilege == "moderator")
        <a class="btn btn-primary btn-sm contact-designer mb-1"  href="#" data-toggle="modal" data-target="#upload-lecture-modal"><span class="fa fa-upload" style="padding-right:3px;font-size: 17px;"></span> Upload Lecture / Section</a>
          @endif
        @endif
      </div>
      <div>
          <button class="btn btn-primary btn-sm mb-1 trigger-all">Show all</button>
          <button class="btn btn-secondary btn-sm mb-1 trigger-civil">Show Civil Only</button>
          <button class="btn btn-secondary btn-sm mb-1 trigger-communication">Show Communication Only</button>
          <button class="btn btn-secondary btn-sm mb-1 trigger-chemical">Show Chemical Only</button>
        </div>
      @if(!Auth::guest())
      <!--MODAL-->
       <div class="modal fade" id="upload-lecture-modal" tabindex="1" role="dialog" aria-labelledby="lecturepleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="LectureModalLabel">Upload lecture</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
                {{ Form::open(['action' => ['LecturesController@uploadLecture', 5], 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
                <div class="form-group">
                    {{-- SELECT DEPARTMENT --}}
                    {{Form::label('title','Select Department')}}
                    <select class="form-control" id="select-department" name="department">
                    @foreach ($departments as $department)
                        <option value="{{$department}}">{{$department}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    {{-- SELECT SUBJECT --}}
                    {{Form::label('title','Select Subject')}}
                    <select class="form-control" id="select-subject" name="subject">
                        <option value=""></option>
                    @foreach ($subjects as $department => $subs)
                        @foreach ($subs as $sub)
                            <option class="{{$department}}" value="{{$sub}}">{{$sub}}</option>
                        @endforeach
                    @endforeach
                  </select>
                </div>
        
                <div class="form-group">
                    <label for="lecture-type" class="col-form-label">Choose Type:</label>
                    <select class="form-control" id="select-type" name="type">
                      <option value=""></option>
                     <option value="Lecture">Lecture</option>
                     <option value="Section">Section</option>
                     <option value="Other">Other</option>
                   </select>
                </div>
                        
                <div class="form-group">
                    <label for="lecture-image" class="col-form-label">Add files (Images / PDF / PowerPoint)</label>
                    <input type="file" class="form-control" id="lecture-file" name="lectures[]" value="Upload images, PDF, or PowerPoint" multiple>
                </div>
                {{-- SPOOFING METHOD --}}
                {{Form::hidden('_method','GET')}}
                {{Form::submit('Upload',['class'=>'btn btn-primary'])}}
            {{ Form::close() }}
               
             </div>
           </div>
        </div>
    </div>
    @endif
    <!--ACCORDION-->
  <div class="accordion" id="accordion-example">
      @foreach ($subjects as $department => $subs)
      @foreach ($subs as $subject)
      @include('includes.lecture_card')
      @endforeach
    @endforeach
  </div>
  </div>
</div>
@endsection