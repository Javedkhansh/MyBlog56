@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Create Category</h1>  
        </div>
        <div class="col-md-10 offset-1">
            <form action="{{ route('categories.store') }}" method="post">
                {{ csrf_field() }}
                <div class="from-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
            <div class="from-group pt-2">
                <button type="submit" class="btn btn-primary btn-block">Create Category</button>
            </div>
            </form>
        </div>
    </div>
@endsection