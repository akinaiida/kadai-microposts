@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <?php $user = Auth::user(); ?>
        <link href="/layouts.css" rel="stylesheet" type="text/css">
        <div class="row">
            <aside class="col-xs-4">
                {!! Form::open(['route' => 'microposts.store']) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '5']) !!}
                    </div>
                    {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
                    <div id="favorite_button">
                        {!! Form::open(['route' => ['favorite.favorite', $user->id]]) !!}
                            {!! Form::submit('Favorite', ['class' => "btn btn-success btn-block"]) !!}
                        {!! Form::close() !!}
                    </div>
                
            </aside>
            <div class="col-xs-8">
                @if (isset($microposts))
                    @include('microposts.microposts', ['microposts' => $microposts])
                @else
                    <p>Hello</p>
                @endif
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection
