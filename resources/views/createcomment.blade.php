<x-app-layout>
    <div style="padding-top: 55px; overflow-x: hidden; margin-top: 20px">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                {{-- Header with back button --}}
                <div class="d-flex align-items-center mb-4 px-2">
                    <a href="/dashboard" class="btn btn-primary btn-md me-3">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Original Post --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold">{{ $post->title }}</h5>
                        <p class="text-muted mb-2">{{ Str::limit($post->content, 150) }}</p>
                        <div class="d-flex align-items-center">
                            <small class="text-muted me-3">
                                Posted by <span class="fw-bold">{{ $post->user->name }}</span>
                            </small>
                            <span class="badge bg-{{ $post->category === 'technology' ? 'primary' : ($post->category === 'business' ? 'success' : 'warning') }} bg-opacity-10 text-{{ $post->category === 'technology' ? 'primary' : ($post->category === 'business' ? 'success' : 'warning') }}">
                                {{ $post->category }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Comment Form --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Leave a comment</h6>
                        <form id="commentForm" action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <textarea 
                                    name="comment" 
                                    class="form-control" 
                                    rows="3" 
                                    placeholder="Write your thoughts..." 
                                    required
                                ></textarea>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary">
                                <span id="submitText">Post Comment</span>
                                <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript to disable the button --}}
    <script>
        document.getElementById('commentForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            const spinner = document.getElementById('submitSpinner');
            const text = document.getElementById('submitText');

            btn.disabled = true;
            text.textContent = 'Posting...';
            spinner.classList.remove('d-none');
        });
    </script>
</x-app-layout>
