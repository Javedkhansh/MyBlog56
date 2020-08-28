

@extends('layouts.app')

{{-- we will include under two line instead of the @include.... --}}
@include('partials.meta_dynamic') 

{{-- dynamic show data  --}}
{{-- @section('meta_title') {{ $blog->meta_title }} @endsection
@section('meta_description') {{ $blog->meta_description }} @endsection --}}

@section('content')

    <div class="container-fluid">
        <article>
            <div class="jumbotron">
                <div class="col-md-12">
                    @if($blog->featured_image)
                    <img src="/images/featured_images/{{ $blog->featured_image ? $blog->featured_image : '' }}" alt="{{ str_limit($blog->title, 50) }}" class="img-responsive featured_image">
                    @endif
                </div> <br /> 
                <div class="col-md-10">
                    <h2>  {{ $blog->title }}</h2> 
                </div>

                {{-- Only admin and author can edit and delete the blog post --}}
                @if(Auth::user())
                    @if(Auth::user()->role_id === 1 || Auth::user()->role_id === 2 && Auth::user()->id === $blog->user_id) 
                        <div class="col-md-10 offset-1">
                            <div class="btn-group">
                                <a class="btn-margin-right btn btn-primary btn-sm" href="{{route('blogs.edit', $blog->id)}}">Edit</a>
                                <form method="post" action="{{ route('blogs.delete', $blog->id) }}">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endif

            </div>

            <div class="col-md-10">
                {{-- setting for TinyMCE Editor --}}
                {{-- <p>{{ $blog->body }}</p> --}}
                {!! $blog->body !!}

                @if($blog->user)
                    Author: <b><a href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }}</a></b> | Posted: {{ $blog->created_at->diffForHumans() }}
                @endif
                <hr>
            {{--  show the categoyr under the show blog  --}}
            {{-- <p>{{ $blog->category->name }}</p>    error: property name does not exist in this collection --}}
            {{-- <p>{{ $blog->category['name'] }}</p>   error: undefined indexed name --}}
            {{-- <p>{{ $blog->category }}</p>   it will show complete object --}}
            {{-- <p>{{ $blog->category['0']->name }}</p>   correct: i is working but we are usign through loop --}}
            {{-- shwing blogs through loop, because a blog can be relate to up to one category --}}
            <div class="btn btn-warning">
                <strong>Categories: </strong>
                @foreach ($blog->category as $category)
                    <a href="{{ route("categories.show", $category->slug) }}"><span>{{ $category->name ." " }} </span></a>
                @endforeach
            </div>
        </div>

            {{-- Start Disqus Commenting system --}}
        <aside>
            <div id="disqus_thread"></div>
            <script>
                (function() {
                    var d = document, s = d.createElement('script');
                    s.src = 'https://blog56.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
        </aside>
        {{-- End of Disqus commenting system --}}

        </article>

    </div>
@endsection