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
                            <textarea name="content" oninput="postCount()" id="postContent" class="form-control" value="{{ old('content') }}"
                                required rows="3" maxlength="255"></textarea>
                            <small>Number of characters left: <span id="postcounter"></span></small>
                        </div>
                        <button id="button" class="mt-3 btn btn-outline-success">Submit</button>
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
                                        <form onsubmit="destroy(event)"
                                            action="{{ route('comment.delete', ['comment' => $comment->id]) }}"
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
                                    class="mr-3 me-4 rounded-circle" width="40" height="40" alt="...">
                            @else
                                <img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1"
                                    class="mr-3 me-4 rounded-circle" width="40" height="40" alt="...">
                            @endif
                            <div class="media-body">
                                <small class="mt-0">{{ $comment->user->name }}</small>
                                <p>{{ $comment->content }}</p>
                                <div class="d-flex" style="margin-top: -10px">
                                    <small class="text-muted me-2">{{ $comment->created_at->diffForHumans() }}</small>
                                    @if (auth()->check())
                                        <button class="badge me-2 bg-success text-decoration-none border-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#replyCommentModal{{ $comment['id'] }}">Balas</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @foreach ($comment->replies as $reply)
                            {{-- Parents comments --}}
                            <div class="ms-4 mt-3 d-flex">
                                @if ($reply->user->image)
                                    <img src="{{ asset('storage/avatars/' . $reply->user->image) }}"
                                        class="mr-3 me-3 rounded-circle" width="40" height="40" alt="...">
                                @else
                                    <img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1"
                                        class="mr-3 me-3 rounded-circle" width="40" height="40" alt="...">
                                @endif
                                <div class="media-body py-2 px-3 w-100 rounded-3" style="background-color:#f1f1f1">
                                    @if (auth()->check() && auth()->user()->id == $reply->user_id)
                                        <div class="dropdown float-end">
                                            <a class="text-dark" href="#" role="button" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editCommentModal{{ $reply['id'] }}">Edit
                                                        Comment</button></li>
                                                <li>
                                                    <form onsubmit="destroy(event)"
                                                        action="{{ route('comment.delete', ['comment' => $reply->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit"
                                                            class="dropdown-item border-0 mr-2">Delete
                                                            Comment</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    <small class="mt-0">{{ $reply->user->name }}</small>
                                    <p>{{ $reply->content }}</p>
                                    <div class="d-flex" style="margin-top: -10px">
                                        <small
                                            class="text-muted me-2">{{ $reply->created_at->diffForHumans() }}</small>
                                        @if (auth()->check())
                                            <button class="badge me-2 bg-success text-decoration-none border-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#replyCommentModal{{ $reply->id }}">Balas</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- end parents comments --}}
                            {{-- balasan kedua --}}
                            @foreach ($reply->replies as $reply2)
                                {{-- Parents comments --}}
                                <div class="ms-5 mt-3 d-flex">
                                    @if ($reply2->user->image)
                                        <img src="{{ asset('storage/avatars/' . $reply2->user->image) }}"
                                            class="mr-3 me-3 rounded-circle" width="40" height="40"
                                            alt="...">
                                    @else
                                        <img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1"
                                            class="mr-3 me-3 rounded-circle" width="40" height="40"
                                            alt="...">
                                    @endif
                                    <div class="media-body py-2 px-3 w-100 rounded-3"
                                        style="background-color:#f1f1f1">
                                        @if (auth()->check() && auth()->user()->id == $reply2->user_id)
                                            <div class="dropdown float-end">
                                                <a class="text-dark" href="#" role="button"
                                                    id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bi bi-list"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editCommentModal{{ $reply2['id'] }}">Edit
                                                            Comment</button></li>
                                                    <li>
                                                        <form onsubmit="destroy(event)"
                                                            action="{{ route('comment.delete', ['comment' => $reply2->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit"
                                                                class="dropdown-item border-0 mr-2">Delete
                                                                Comment</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                        <small class="mt-0">{{ $reply2->user->name }}</small>
                                        <p>{{ $reply2->content }}</p>
                                        <div class="d-flex" style="margin-top: -10px">
                                            <small
                                                class="text-muted me-2">{{ $reply2->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                                {{-- end parents comments --}}
                            @endforeach
                            @include('includes.modal-reply')
                        @endforeach

                        <hr>
                    </div>
                    @include('includes.modal-editcomment')
                    @include('includes.modal-replycomment')
                    @include('includes.modal-delete')
                @empty
                    <div class="alert alert-info" role="alert">
                        No comments on this post yet
                    </div>
                @endforelse
            </div>
        </div>
    </div>
