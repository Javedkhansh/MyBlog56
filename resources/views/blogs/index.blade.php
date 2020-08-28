@extends('layouts.app')
@include('partials.meta_static')

@section('content')


    {{-- messages show --}}
    @if(Session::has('blog_created_message'))
        <div class="col-md-10 offset-1 alert alert-success">
            {{ Session::get('blog_created_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    @endif
        {{-- end of messages show --}}


<div class="container">
    @foreach($blogs as $blog)
        <div class="col-md-8 offset-2">
            <a href="{{ route('blogs.show', [$blog->slug]) }}"><h3>{{$blog->title}}</h3></a>
            {!! str_limit($blog->body, 300) !!}
            <br>
            @if($blog->user)
                Author: <b><a href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }}</a></b> | Posted: {{ $blog->created_at->diffForHumans() }}
            @endif
            <br><hr><br>
        </div>
    @endforeach
</div>
@endsection