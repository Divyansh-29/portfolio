<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create(): View
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company' => ['required', 'string', 'max:200'],
            'role' => ['required', 'string', 'max:200'],
            'period' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience entry created successfully!');
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'company' => ['required', 'string', 'max:200'],
            'role' => ['required', 'string', 'max:200'],
            'period' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience entry updated successfully!');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience entry deleted successfully!');
    }
}

