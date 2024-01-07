<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    public function show(Idea $idea)
    {



        return view('ideas.show', compact('idea'));
    }

    public function store()
    {
      $validated =  request()->validate([
            'content' => 'required|min:5|max:240'
        ]);


        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea Created Succssfully!');
    }

    public function destroy(Idea $id)
    {
        $id->delete();
        return redirect()->route('dashboard')->with('danger', 'Idea Deleted Succssfully!');
    }

    public function edit(Idea $idea)
    {
        $editing = true;
        return view('ideas.show', compact('idea','editing'));
    }

    public function update(Idea $idea)
    {
        $validated =  request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea->update($validated);
/*
        $idea->content = request()->get('content', '');
        $idea->save();
*/
        return redirect()->route('idea.show', $idea->id)->with('success', 'Idea updated successfully!');
    }


}
