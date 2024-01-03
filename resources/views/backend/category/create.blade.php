@extends('backend.layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Create Category Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal form-label-left">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Category Name</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text"
                                class="form-control {{ $errors->has('category_name') ? 'parsley-error' : '' }}"
                                placeholder="Category Name" name="category_name">
                            @if ($errors->has('category_name'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('category_name') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Status</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-md-3">
                                    <span> Publish:</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" class="flat" name="status" id="statusPublish" value="1"
                                        checked="" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <span> Unpublish:</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" class="flat" name="status" id="statusUnpublish"
                                        value="0" />
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
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
