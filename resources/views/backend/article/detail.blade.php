@extends('backend.layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2><strong>{{ $article->title }}</strong></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="img-wrap">
                    <img src="{{ URL::to('/') }}/images/{{ $article->thumbnail }}" alt="" style="max-width: 50%">
                </div>
                <div class="body">
                    <p>{!! $article->content !!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2><strong>Tags Article</strong></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach ($tags as $tag)
                    <span class="badge badge-secondary" style="padding: 8px">{{ $tag->tag_name }}</span>
                @endforeach
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <h2><strong>Categories Article</strong></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach ($categories as $category)
                    <span class="badge badge-primary" style="padding: 8px">{{ $category->category_name }}</span>
                @endforeach
            </div>
        </div>
    </div>
@endsection
