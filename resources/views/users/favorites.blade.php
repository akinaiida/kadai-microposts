@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-4">
            @if (isset($microposts))
                @include('microposts.microposts', ['microposts' => $microposts])
            @else
                <p>Hello</p>
            @endif
        </div>
    </div>

@endsection
