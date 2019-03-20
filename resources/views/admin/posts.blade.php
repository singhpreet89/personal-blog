@extends('layouts.admin')

@section('title') Admin Posts @endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                Admin Posts
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
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td class="text-nowrap"><a href="{{ route('singlePost', $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td class="form-row align-items-center">
                                    <a href="{{ route('adminPostEdit', $post->id) }}" class="btn btn-warning col-sm-3 mr-1">Edit</a>

                                    <form id="adminDeletePost-{{ $post->id }}" action="{{ route('adminDeletePost', $post->id) }}" method="POST">
                                        @csrf
                                    </form>
                                    <a href="#" class="btn btn-danger col-sm-3 ml-1" onclick="document.getElementById('adminDeletePost-{{ $post->id }}').submit()">Remove</a>
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

