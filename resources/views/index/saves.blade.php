@extends('index.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Postingan Disimpan</h2>
                @if (count($savedPosts) > 0)
                    @foreach ($savedPosts as $savedPost)
                        <div class="card mb-3 shadow">
                            <a class="text-decoration-none" href="{{ route('post.show', $savedPost->post->slug) }}">
                                <div class="card-body d-flex text-dark">
                                    <img src="{{ asset('storage/posts/' . $savedPost->post->image) }}" height="80"
                                        class="me-2 rounded-3" alt="">
                                    <div>
                                        <form action="{{ route('postsave.destroy', ['postsave' => $savedPost->post->id]) }}"
                                            method="POST" class="float-end">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger me-2"><i
                                                    class="bi bi-bookmark"></i></button>
                                        </form>
                                        <h5 class="card-title">{{ $savedPost->post->title }}</h5>
                                        <p class="card-text">
                                            {{ Str::limit(strip_tags($savedPost->post->content), 80, '...') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>Anda belum menyimpan postingan apapun.</p>
                @endif
            </div>
        </div>
    </div>

@endsection
