<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\ContactMessage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with key statistics and recent activity.
     */
    public function index(): View
    {
        $totalProjects = Project::count();
        $totalExperiences = Experience::count();
        $totalSkills = Skill::count();
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();
        $totalMessagesCount = ContactMessage::count();

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::orderBy('sort_order')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'totalExperiences',
            'totalSkills',
            'unreadMessagesCount',
            'totalMessagesCount',
            'recentMessages',
            'recentProjects'
        ));
    }
}

