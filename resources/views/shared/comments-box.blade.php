<div>
    @auth
    <form action="{{ route('comments.store', $idea->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="content" class="fs-6 form-control" rows="1"  placeholder="Write Your Comment.." ></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
        </div>
    </form>
    <hr>
    @endauth

    @foreach ($idea->comments as $comment)
        <div class="d-flex align-items-start">
            <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                  src="{{ $comment->user->getImageURL() }}"
                  alt="{{ $comment->user->name }}">
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>{{ $comment->user->name }}</h6>
                        <small class="fs-6 fw-light text-muted">{{ $comment->created_at }}</small>
                    </div>
                    @auth
                        @if (auth()->user()->id === $comment->user->id)
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton{{ $comment->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $comment->id }}">
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="editComment({{ $comment->id }}, '{{ $comment->content }}')">Edit</a>
                                    </li>
                                    <li>
                                        <form method="POST"
                                              action="{{ route('comment.destroy', ['idea' => $idea->id, 'comment' => $comment->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="dropdown-item">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endauth
                </div>
                <p id="comment{{ $comment->id }}" class="fs-6 mt-3 fw-light">
                    {{ $comment->content }}
                </p>
                <form id="editForm{{ $comment->id }}" style="display: none;" method="POST"
                      action="{{ route('comment.update', ['idea' => $idea->id, 'comment' => $comment->id]) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <textarea name="edited_content" class="fs-6 form-control"
                                  rows="1">{{ $comment->content }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-xs">Save</button>
                    <button type="button" class="btn btn-danger btn-xs cancel-edit"
                            data-comment-id="{{ $comment->id }}">X
                    </button>
                </form>
                @guest
                    <div class="comment-box-disabled">
                        <p><a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a>
                            to leave a comment.</p>
                    </div>
                @endguest
            </div>
        </div>
        <hr>
    @endforeach

    <script>
        function editComment(commentId, content) {
            var editForm = document.getElementById(`editForm${commentId}`);
            var commentElement = document.getElementById(`comment${commentId}`);
            var editedContent = editForm.querySelector('[name="edited_content"]');

            editedContent.value = content;
            editForm.style.display = 'flex';
            commentElement.style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function () {
            var cancelEditButtons = document.querySelectorAll('.cancel-edit');

            cancelEditButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var commentId = this.getAttribute('data-comment-id');
                    var editForm = document.getElementById(`editForm${commentId}`);
                    var commentElement = document.getElementById(`comment${commentId}`);

                    commentElement.style.display = 'block';
                    editForm.style.display = 'none';
                });
            });
        });
    </script>
</div>

<style>
    .comment-box-disabled {
        border: 1px solid #ccc;
        padding: 10px;
        background-color: #f9f9f9;
    }
</style>
