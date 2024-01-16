
    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <a href="#" onclick="openImageModal('{{ $user->getImageURL() }}')">
                        <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                            src="{{ $user->getImageURL() }}" alt="User Avatar">
                    </a>
                    <div>
                        <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}</a></h3>
                        <span class="fs-6 text-muted">{{ $user->email }}</span>
                    </div>
                </div>
                <div>
                    @auth
                        @if (Auth::id() === $user->id)
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="px-2 mt-4">
                <!-- ... your existing content ... -->
            </div>
        </div>
    </div>

    <!-- Custom JavaScript -->
    <script>
        function openImageModal(imageURL) {
            var modal = document.createElement('div');
            modal.classList.add('modal');
            modal.innerHTML = `
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{$user->name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="${imageURL}" class="img-fluid" alt="User Avatar">
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            new bootstrap.Modal(modal).show();
        }
    </script>

