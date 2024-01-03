@extends('backend.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Article Lists</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
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
            <a href="/admin/article/create" href class="btn btn-primary">Create Article</a>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Article Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td scope="row">{{ ++$i }}</td>
                                <td>{{ $article->title }}</td>
                                <td style="position: relative; text-align: left;">
                                    <span class="badge {{ $article->status == 1 ? 'badge-success' : 'badge-secondary' }}" style="position: relative;"> {{ $article->status == 1 ? 'Publish' : 'Unpublish' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.article.show', $article->id) }}"" type="button"
                                        class="btn btn-info">Detail</a>
                                    <a href="{{ route('admin.article.destroy', $article->id) }}"
                                        onclick="return confirm('Do you want to remove data?');" type="button"
                                        class="btn btn-danger">Delete</a>
                                    <a href="{{ route('admin.article.edit', $article->id) }}" type="button"
                                        class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="block-pagination">
                    {{ $articles->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .badge {
        position: absolute;
        right: 10px;
        top: 8px;
        z-index: 991;
    }

    .thumbnail.thumbnail--custom {
        height: 320px;
        border: 1px solid #dddddd;
        border-radius: 4px;
    }

    img.img-banner {
        width: 100%;
        display: block;
        height: 100%;
        object-fit: cover;
    }

    .caption.caption--custom {
        padding: 9px 15px;
        height: 100%;
    }

    .caption .btn-wrap {
        padding: 0 10px;
        position: absolute;
        bottom: 15px;
        right: 5px;
    }

    .block-pagination {
        margin-top: 20px;
        text-align: center;
        display: block;
    }
</style>
