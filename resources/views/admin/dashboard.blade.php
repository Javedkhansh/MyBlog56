@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="jumbotron">

        @if(Auth::user() && Auth::user()->role_id === 1)
            <h1>Admin Dashboard</h1>
        @elseif(Auth::user() && Auth::user()->role_id === 2)
            <h1>Author Dashboard</h1>
        @elseif(Auth::user() && Auth::user()->role_id === 3)
            <h1>User Dashboard</h1>
        @endif
        </div>

        @if(Auth::user() && Auth::user()->role_id === 1)
            <div class="col-md-12">
                    <a class="btn btn-primary btn-margin-right" href="{{ route('blogs.create') }}">Create Blog</a>
                    <a class="btn btn-danger btn-margin-right" href="{{ route('blogs.trash') }}">Trashed Blog</a>
                    <a class="btn btn-success btn-margin-right" href="{{ route('categories.create') }}">Create Category</a>
                    <a class="btn btn-warning btn-margin-right" href="{{ route('admin.blogs') }}">Publish Blogs</a>
                    <a class="btn btn-dark btn-margin-right" href="{{ route('users.index') }}">Manage Users</a>
            </div>
        @endif

        @if(Auth::user() && Auth::user()->role_id === 2)
            <div class="col-md-12">
                    <a class="btn btn-primary btn-margin-right" href="{{ route('blogs.create') }}">Create Blog</a>
                    <a class="btn btn-success btn-margin-right" href="{{ route('categories.create') }}">Create Category</a>
            </div>
        @endif

        @if(Auth::user() && Auth::user()->role_id === 3)
            <div class="col-md-12">
                    <a class="btn btn-primary btn-margin-right" href="#">What to Do Dear???</a>
            </div>
        @endif
    </div>

@endsection