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
            @foreach ($pinnedPost as $post)
                <div class="position-absolute m-2 p-2 text-white">
                    <h3 style="font-family: Roboto Slab">Most Populer</h3>
                </div>
                <a href="{{ route('post.show', $post->slug) }}">

                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                        <img src="{{ asset('storage/posts/' . $post->image) }}" class="d-block w-100" alt="..."
                            height="500" style="filter: brightness(70%)">
                        <div class="carousel-caption text-start d-none d-md-block">
                            <small class="text-light">
                                <b><a href="" class="text-decoration-none text-light">{{ $post->created_by }}</a>
                                    <b>· {{ $post->created_at->format('d F Y') }}</b>
                                </b>
                            </small>
                            <h2>{{ $post->title }}</h2>
                            <p>{{ Str::limit(strip_tags($post->content), 70, '...') }}</p>
                            <div style="margin-top:-15px">
                                @foreach ($post->tag as $tag)
                                    <a href="{{ route('welcome', ['tag' => $tag->name]) }}"
                                        class="text-primary my-2 text-decoration-none d-inline-block">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>

                            @foreach ($post->category as $category)
                                <small class="text-muted">
                                    <a href="{{ route('welcome', ['category' => $category->name]) }}"class="text-decoration-none p-1 px-2 rounded-4 text-light"
                                        style="border:1px solid white">{{ $category->name }}</a>
                                </small>
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach
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
    <hr>
    {{-- Category --}}
    @if ($categoryName)
        <h2 class="mt-2 " style="font-family: Roboto Slab">{{ $categoryName }}</h2>
    @elseif ($tagName)
        <h2 class="mt-2 " style="font-family: Roboto Slab"># {{ $tagName }}</h2>
    @else
        <h2 class="mt-2 " style="font-family: Roboto Slab">News</h2>
    @endif
    {{-- post --}}
    <div class="container mt-4">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-3">
                    <div class="post-card card">
                        <img src="{{ asset('storage/posts/' . $post->image) }}" height="200" class="card-img-top"
                            alt="">
                        <small id="tags" class="position-absolute ms-2 text-light">
                            @foreach ($post->tag as $tag)
                                <a href="{{ route('welcome', ['tag' => $tag->name]) }}"
                                    class="text-light text-decoration-none mt-2 d-inline-block">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </small>
                        <div class="card-body">
                            <small class="text-muted d-flex justify-content-between">
                                <p><a href="" class="text-decoration-none text-dark">{{ $post->created_by }}</a>
                                    <b>· {{ $post->created_at->format('d F Y') }}</b>
                                </p>
                                <p>{{ $post->views > 1000 ? number_format($post->views / 1000, 1) . 'k' : $post->views }}
                                    Views
                                </p>
                            </small>
                            <h5 class="card-title d-flex justify-content-between">
                                <a href="{{ route('post.show', $post->slug) }}"
                                    class="text-decoration-none text-dark">{{ $post->title }}</a>
                                <a href="{{ route('post.show', $post->slug) }}" class="text-dark"><i
                                        class="bi bi-arrow-up-right-circle absolute"></i></a>
                            </h5>
                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 80, '...') }}</p>
                            <small class="category" style="font-size:10px">
                                @foreach ($post->category as $category)
                                    <a
                                        href="{{ route('welcome', ['category' => $category->name]) }}"class="text-decoration-none border px-1 border-dark me-1 mt-1 rounded-4 text-dark">{{ $category->name }}</a>
                                @endforeach
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div>{{ $posts->links() }}</div>
@endsection
