@extends('backend.layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Article Category List</h2>
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
            <a href="/admin/category/create" href class="btn btn-primary">Create Category</a>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ $category->category_name }}</td>
                                @if ($category->status == 1)
                                    <td><span class="badge badge-success">Publish</span></td>
                                @else
                                    <td><span class="badge badge-secondary">Unpublish</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('admin.category.destroy', $category->id) }}"
                                        onclick="return confirm('Do you want to remove data?');" type="button"
                                        class="btn btn-danger">Delete</a>
                                    <a href="{{ route('admin.category.edit', $category->id) }}" type="button" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
