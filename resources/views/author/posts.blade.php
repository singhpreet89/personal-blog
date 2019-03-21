@extends('layouts.admin')

@section('title') Author Posts @endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                Author Posts
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Auth::user()->posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td class="text-nowrap"><a href="{{ route('singlePost', $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td class="form-row align-items-center">
                                    <a href="{{ route('postEdit', $post->id) }}" class="btn btn-warning col-sm-4 mr-1">Edit</a>

                                    <form id="deletePost-{{ $post->id }}" action="{{ route('deletePost', $post->id) }}" method="POST">
                                        @csrf
                                    </form>
                                    <a href="#" class="btn btn-danger col-sm-4 ml-1" onclick="document.getElementById('deletePost-{{ $post->id }}').submit()">Remove</a>
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
