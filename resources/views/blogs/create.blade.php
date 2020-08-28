@extends('layouts.app')

@section('content')
@include('partials.tinymce')

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Create a New Blog</h1>  
        </div>
        <div class="col-md-10 offset-1">
            <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                {{-- Display Errors --}}
                
                @include('partials.error-message')

                {{ csrf_field() }}
            <div class="from-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title">
            </div>
            <div class="from-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body"></textarea>
            </div>
            <div class="form-group form-check form-check-inline mt-3">
                <b>Select Category:</b>&nbsp;&nbsp;&nbsp; 
                @foreach($categories as $category)
                    {{-- <input class="form-check-input" type="checkbox" value="{{ $category->id }}" name="category_id[]">
                    <label class="form-check-label btn-margin-right">{{ $category->name }}</label> --}}
                    <input type="checkbox" class="form-check-input" value="{{ $category->id }}" name="category_id[]">
                    <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
                @endforeach
            </div>


            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" class="form-control">
            </div>

            <div class="form-group">
                <label for="" class="btn btn-default">
                    <span class="btn-btn-outline btn-lg btn-info">Featured Image</span>
                    <input type="file" name="featured_image" id="" class="form-control" hidden>
                </label>
            </div>


            <div class="from-group pt-2">
                <button type="submit" class="btn btn-primary btn-block">Create Post</button>
            </div>
            </form>
        </div>
    </div>
@endsection