@extends('layouts.app')

@section('content')

@include('partials.meta_static')

<div class="container-fluid">
    <div class="jumbotron">
        <h2>Manage Blogs</h2>
    </div>
    <div class="row">

        <div class="col-md-6">
            <h3>Published Blogs</h3>
            <hr>
            @foreach($publishedBlogs as $blog)
                <a href="{{ route('blogs.show', $blog->id) }}"><h3>{{$blog->title}}</h3></a>
                {{-- i am hiding blog body in publish and draft mode --}}
                {{-- <p>{{ str_limit($blog->body, 100) }}</p> --}}

                {{-- embed blog publish button --}}
                <form action="{{ route('blogs.update', $blog->id) }}" method="post">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <input type="checkbox" name="status" value="0" checked style="display:none">
                    <button type="submit" class="btn btn-success btn-xs">Save as Draft</button>
                </form>
                
                <hr>
            @endforeach
        </div>

        <div class="col-md-6">
            <h3>Draft Blogs</h3>
            <hr>
            @foreach($draftBlogs as $blog)
                <a href="{{ route('blogs.show', $blog->id) }}"><h3>{{$blog->title}}</h3></a>
                {{-- i am hiding blog body in publish and draft mode --}}
                {{-- <p>{{ str_limit($blog->body, 100) }}</p> --}}

                {{-- embed blog publish button --}}
                <form action="{{ route('blogs.update', $blog->id) }}" method="post">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <input type="checkbox" name="status" value="1" checked style="display:none">
                    <button type="submit" class="btn btn-warning btn-xs">Publish</button>
                </form>
                
                <hr>
            @endforeach
        </div>

    </div>
    
</div>
@endsection