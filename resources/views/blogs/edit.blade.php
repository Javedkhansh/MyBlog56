@extends('layouts.app')

@section('content')
@include('partials.tinymce')
    
<div class="container-fluid">
    <div class="jumbotron">
        <h1>Edit Post</h1>  
    </div>
    <div class="col-md-10 offset-1">
        <form action="{{ route('blogs.update', $blog->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="from-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" value="{{$blog->title}}">
            </div>
            <div class="from-group">
                <label for="body">Body</label>
                    {{-- <textarea class="form-control" name="body">{{$blog->body}}</textarea> --}}
                    <textarea class="form-control" name="body" my-editor>{!! $blog->body !!}</textarea>
            </div><br>
            <div class="from-group">
                {{ $blog->category->count() ? 'Current Categories:     ' : '' }} &nbsp; &nbsp; &nbsp; 
                @foreach($blog->category as $category)
                    {{-- <input class="form-check-input" type="checkbox" value="{{ $category->id }}" name="category_id[]">
                    <label class="form-check-label btn-margin-right">{{ $category->name }}</label> --}}
                    <input type="checkbox" class="form-check-input" checked value="{{ $category->id }}" name="category_id[]">
                    <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
                @endforeach
            </div>

            <div class="from-group">
                {{ $filtered->count() ? 'Unused Categories:     ' : '' }} &nbsp; &nbsp; &nbsp; 
                @foreach($filtered as $category)
                    <input type="checkbox" class="form-check-input" value="{{ $category->id }}" name="category_id[]">
                    <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
                @endforeach
            </div>

            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" class="form-control">
            </div>


            <div class="from-group pt-2">
                <button type="submit" class="btn btn-primary btn-block">Update Post</button>
            </div>
        </form>
    </div>
</div>
@endsection