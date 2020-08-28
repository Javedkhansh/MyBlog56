@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="jumbotron">
        <div class="container-fluid">
            <h1>{{ $category->name }}</h1>
        </div>
        <div class="btn-group">
            <a class="btn btn-warning  btn-margin-right" href="{{ route('categories.edit', $category->id) }}">Edit</a>
            <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-margin-right">Delete</button>
            </form>
        </div>
    </div>
    {{-- show posts base on cotegory --}}
    <div class="container">
        <div class="col-md-12">
            @foreach ($category->blog as $blog)
                <h1><a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h1>
            @endforeach
        </div>
    </div>
    {{-- end show category based on blog --}}
</div>
@endsection