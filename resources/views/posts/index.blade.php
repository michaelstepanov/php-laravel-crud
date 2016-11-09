@extends('layouts.app')

@section('content')

<div class="container">

    <h1>All the Posts</h1>

    @include('layouts.message')

    <a href="{{url('/posts/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create</a>

    <br>
    <br>

    @if ($posts->count() > 0)
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($posts as $key => $post)
                    <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['body'] }}</td>

                        <td><a href="{{url('posts',$post['id'])}}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Show</a></td>
                        <td><a href="{{route('posts.edit',$post['id'])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route'=>['posts.destroy', $post['id']]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <?php echo $posts->render(); ?>
    @else
        <h1>No posts yet.</h1>
    @endif
</div>

@endsection