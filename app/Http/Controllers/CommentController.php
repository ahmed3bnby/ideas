<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea)
    {
        $this->validate(request(), [
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->idea_id = $idea->id;
        $comment->user_id = auth()->id();
        $comment->content = request()->get('content');
        $comment->save();

        return redirect()->route('idea.show', $idea->id)->with('success', 'Comment Posted Successfully');
    }

    public function destroy(Idea $idea, Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(404);
        }

        $comment->delete();

        return redirect()->route('idea.show', $idea->id)->with('danger', 'Comment Deleted Successfully!');
    }

    public function edit(Comment $comment)
    {
        $editing = true;
        return view('ideas.show', compact('comment', 'editing'));
    }

    public function update(Idea $idea, Comment $comment, Request $request)
    {
        $this->validate($request, [
            'edited_content' => 'required|string',
        ]);

        $comment->update([
            'content' => $request->input('edited_content'),
        ]);

        return redirect()->route('idea.show', $idea->id)->with('success', 'Comment Updated Successfully!');
    }
}
