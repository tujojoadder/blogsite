<x-app-layout>
    <div style="padding-top: 55px; overflow-x: hidden; margin-top: 20px">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                @if(session('success'))
                    <div x-data="{ show: true }" 
                         x-init="setTimeout(() => show = false, 3000)"
                         x-show="show"
                         x-transition
                         class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Create Post Form --}}
                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('posts.store') }}" method="POST" id="postForm">
                            @csrf
                            
                            {{-- Title Field --}}
                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold mb-2">Post Title</label>
                                <input type="text" 
                                       class="form-control border-2 py-2 px-3 fs-5" 
                                       id="title" 
                                       name="title" 
                                       placeholder="Enter your post title here" 
                                       required
                                       style="border-color: #e0e0e0; border-radius: 8px;">
                                <div class="form-text mt-1">Keep it clear and engaging</div>
                            </div>

                            {{-- Category Field --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-2">Category</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category" 
                                               id="tech" value="technology" checked>
                                        <label class="form-check-label" for="tech">
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Technology</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category" 
                                               id="business" value="business">
                                        <label class="form-check-label" for="business">
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">Business</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category" 
                                               id="lifestyle" value="lifestyle">
                                        <label class="form-check-label" for="lifestyle">
                                            <span class="badge bg-warning bg-opacity-10 text-danger px-3 py-2">Lifestyle</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Content Field --}}
                            <div class="mb-4">
                                <label for="content" class="form-label fw-bold mb-2">Post Content</label>
                                <textarea class="form-control border-2 py-2 px-3" 
                                          id="content" 
                                          name="content" 
                                          rows="8" 
                                          placeholder="Write your post content here..." 
                                          required
                                          style="border-color: #e0e0e0; border-radius: 8px;"></textarea>
                                <div class="form-text mt-1">Markdown formatting supported</div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid mt-4">
                                <button type="submit" id="submitBtn" class="btn btn-primary rounded-pill py-2 px-4">
                                    <i class="bi bi-send me-2"></i> Publish Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js for dismissible alert -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('postForm');
            const btn = document.getElementById('submitBtn');
            const originalBtnHTML = btn.innerHTML;
            
            form.addEventListener('submit', function() {
                // Only disable if form is valid
                if(form.checkValidity()) {
                    btn.disabled = true;
                    btn.innerHTML = `
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Publishing...
                    `;
                }
            });
            
            // Reset button state when coming back from validation errors
            window.addEventListener('pageshow', function() {
                if(btn.disabled) {
                    btn.disabled = false;
                    btn.innerHTML = originalBtnHTML;
                }
            });
        });
    </script>
</x-app-layout>