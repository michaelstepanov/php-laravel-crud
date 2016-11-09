@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Post ID: {{ $post['id'] }}</h1>

    @include('layouts.message')

    @include('layouts.errors')

    {{ Form::model($post, ['route' => ['posts.update', $post['id']], 'method' => 'PUT']) }}

        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::text('body', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('userId', 'User Id') }}
            {{ Form::text('userId', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Edit', ['class' => 'btn btn-warning']) }}

        <a class="btn btn-default" href="{{ url('posts') }}">Cancel</a>

    {{ Form::close() }}

</div>
@endsection