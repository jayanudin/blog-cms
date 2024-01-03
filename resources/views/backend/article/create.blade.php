@extends('backend.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Create Article Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal form-label-left">
                    @csrf
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 "><strong>Article Title</strong></label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control {{ $errors->has('title') ? 'parsley-error' : '' }}"
                                name="title" placeholder="Title">
                            @if ($errors->has('title'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('title') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 "><strong>Article Thumbnail</strong></label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="file"
                                class="form-control {{ $errors->has('thumbnail') ? 'parsley-error' : '' }}" onchange="loadFile(event)" name="thumbnail"
                                placeholder="Thumbnail">
                            <img id="thumbnailShowInput" src="" height="100" width="100" alt="">
                            @if ($errors->has('thumbnail'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('thumbnail') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 "><strong>Article Slug</strong></label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control {{ $errors->has('slug') ? 'parsley-error' : '' }}"
                                name="slug" placeholder="Slug">
                            @if ($errors->has('slug'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('slug') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3"><strong>Content</strong></label>
                        <div class="col-md-9 col-sm-9">
                            <div class="x_content">
                                <textarea id="editor2" name="content" class="{{ $errors->has('content') ? 'parsley-error' : '' }}"></textarea>
                            </div>
                            @if ($errors->has('content'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('content') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 20px">
                        <label class="control-label col-md-3 col-sm-3"><strong>Status</strong></label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-md-2">
                                    <span>Publish:</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" class="flat" name="status" id="statusUnpublish" checked="" value="1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <span>Unpublish:</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" class="flat" name="status" id="statusUnpublish" value="0" />
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('status') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 20px">
                        <label class="control-label col-md-3 col-sm-3"><strong>Haighlight</strong></label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-md-2">
                                    <span>Active:</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" class="flat" name="highlight" id="statusPublish" value="1"
                                    checked="" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <span>Inactive:</span>
                                </div>
                                <div class="col-md-3">
                                    <span><input type="radio" class="flat" name="highlight" id="statusUnpublish" value="0" /></span>
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
                        <label class="control-label col-md-3 col-sm-3"><strong>Article Category</strong></label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-md-3 col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="category_id[]" value="{{ $category->id }}">
                                                {{ $category->category_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3"><strong>Article Tags</strong></label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                @foreach ($tags as $tag)
                                    <div class="col-md-3 col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}">
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
                            <button type="submit" class="btn btn-success">Submit</button>
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
        var output = document.getElementById('thumbnailShowInput');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
