<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Fact;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display the dynamic portfolio landing page.
     */
    public function index(): View
    {
        $projects = Project::where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $experiences = Experience::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $skills = Skill::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $facts = Fact::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        // Load all settings key-value pairs
        $settings = SiteSetting::pluck('value', 'key')->all();

        return view('portfolio.index', compact(
            'projects',
            'experiences',
            'skills',
            'facts',
            'settings'
        ));
    }
}

