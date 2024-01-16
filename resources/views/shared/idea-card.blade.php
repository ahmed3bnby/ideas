<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{ $idea->user->getImageURL() }}" alt="{{ $idea->user->name }}">
                <div>
                    <h5 class="card-title mb-0">
                        <a href="{{ route('users.show', $idea->user->id) }}"> {{ $idea->user->name }}</a>
                    </h5>
                </div>
            </div>
            <div class="btn-group">
                @if(auth()->check() && auth()->user()->id === $idea->user->id)
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="toggleEditForm('editForm{{$idea->id}}')">Edit</a></li>
                        <a href="{{ route('idea.show', $idea->id) }}" class="dropdown-item">View</a>
                        <li>
                            <form method="POST" action="{{ route('idea.destroy', $idea->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item">Delete</button>
                            </form>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="card-body">
        <form id="editForm{{$idea->id}}" action="{{ route('idea.update', $idea->id) }}" method="post" class="d-none">
            @csrf
            @method('put')
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3">{{ $idea->content }}</textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
                <button type="button" class="btn btn-secondary mb-2 btn-sm" onclick="cancelEdit('editForm{{$idea->id}}')">Cancel</button>
            </div>
        </form>

        <p class="fs-6 fw-light text-muted">
            {{ $idea->content }}
        </p>

        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{ $idea->likes }} </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at }} </span>
            </div>
        </div>

        @include('shared.comments-box')
    </div>
</div>

<script>
    function toggleEditForm(formId) {
        var editForm = document.getElementById(formId);
        if (editForm) {
            editForm.classList.toggle('d-none');
        }
    }
</script>



