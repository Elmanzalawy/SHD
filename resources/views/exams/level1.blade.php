@extends('layouts.app')
@section('content')

<div class="jumbotron">
  <div class="container">
      <h1 class="center">Level {{$level}} Exam Archive</h1>
      <div>
        <a class="btn btn-primary btn-sm mb-1"  href="https://drive.google.com/drive/folders/0B_Zw4Ci2lD-Cfjc0dnhLRXJsbld2dUphRGlybWVITFRRUUt6UV9ldE5kOTZNV2kwMkt0Wnc?tid=0B_Zw4Ci2lD-Cfm1UYXBnYUFRcEVLUkJKZ243SThaMUhkVzIxTVlFR0pyYm9CRm1hYU5DOEk" target="_blank"><span class="fa fa-google " style="font-size:17px;"> </span> View on Google Drive</a>
                  
        @if(!Auth::guest())
         @if(Auth::user()->privilege == "admin" || Auth::user()->privilege == "moderator")
          <a class="btn btn-primary btn-sm contact-designer mb-1"  href="#" data-toggle="modal" data-target="#upload-exam-modal"><span class="fa fa-upload" style="padding-right:3px;font-size: 17px;"></span> Upload exams</a>
         @endif
        @endif
      </div>
    
      @if(!Auth::guest())
      <!--MODAL-->
       <div class="modal fade" id="upload-exam-modal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Upload Exam</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
                {{ Form::open(['action' => ['ExamsController@uploadExam', 1], 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
                <div class="form-group">
                    {{-- SELECT SUBJECT --}}
                    {{Form::label('title','Select Subject')}}
                    <select class="form-control" id="select-subject" name="subject">
                     <!-- level 1 subjects-->
                    @foreach ($subjects as $subject)
                    <option class="level-1 general" value="{{$subject}}">{{$subject}}</option>
                    @endforeach
                  </select>
                </div>
        
                <div class="form-group">
                    <label for="exam-type" class="col-form-label">Choose Exam Type:</label>
                    <select class="form-control" id="select-type" name="type">
                      <option value=""></option>
                     <option value="Midterm">Midterm</option>
                     <option value="Final">Final</option>
                   </select>
                </div>
                
                <div class="form-group">
                  <label for="exam-subject" class="col-form-label">Choose Year:</label>
                   <select class="form-control" id="select-year" name="year">
                    <option value=""></option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                  </select>
                </div>
        
                <div class="form-group">
                    <label for="exam-image" class="col-form-label">Exam images or PDF:</label>
                    <input type="file" class="form-control" id="exam-file" name="exams[]" value="Upload Images or PDF" multiple>
                </div>
                {{-- SPOOFING METHOD --}}
                {{Form::hidden('_method','GET')}}
                {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
            {{ Form::close() }}
               
             </div>
           </div>
        </div>
    </div>
    @endif
    <!--ACCORDION-->
  <div class="accordion" id="accordionExample">
  @foreach($subjects as $subject)
    @include('includes.exam_card')
  @endforeach
  </div>
  </div>
</div>
@endsection