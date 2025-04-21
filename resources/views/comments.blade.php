<x-app-layout>
    <div style="padding-top: 55px; overflow-x: hidden; margin-top: 20px">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                {{-- Header with back button --}}
                <div class="d-flex align-items-center mb-4 px-2 ">
                    <a href="/dashboard" class="btn btn-primary btn-md me-3">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    
                </div>
                
                @if(session('success'))
                <div x-data="{ show: true }" 
                     x-init="setTimeout(() => show = false, 3000)"
                     x-show="show"
                     x-transition
                     class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

                {{-- Original Post Summary --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold">{{ $post->title }}</h5>
                        <p class="text-muted mb-2">{{ Str::limit($post->content, 150) }}</p>
                        <div class="d-flex align-items-center">
                            <small class="text-muted me-3">
                                Posted by<span class="fw-bold">
                                   {{ $post->user->name }}
                                </span>
                            </small>
                            <span class="badge bg-{{ $post->category === 'technology' ? 'primary' : ($post->category === 'business' ? 'success' : 'warning') }} bg-opacity-10 text-{{ $post->category === 'technology' ? 'primary' : ($post->category === 'business' ? 'success' : 'warning') }}">
                                {{ $post->category }}
                            </span>
                        </div>
                    </div>
                </div>
                <h3 class="fw-bold mb-3 px-3 text-primary">All Comments ({{ $comments->count() }})</h3>

                {{-- Comments List --}}
                @forelse ($comments as $comment)
                    <x-comment-card 
                        :name="$comment->user->name"
                        :time="$comment->created_at->diffForHumans()"
                        :body="$comment->body"
                        :isAuth="$comment->isAuth"
                        :isPostAuth="$comment->isPostAuth"
                        :commentId="$comment->id"
                        class="mb-3"
                    />
                @empty
                    <div class="alert alert-info">
                        No comments yet. Be the first to comment!
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>