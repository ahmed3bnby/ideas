<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $ideas = Idea::orderBy('created_at', 'DESC');

    // Check if the 'search' parameter is present
    if (request()->filled('search')) {
        $ideas = $ideas->where('content', 'like', '%' . request()->input('search') . '%');

        if ($ideas->count() == 0) {
            // No results found, flash a message
            session()->now('message', 'No results found!');
        } else {
            // Results found, flash a message
            session()->now('message', $ideas->count() . ' Results Found');
        }
    }

    return view('dashboard', [
        'ideas' => $ideas->paginate(5)
    ]);
}


}
