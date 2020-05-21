@extends('layouts.app')

@section('content')
<style>
        body{
            margin-top: 56px !important;
        }
        </style>
<div class="container">
<div class="jumbotron">
    <h2>List of Users</h2>
    <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Privilege</th>
                <th></th>
            </tr>
    @foreach($users as $user)
    <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->privilege}}</td>
                    {{-- <td><a class='btn btn-primary' href="users/{{$user->id}}/edit">Edit</a></td> --}}
                    <td>
                            {!!Form::open(['action'=>['UsersController@destroy',$user->id], 'method'=>'POST','class'=>"float-right"])!!}

                            {{Form::hidden('_method',"DELETE")}}
                            {{Form::submit("Delete User",['class'=>'btn btn-danger'])}}
                    
                            {!!Form::close()!!}

                    </td>
                </tr>
    @endforeach
    </table>
    <a class="btn btn-info" href="export-users-pdf">Export List as PDF</a>
    <hr>
    <a href="home" class="btn btn-secondary">&larr; Back to Dashboard</a>

</div>
</div>
@endsection
