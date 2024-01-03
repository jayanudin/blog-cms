@extends('backend.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Article Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('admin.article.update', $article->id) }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal form-label-left">
                    @csrf
                    @method('PUT')
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Article Title</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control {{ $errors->has('title') ? 'parsley-error' : '' }}"
                                name="title" placeholder="Title" value="{{ $article->title }}">
                            @if ($errors->has('title'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('title') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Article Thumbnail</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="file"
                                class="form-control {{ $errors->has('thumbnail') ? 'parsley-error' : '' }}"
                                onchange="loadFile(event)" name="thumbnail" placeholder="Thumbnail">
                            <img id="thumbnailShow" src="{{ asset('images/' . $article->thumbnail) }}" height="100"
                                width="100" alt="">
                            @if ($errors->has('thumbnail'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('thumbnail') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Article Slug</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control {{ $errors->has('slug') ? 'parsley-error' : '' }}"
                                name="slug" placeholder="Slug" value="{{ $article->slug }}">
                            @if ($errors->has('slug'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('slug') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Content</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="x_content">
                                <textarea id="editor2" name="content" class="{{ $errors->has('content') ? 'parsley-error' : '' }}">{{ $article->content }}</textarea>
                            </div>
                            @if ($errors->has('content'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('content') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 20px">
                        <label class="control-label col-md-3 col-sm-3">Status</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-md-2">
                                    <span>Publish:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="flat" name="status" id="statusPublish" value="1"
                                        {{ $article->status == 1 ? 'checked' : '' }} required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <span>Unpublish:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="flat" name="status" id="statusUnpublish" value="0"
                                        {{ $article->status == 0 ? 'checked' : '' }} />
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('status') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 20px;">
                        <label class="control-label col-md-3 col-sm-3">Haighlight</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-md-2">
                                    <span>Active:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="flat" name="highlight" id="statusPublish" value="1"
                                        {{ $article->highlight == 1 ? 'checked' : '' }} checked="" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <span>Inactive:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="flat" name="highlight" id="statusUnpublish"
                                        value="0" {{ $article->highlight == 0 ? 'checked' : '' }} />
                                </div>
                            </div>
                            @if ($errors->has('highlight'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('highlight') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Article Category</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-md-3 col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="category_id[]" value="{{ $category->id }}"
                                                    {{ $category->checked == 'checked' ? 'checked' : '' }}>
                                                {{ $category->category_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Article Tags</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                @foreach ($tags as $tag)
                                    <div class="col-md-3 col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}"
                                                    {{ $tag->checked == 'checked' ? 'checked' : '' }}>
                                                {{ $tag->tag_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@yield('scripts')
<script>
    var loadFile = function(event) {
        var output = document.getElementById('thumbnailShow');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
