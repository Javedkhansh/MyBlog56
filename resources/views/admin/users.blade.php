@extends('layouts.app')

@section('content')

@include('partials.meta_static')

<div class="container-fluid">
    <div class="jumbotron">
        <h2>Manage Users</h2>
    </div>

    <div class="col-md-12">
        <div class="row">
            @foreach($users as $user)
            <div class="col-md-4">
                <form action="{{ route('users.update', $user->id)}}" method="POST">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input class="form-control" value="{{ $user->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <select name="role_id" class="form-control">
                            <option selected>{{ $user->role->name }}</option>
                            <option value="2">Author</option>
                            <option value="3">Subscriber</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" value="{{$user->email}}" disabled>
                    </div>
                    <div class="form-group">
                        <input class="form-control" value="{{$user->created_at->diffForHumans()}}" disabled>
                    </div>
                    <button class="btn btn-primary btn-xs pull-right col-md-12" >Update</button>
                </form>

                <form action="{{route('users.destroy', $user)}}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-xs pull-right col-md-12 mt-1" >Delete</button>
                </form>
            </div>
            
            @endforeach
            
        </div>
        <br>
    </div>

    
</div>
@endsection 