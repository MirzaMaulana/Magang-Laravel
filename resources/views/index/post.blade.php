@extends('index.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                <div class="mt-3 text-center">
                    <small class="px-1 rounded-3 float-start" style="border:solid 1px black">{{ $post->views }} Views</small>
                    <h1>{{ $post->title }}</h1>
                </div>

                {{-- User --}}
                <div class="d-flex my-4 justify-content-center">
                    <div class="">
                        <div class="card-body text-center">
                            <h5 class="card-title">Author : {{ $post->created_by }}</h5>
                            <p class="card-text"><small
                                    class="text-muted">{{ $post->created_at->format('l, j F Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="" id="post-img" class="img-fluid">
                <hr>
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

    <div class="container">
        <div class="row justify-content-center">
            {{-- Comments Block --}}
            <div class="card col-md-10 mt-3">
                <div class="card-body">
                    @if (auth()->check())
                        <h5 class="card-title">Comments</h5>
                        <hr>
                        <form action="{{ route('comment.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group">
                                <label for="content">Leave a comment</label>
                                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                            </div>
                            <button type="submit" class="mt-3 btn btn-outline-success">Submit</button>
                        </form>
                    @else
                        <div class="alert alert-warning" role="alert">
                            You Need to be <a href="{{ route('login') }}">logged</a> in to comment!
                        </div>
                    @endif

                    <hr>
                    @forelse ($post->comment as $comment)
                        <div class="media mt-3">
                            @if (auth()->check() && auth()->user()->id == $comment->user_id)
                                <div class="dropdown float-end">
                                    <a class="text-dark" href="#" role="button" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-list"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#editCommentModal{{ $comment['id'] }}">Edit
                                                Comment</button></li>
                                        <li>
                                            <form action="{{ route('comment.delete', ['comment' => $comment->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="dropdown-item border-0 mr-2">
                                                    Delete Comment
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            <div class="d-flex">
                                @if ($comment->user->image)
                                    <img src="{{ asset('storage/avatars/' . $comment->user->image) }}"
                                        class="mr-3 me-2 rounded-circle" width="40" height="40" alt="...">
                                @else
                                    <img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1"
                                        class="mr-3 me-2 rounded-circle" width="40" height="40" alt="...">
                                @endif
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                    <p>{{ $comment->content }}</p>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <hr>
                        </div>
                        @include('includes.modal-editcomment')
                    @empty
                        <div class="alert alert-info" role="alert">
                            No comments on this post yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

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
                            <h5 class="title d-flex justify-content-between"><a
                                    href="{{ route('post.show', $post->slug) }}" class="text-decoration-none">
                                    {{ $post->title }}</a> <a href="{{ route('post.show', $post->slug) }}"
                                    class="text-dark"><i class="bi bi-arrow-up-right-circle absolute"></i></a>
                            </h5>
                            <small><a href=""
                                    class="text-decoration-none text-dark">{{ $post->created_by }}</a></small>
                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 100, '...') }}</p>
                            <small class="d-flex justify-content-between">
                                <p>{{ $post->created_at->format('d F Y') }}</p>
                                <p>{{ $post->views }} Views</p>
                            </small>
                        </div>

                    </div>
                    <hr>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/submit.js') }}"></script>
@endpush
