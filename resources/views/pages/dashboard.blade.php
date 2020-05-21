@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        @if(!Auth::guest())
        <h3>Welcome, {{Auth::user()->name}}</h3>

            {{-- ADMINISTRATOR PRIVILEGES --}}
        @if(Auth::user()->privilege==="admin")
            <hr>
            <h3>Administrator Control</h3>
            <a href="#" data-toggle="modal" data-target="#create-user-modal" class="btn btn-primary">Create New User</a>
            <a href="view-users" class="btn btn-secondary">View Users</a>
            @if(Auth::user()->privilege === 'admin')
            

            <!--MODAL-->
       <div class="modal fade" id="create-user-modal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                        {{ Form::open(['action' => 'UsersController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
                        <div class="form-group">
                            {{Form::label('name','Username')}}
                            {{Form::text('name','',['class'=>'form-control','placeholder'=>'username'])}}
                        </div>
                
                        <div class="form-group">
                                {{Form::label('email','Email')}}
                                {{Form::email('email','',['class'=>'form-control','placeholder'=>'example@gmail.com'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('password','Password')}}
                            <input name="password" type="password" class="form-control" placeholder="password">
                        </div>

                        <div class="form-group">
                            {{Form::label('privilege','Privilege')}}
                            <select name="privilege" class="form-control" id="privilege">
                                <option value="admin">Adminstrator</option>
                                <option value="moderator">Moderator</option>
                                <option value="else">Else</option>
                            </select>
                        </div>
                
                        {{Form::submit('Create User',['class'=>'btn btn-success'])}}
                    {{ Form::close() }}
                   </div>
                </div>
              </div>
           </div>
       </div>
            @endif
        @endif
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
@endsection
