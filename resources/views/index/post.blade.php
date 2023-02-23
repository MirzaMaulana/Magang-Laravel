@extends('index.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $post->title }}</h2>
                <p>By: <a href="" class="text-decoration-none">{{ $post->created_by }}</a></p>
                <img src="{{ asset('storage/posts/' . $post->image) }}" height="500" alt="" class="img-fluid">
                <article class="my-3 fs-5">
                    {!! $post->content !!}
                </article>

                <a href="/" class="mt-3">Back to Posts</a>
            </div>
        </div>
    </div>
@endsection
