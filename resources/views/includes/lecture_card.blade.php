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
  
    <div id="collapse-{{$subjectTrimmed}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-example">
      <div class="card-body" style="background:#333 !important;">
        @foreach($LectureArchive as $lecture)
          @if($lecture->subject==$subject)
              <h5><a target="_blank" href="../../storage/app/public/lecture_archive/{{$lecture->filename}}">{{$lecture->type}} @if($lecture->type!='Other') {{$lecture->fileNumber}} @endif</a>
            
          {{-- if admin, display 'delete event' option --}}
          @if(!Auth::guest())
            @if(Auth::user()->privilege == "admin")
                {{-- <a class="btn btn-sm btn-danger pull-right" href="{{ url('/lectures/delete') }}">Delete lecture</a> --}}
            {{-- DELETE EVENT --}}
              {!!Form::open(['action'=>['LecturesController@destroy', $lecture->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
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