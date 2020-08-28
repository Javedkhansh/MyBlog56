@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>{{ $user->name }}'s recent blogs</h3>
        <p>Role:{{$user->role->name }}</p>
        <hr>
        @foreach ($user->blogs as $blog)
            <h4><a href="{{route('users.show', $blog->user->name)}}">{{ $blog->title }}</a></h4>
        @endforeach
    </div>

@endsection