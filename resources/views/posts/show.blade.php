@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Post ID: {{ $post['id'] }}</h1>
    
    <h4>User ID: {{ $post['userId'] }}</h4>

    @include('layouts.message')

    <div class="panel panel-primary">
        <div class="panel-heading">{{ $post['title'] }}</div>
        <div class="panel-body">{{ $post['body'] }}</div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-warning">Edit</a>

                <a class="btn btn-default" href="{{ url('posts') }}">Back</a>
            </div>
            <div class="col-md-6 text-right">
                {!! Form::open(['method' => 'DELETE', 'route'=>['posts.destroy', $post['id']]]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>
@endsection