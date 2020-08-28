@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="jumbotron">
            <h1><u>Category</u></h1>
        </div>
        @foreach($categories as $category)
            <h3><a href="{{ route('categories.show', $category->slug) }}">{{$category->name}}</h3></a>
        @endforeach
    </div>
@endsection