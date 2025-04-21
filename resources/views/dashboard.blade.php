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

                {{-- Filter & Search Bar --}}
<div class="card shadow-sm rounded-4 mb-4 border-0">
    <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between">

            {{-- User Profile --}}
            <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=black&color=fff&size=40" 
                     class="rounded-circle me-2 border border-2 border-primary" 
                     alt="{{ Auth::user()->name }}">
                <div>
                    <h6 class="mb-0 fw-bold text-danger">{{ Auth::user()->name }}</h6>
                    <small class=" text-primary">Welcome back!</small>
                </div>
            </div>
            
            {{-- Filter Dropdown --}}
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" 
                                type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Categories</h6></li>

                            {{-- All Posts --}}
                            <li>
                                <a class="dropdown-item {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                                    <i class="bi bi-grid-fill me-2"></i>All Posts
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            {{-- Technology --}}
                            <li>
                                <a class="dropdown-item {{ request()->is('dashboard/technology') ? 'active' : '' }}" href="/dashboard/technology">
                                    <span class="badge bg-primary me-2">T</span>Technology
                                </a>
                            </li>

                            {{-- Business --}}
                            <li>
                                <a class="dropdown-item {{ request()->is('dashboard/business') ? 'active' : '' }}" href="/dashboard/business">
                                    <span class="badge bg-success me-2">B</span>Business
                                </a>
                            </li>

                            {{-- Lifestyle --}}
                            <li>
                                <a class="dropdown-item {{ request()->is('dashboard/lifestyle') ? 'active' : '' }}" href="/dashboard/lifestyle">
                                    <span class="badge bg-warning me-2">L</span>Lifestyle
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


               {{-- Show Current Category Heading --}}
                <h5 class="fw-bold  px-3 pb-3  h5 text-decoration-underline">
                    @if (request()->is('dashboard'))
                        All Blogs
                    @elseif (request()->is('dashboard/technology'))
                        Technology Blogs
                    @elseif (request()->is('dashboard/business'))
                        Business Blog
                    @elseif (request()->is('dashboard/lifestyle'))
                        Lifestyle Blogs
                    @else
                        Posts Blogs
                    @endif
                </h5>
                
              {{-- Blog Posts --}}
                @foreach($posts as $post)
                    <x-post-card 
                         :userName="$post->user->name"
                        :timePosted="$post->created_at->diffForHumans()"
                        :title="$post->title"
                        :excerpt="Str::limit($post->content, 150)"
                        :category="$post->category"
                        :categoryColor="match($post->category) {
                            'technology' => 'primary',
                            'business' => 'success',
                            'lifestyle' => 'warning',
                            default => 'secondary',
                        }"
                        :commentCount="$post->comments_count"
                        :postId="$post->id"
                    />
                @endforeach

                
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom hover effect -->
    <style>
        .hover-shadow:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            transition: all 0.3s ease;
        }
        
    </style>
</x-app-layout>