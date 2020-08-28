
{{-- it will not working for dynamic title and description , if we want to work, we have to directly include it in the show.blade.php view file --}}

@section('meta_title') {{ $blog->meta_title }} @endsection

@section('meta_description') {{ $blog->meta_description }} @endsection
