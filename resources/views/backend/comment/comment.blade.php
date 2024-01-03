@extends('backend.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Article Comment List</h2>
                <div class="clearfix"></div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    {{ $message }}
                </div>
            @endif
            <a href="/admin/comment/create" href class="btn btn-primary">Create Comment</a>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Author Email</th>
                            <th>Author Full Name</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Article Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->full_name }}</td>
                                <td>{{ $comment->content }}</td>
                                <td>{{ $comment->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $comment->article->title }}</td>
                                <td>
                                    <a href="{{ route('admin.comment.destroy', $comment->id) }}"
                                        onclick="return confirm('Do you want to remove data?');" type="button"
                                        class="btn btn-danger">Delete</a>
                                    <a href="{{ route('admin.comment.edit', $comment->id) }}" type="button"
                                        class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
