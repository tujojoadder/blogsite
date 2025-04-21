<div class="card border-0 shadow-sm rounded-4 mb-3 hover-shadow">
    <div class="card-body p-4" x-data="{ editing: false, commentText: @js($body), originalText: @js($body) }">
        
        <!-- User Info -->
        <div class="d-flex mb-2">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&background=0d6efd&color=fff&rounded=true&size=40"
                 class="rounded-circle me-3 border border-2 border-primary" 
                 alt="{{ $name }}">
            <div>
                <h6 class="mb-0 fw-semibold">{{ $name }}</h6>
                <small class="text-muted">{{ $time }}</small>
            </div>
        </div>

        <!-- Comment Content -->
        <div class="mb-2">
            <template x-if="!editing">
                <p class="mb-0 text-muted" x-text="commentText"></p>
            </template>

            <template x-if="editing">
                <form method="POST" action="{{ route('comments.update', $commentId) }}">
                    @csrf
                    @method('PUT')
                    <textarea 
                        name="body" 
                        class="form-control mb-2 rounded-3 shadow-sm" 
                        x-model="commentText" 
                        rows="3"
                    ></textarea>

                    <!-- Update + Cancel Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-sm btn-success fw-semibold px-3">
                            <i class="fas fa-check me-1"></i> Update
                        </button>
                        <button type="button" @click="editing = false; commentText = originalText" class="btn btn-sm btn-secondary fw-semibold px-3">
                            Cancel
                        </button>
                    </div>
                </form>
            </template>
        </div>

        <!-- Edit/Delete Buttons (only show when NOT editing) -->
        @if($isAuth)
            <template x-if="!editing">
                <div class="mt-3 d-flex justify-content-end gap-2">
                    <button @click="editing = true" class="btn btn-sm btn-outline-primary fw-semibold px-3">
                        <i class="fas fa-edit me-2"></i> Edit
                    </button>


                    @if($isPostAuth)
                    <form action="{{ route('comments.destroy', $commentId) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold px-3">
                            <i class="fas fa-trash-alt me-2"></i> Delete
                        </button>
                    </form>
                    @endif

                </div>
            </template>
        @endif
    </div>
</div>
