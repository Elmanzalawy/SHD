@if(isset($department))
<div class="card select-subject card-{{$department}}">
  @else
  <div class="card card-general">
  @endif
    <div class="card-header" id="">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-{{$subjectTrimmed = str_replace(" ","_",$subject)}}" aria-expanded="false" aria-controls="collapseOne">
          {{$subject}}  
        </button>
      </h2>
    </div>
  
    <div id="collapse-{{$subjectTrimmed}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body" style="background:#333 !important;">
        @foreach($ExamArchive as $exam)
          @if($exam->subject==$subject)
          <h5><a target="_blank" href="../../storage/app/public/exam_archive/{{$exam->filename}}">{{$exam->type}} {{$exam->year}}</a>
          {{-- if admin, display 'delete event' option --}}
          @if(!Auth::guest())
            @if(Auth::user()->privilege == "admin")
                {{-- <a class="btn btn-sm btn-danger pull-right" href="{{ url('/exams/delete') }}">Delete Exam</a> --}}
            {{-- DELETE EVENT --}}
              {!!Form::open(['action'=>['ExamsController@destroy', $exam->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                  {{-- SPOOFING METHOD --}}
                  {{Form::hidden('_method','DELETE')}}
                  {{Form::submit('Delete',['class'=>'btn btn-sm pull-right btn-danger'])}}
              {!!Form::close()!!}
            @endif
          @endif
          </h5>
          @endif
        @endforeach
      </div>
    </div>
  </div>