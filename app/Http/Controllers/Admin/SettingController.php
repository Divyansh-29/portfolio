<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fact;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::all()->groupBy('group');
        $facts = Fact::orderBy('sort_order')->orderBy('id')->get();
        $user = Auth::user();

        return view('admin.settings.index', compact('settings', 'facts', 'user'));
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $data = $request->except(['_token', '_method', 'facts', 'password', 'current_password', 'password_confirmation', 'name', 'email']);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Update facts if provided
        if ($request->has('facts') && is_array($request->input('facts'))) {
            foreach ($request->input('facts') as $factId => $factData) {
                if (isset($factData['value']) && isset($factData['label'])) {
                    Fact::where('id', $factId)->update([
                        'value' => $factData['value'],
                        'label' => $factData['label'],
                        'sort_order' => $factData['sort_order'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Site settings updated successfully!');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'required_with:password', 'current_password'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Admin profile updated successfully!');
    }
}

