@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template text-center">
                <h1>500 Connection error.</h1>
                <div class="error-actions">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span> Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection