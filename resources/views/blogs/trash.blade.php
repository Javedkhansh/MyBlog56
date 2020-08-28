@extends('layouts.app')

@section('content')
<div class="col-md-6 offset-3">
    <h3 class="bg-warning text-center">Trashed Blogs Data</h3>
</div>

<div class="col-md-12">
    @foreach($trashblogs as $blog)
        <a href="{{ route('blogs.show', $blog->id) }}"><h3>{{$blog->title}}</h3></a>
        <p>{{ $blog->body }}</p>
    
    {{-- Restore Blog Code --}}
    <div class="btn-group">
    <form method="get" type="submit" action="{{ route('blogs.restore', $blog->id)  }}">
        <button class="btn-margin-right btn btn-success btn-xs">Restore</button>
        {{ csrf_field() }}
    </form>

    {{-- permanent delete Blog Code --}}
    <form method="post" type="submit" action="{{ route('blogs.permanent-delete', $blog->id)  }}">
        {{ method_field('delete') }}
        <button class="btn btn-danger btn-xs">Permanent Delete</button>
        {{ csrf_field() }}
        <hr>
    </form>
</div>
    @endforeach
</div>
@endsection