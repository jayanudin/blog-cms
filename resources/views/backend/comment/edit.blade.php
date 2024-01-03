@extends('backend.layouts.app')
@section('content')
    <div class="col-md-10">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Comment Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('admin.comment.update', $comment->id) }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal form-label-left">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Email Author</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('email') ? 'parsley-error' : '' }}"
                                placeholder="Email Author" name="email" value="{{ $comment->email }}">
                            @if ($errors->has('email'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('email') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Full Name Author</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text"
                                class="form-control {{ $errors->has('full_name') ? 'parsley-error' : '' }}"
                                placeholder="Full Name Author" name="full_name" value="{{ $comment->full_name }}">
                            @if ($errors->has('full_name'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('full_name') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Content</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="x_content">
                                <textarea id="editor" name="content">{{ $comment->content }}</textarea>
                            </div>
                            @if ($errors->has('content'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('content') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 20px;">
                        <label class="control-label col-md-3 col-sm-3">Status</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-md-2">
                                    <span>Active:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="flat" name="status" id="statusActive" value="1" {{ $comment->status == 1 ? 'checked' : '' }}
                                    required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <span>Inactive:</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="flat" name="status" id="statusInactive" value="0" {{ $comment->status == 0 ? 'checked' : '' }} />
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('status') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Article Title</label>
                        <div class="col-md-9 col-sm-9">
                            <select name="article_id"
                                class="form-control {{ $errors->has('article_id') ? 'parsley-error' : '' }}">
                                <option value="">Choose option</option>
                                @foreach ($articles as $article)
                                    <option value="{{ $article->id }}" {{ $article->id == $comment->article_id ? 'selected' : '' }}>{{ $article->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('article_id'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('article_id') }}</li>
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
