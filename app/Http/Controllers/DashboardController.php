<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Contact;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('isAdmin');

        $stats = [
            'total_projects' => Project::count(),
            'total_skills' => Skill::count(),
            'unread_messages' => Contact::where('is_read', false)->count(),
            'total_messages' => Contact::count(),
        ];

        $recent_projects = Project::latest()->take(5)->get();
        $recent_messages = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_projects', 'recent_messages'));
    }
}
