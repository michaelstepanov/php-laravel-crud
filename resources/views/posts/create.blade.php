@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Create Post</h1>

    @include('layouts.errors')

    {{ Form::open(['url' => 'posts']) }}

        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::text('body', Input::old('body'), ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('userId', 'User Id') }}
            {{ Form::text('userId', Input::old('userId'), ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Create', ['class' => 'btn btn-success']) }}

        <a class="btn btn-default" href="{{ url('posts') }}">Cancel</a>

    {{ Form::close() }}

</div>

@endsection