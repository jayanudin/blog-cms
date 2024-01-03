@extends('backend.layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Article Tag List</h2>
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
            <a href="/admin/tag/create" href class="btn btn-primary">Create Tag</a>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tag Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ $tag->tag_name }}</td>
                                <td>{{ $tag->status == 1 ? 'Published' : 'Unpublish' }}</td>
                                <td>
                                    <a href="{{ route('admin.tag.destroy', $tag->id) }}"
                                        onclick="return confirm('Do you want to remove data?');" type="button"
                                        class="btn btn-danger">Delete</a>
                                    <a href="{{ route('admin.tag.edit', $tag->id) }}" type="button"
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
