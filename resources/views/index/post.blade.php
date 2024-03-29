@extends('index.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                <div class="mt-3 text-center">
                    <h1 style="font-family: Roboto Slab">{{ $post->title }}</h1>
                </div>

                {{-- User --}}
                <div class="d-flex my-4 justify-content-center">
                    <div class="">
                        <div class="card-body text-center">
                            <h5 class="card-title">Author : {{ $post->created_by }}</h5>
                            <p class="card-text"><small
                                    class="text-muted">{{ $post->created_at->format('l, j F Y') }}</small>
                            </p>
                            <div class="d-flex justify-content-center">
                                <small class="px-1 mx-1 rounded-3"
                                    style="border:solid 1px black">{{ $post->views > 1000000 ? number_format($post->views / 1000000, 2) . 'm' : ($post->views > 1000 ? number_format($post->views / 1000, 1, '.', '') . 'k' : $post->views) }}
                                    Views
                                </small>
                                <small class="px-1 rounded-3 mx-1"
                                    style="border:solid 1px black">{{ $post->postLike->count() }}
                                    Likes
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="" id="post-img"
                    class="img-fluid card-img-top">
                <hr>
                <div class="d-flex justify-content-end">

                    {{-- button  group --}}

                    @if (auth()->check() && $post->postLike->where('user_id', Auth::user()->id)->count() > 0)
                        <form
                            action="{{ route('postlike.destroy', $post->postLike->where('user_id', Auth::user()->id)->first()->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger me-2">Unlike This Post <i
                                    class="bi bi-hand-thumbs-down"></i></button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('postlike.input') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button class="btn btn-sm btn-success me-2">Like This Post <i
                                    class="bi bi-hand-thumbs-up"></i></button>
                        </form>
                    @endif
                    @if (auth()->check() && $postsave)
                        <button class="btn btn-sm btn-success me-2">This Post has Saved <i
                                class="bi bi-pin-angle"></i></button>
                    @else
                        <form action="{{ route('postsave.input') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button class="button btn btn-sm btn-warning me-2">Save this post <i
                                    class="bi bi-save"></i></button>
                        </form>
                    @endif
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
                        <button class="btn btn-primary btn-sm">Share This Post <i class="bi bi-share"></i></button>
                    </a>
                    {{-- end button group --}}
                </div>

                <article class="my-3 fs-5">
                    {!! $post->content !!}
                </article>
                <div>
                    @foreach ($post->tag as $tags)
                        <p class=" d-inline-block text-primary">
                            <a href="{{ route('welcome', ['tag' => $tags->name]) }}">#{{ $tags->name }}</a>
                        </p>
                    @endforeach
                </div>
                <div class="my-3">
                    @foreach ($post->category as $category)
                        <small class="d-inline-block me-2"><a class="text-decoration-none p-1 rounded-3 text-dark"
                                href="{{ route('welcome', ['category' => $category->name]) }}"
                                style="border:1px solid black">{{ $category->name }}</a></small>
                    @endforeach
                </div>
                <p>
                    <a href="/" class="mt-3 text-decoration-none btn btn-outline-success">
                        <i class="bi bi-box-arrow-left me-2">
                        </i> Back to Posts
                    </a>
                </p>
            </div>
        </div>
    </div>
    @include('index.comment')
    {{-- end comment --}}
    <h2 class="text-center my-3">More Posts</h2>
    <div class="row justify-content-center">
        @foreach ($posts as $post)
            <div class="col-md-10 mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/posts/' . $post->image) }}" height="140" class="card-img-top"
                            alt="">

                    </div>
                    <div class="col">
                        <h5 class="title d-flex justify-content-between"><a href="{{ route('post.show', $post->slug) }}"
                                class="text-decoration-none">
                                {{ $post->title }}</a> <a href="{{ route('post.show', $post->slug) }}"
                                class="text-dark"><i class="bi bi-arrow-up-right-circle absolute"></i></a>
                        </h5>
                        <small><a href="" class="text-decoration-none text-dark">{{ $post->created_by }}</a></small>
                        <p class="card-text">{{ Str::limit(strip_tags($post->content), 100, '...') }}</p>
                        <small class="d-flex justify-content-between">
                            <p>{{ $post->created_at->format('d F Y') }}</p>
                            <p>{{ $post->views > 1000 ? number_format($post->views / 1000, 1) . 'k' : $post->views }}
                                Views</p>
                        </small>
                    </div>

                </div>
                <hr>
            </div>
        @endforeach
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#social-links').replaceWith(function() {
                return $('> ul > li > a', this);
            });
        });

        function postCount() {
            var maxLength = 255;
            var currentLength = document.getElementById("postContent").value.length;
            var charsLeft = maxLength - currentLength;

            document.getElementById("postcounter").innerHTML = charsLeft;
        }
    </script>
    <script src="{{ asset('js/comment.js') }}"></script>
@endpush
