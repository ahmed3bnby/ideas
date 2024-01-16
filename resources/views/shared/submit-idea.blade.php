<div>
    @auth()
        <h4>Share Your Ideas</h4>
        <div class="row">
            <form action="{{ route('idea.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3" placeholder="Write Your Idea.."></textarea>
                    @error('content')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}} </span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-dark">Share</button>
                </div>
            </form>
        </div>
    @endauth

    @guest
        <div class="login-box-disabled">
            <h4>Share Your Ideas</h4>
            <form action="{{ route('login') }}" method="get">
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3" placeholder="Login to share your ideas" style="pointer-events: auto;"></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Login</button>
            </form>
            <p>Don't have an account? <a href="{{ route('register') }}">Register</a> to share your ideas.</p>
        </div>
    @endguest
</div>

<style>
    .login-box-disabled {
        border: 1px solid #ccc;
        padding: 10px;
        background-color: #f9f9f9;
    }
</style>
