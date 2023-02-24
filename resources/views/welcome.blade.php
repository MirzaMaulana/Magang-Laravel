@extends('index.app')
@section('content')
    {{-- jumbotron --}}
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <p class="lead fw-bold" style="margin-bottom: 0">The Blog</p>
            <h1 class="display-4">Writing From Our Team</h1>
            <p style="font-family: Roboto Slab">The latest industry news, interviews, tecnologies, and resource</p>
        </div>
    </div>
    {{-- Carousel --}}
    <div id="carouselExampleCaptions" class="mt-4 carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-inner">
                @foreach ($posts as $post)
                    @if ($post->is_pinned === 1)
                        <a href="{{ route('post.show', $post->slug) }}">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/posts/' . $post->image) }}" class="d-block w-100" alt="..."
                                    height="500" style="filter: brightness(70%)">
                                <div class="carousel-caption text-start d-none d-md-block">
                                    <small class="text-light">
                                        <b><a href=""
                                                class="text-decoration-none text-light">{{ $post->created_by }}</a>
                                            <b>· {{ $post->created_at->format('d F Y') }}</b>
                                        </b>
                                    </small>
                                    <h2>{{ $post->title }}</h2>
                                    <p>{{ Str::limit(strip_tags($post->content), 70, '...') }}</p>
                                    @foreach ($post->category as $category)
                                        <small class="text-muted">
                                            <a href=""class="text-decoration-none p-1 px-2 rounded-4 text-light"
                                                style="border:1px solid white">{{ $category->name }}</a>
                                        </small>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- post --}}
    <div class="container mt-4">
        <div class="row">
            @foreach ($posts as $post)
                @if ($post->is_pinned != 1)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/posts/' . $post->image) }}" height="200" class="card-img-top"
                                alt="">
                            <small id="tags" class="position-absolute ms-2 text-light">
                                @foreach ($post->tag as $tags)
                                    <p class="mt-2 d-inline-block">
                                        #{{ $tags->name }}
                                    </p>
                                @endforeach
                            </small>
                            <div class="card-body">
                                <small class="text-muted">
                                    <p><a href="" class="text-decoration-none text-dark">{{ $post->created_by }}</a>
                                        <b>· {{ $post->created_at->format('d F Y') }}</b>
                                    </p>
                                </small>
                                <h5 class="card-title d-flex justify-content-between">
                                    <a href="{{ route('post.show', $post->slug) }}"
                                        class="text-decoration-none text-dark">{{ $post->title }}</a>
                                    <i class="bi bi-arrow-up-right-circle absolute"></i>
                                </h5>
                                <p class="card-text">{{ Str::limit(strip_tags($post->content), 80, '...') }}</p>
                                {{-- <a href="{{ route('post.show', $post->slug) }}" class="btn btn-outline-success">Read
                                    More</a> --}}
                                @foreach ($post->category as $category)
                                    <small class="text-muted">
                                        <a href=""class="text-decoration-none me-1 p-1 px-2 rounded-4 text-dark"
                                            style="border:1px solid black">{{ $category->name }}</a>
                                    </small>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div>{{ $posts->links() }}</div>
@endsection
