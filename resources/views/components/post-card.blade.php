<div class="card rounded-4 border-0 shadow-sm mb-4 hover-shadow">
    <div class="card-body p-4">
        <div class="d-flex align-items-center mb-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=4e73df&color=fff&rounded=true&size=40" 
                 class="rounded-circle me-2 border border-2 border-primary" 
                 alt="{{ $userName }}">
            <div>
                <h6 class="mb-0 fw-bold">{{ $userName }}</h6>
                <small class="text-muted">Posted {{ $timePosted }}</small>
            </div>
        </div>
        
        <h5 class="fw-bold mb-2">{{ $title }}</h5>
        <p class="text-muted mb-3">
            {{ $excerpt }}
        </p>
        <span class="badge rounded-pill bg-{{ $categoryColor }} bg-opacity-10 text-{{ $categoryColor }} mb-3">
            {{ $category }}
        </span>
        
        <div class="d-flex justify-content-between align-items-center border-top pt-3">
            <div>
                <a href="/dashboard/{{ $postId }}/comments" class="text-decoration-none text-muted me-3">
                    <i class="bi bi-chat-left-text me-1"></i> {{ $commentCount }} comments
                </a>
            </div>
            <div>
                <a href="/dashboard/{{ $postId }}/comments/create" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-chat-left-text me-1"></i> Make Comment
                </a>
            </div>
        </div>

        <!-- Comment input form -->
        <div class="collapse" id="commentForm{{ $postId }}">
            <form action="{{ route('comment.store') }}" method="POST" class="mt-3" onsubmit="handleCommentSubmit(this)">
                @csrf
                <input type="hidden" name="post_id" value="{{ $postId }}">
                <div class="mb-3">
                    <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-md submit-comment-btn">
                    Submit Comment
                </button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to handle disabling button on form submit -->
<script>
    function handleCommentSubmit(form) {
        const btn = form.querySelector('.submit-comment-btn');
        btn.disabled = true;
        btn.innerHTML = <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...;
    }
</script>