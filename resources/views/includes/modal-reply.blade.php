<form action="{{ route('comment.reply', ['comment' => $comment->id]) }}" method="POST"
    data-comment-id="{{ $comment->id }}">
    @csrf
    <div class="modal fade" id="replyCommentModal{{ $reply->id }}" tabindex="-1"
        aria-labelledby="replyCommentModal{{ $reply->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="comment_id" value="{{ $reply->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyCommentModal{{ $reply->id }}Label">Reply Comment to <span
                            class="text-primary">{{ $reply->user->name }}</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="replyContent" class="form-label">Comment :</label>
                        <textarea name="content"
                            oninput="document.getElementById('counter{{ $reply->id }}').innerHTML = 255 - this.value.length"
                            id="replyContent" class="form-control" maxlength="255" value="{{ old('content') }}" required></textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small>Number of characters left: <span id="counter{{ $reply->id }}"></span></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Reply Comment</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/submit.js') }}"></script>
<script>
    // function Count() {
    //     var maxLength = 255;
    //     var currentLength = document.getElementById("replyContent").value.length;
    //     var charsLeft = maxLength - currentLength;

    //     document.getElementById("counter").innerHTML = charsLeft;
    // }
</script>
