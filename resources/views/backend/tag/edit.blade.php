@extends('backend.layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Tag Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('admin.tag.update', $tag->id) }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal form-label-left">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Tag Name</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('tag_name') ? 'parsley-error' : '' }}"
                                placeholder="Tag Name" value="{{ old('tag_name', $tag->tag_name) }}" name="tag_name">
                            @if ($errors->has('tag_name'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('tag_name') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Status</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-md-3">
                                    <span>Publish:</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" class="flat" name="status" id="statusPublish" value="1" {{ $tag->status == 1 ? 'checked' : '' }} />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <span>Unpublish:</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" class="flat" name="status" id="statusUnpublish" value="0" {{ $tag->status == 0 ? 'checked' : '' }} />
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('status') }}</li>
                                </ul>
                            @endif
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
