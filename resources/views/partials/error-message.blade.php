@if(count($errors))
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li class="list-style-type:none;">{{$error}}</li>
        @endforeach
    </div>
@endif