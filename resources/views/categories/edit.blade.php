@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Edit Category</h1>  
        </div>
        <div class="col-md-10 offset-1">
            <form action="{{ route('categories.update', $category->id) }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
            <div class="from-group">
                <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" value="{{ $category->name }}">
            </div>
            <div class="from-group pt-2">
                <button type="submit" class="btn btn-primary btn-block">Update Category</button>
            </div>
            </form>
        </div>
    </div>
@endsection