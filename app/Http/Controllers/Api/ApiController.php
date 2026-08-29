<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Fact;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Get public portfolio profile information.
     */
    public function profile(): JsonResponse
    {
        $settings = SiteSetting::pluck('value', 'key')->all();
        $facts = Fact::orderBy('sort_order')->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'profile' => [
                    'name' => 'Divyansh Chawla',
                    'title' => 'UI/UX Designer & Web Developer',
                    'location' => 'Delhi, India',
                    'contact_method' => 'Message form available at /#say-hello or POST /api/v1/contact',
                ],
                'settings' => $settings,
                'facts' => $facts,
            ],
        ]);
    }

    /**
     * Get all featured projects.
     */
    public function projects(): JsonResponse
    {
        $projects = Project::where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $projects->count(),
            'data' => $projects,
        ]);
    }

    /**
     * Get a single project by slug or ID.
     */
    public function project(string $identifier): JsonResponse
    {
        $project = Project::where('slug', $identifier)
            ->orWhere('id', $identifier)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => $project,
        ]);
    }

    /**
     * Get all experience timeline items.
     */
    public function experiences(): JsonResponse
    {
        $experiences = Experience::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $experiences->count(),
            'data' => $experiences,
        ]);
    }

    /**
     * Get all toolkit / skill items.
     */
    public function skills(): JsonResponse
    {
        $skills = Skill::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $skills->count(),
            'data' => $skills,
        ]);
    }

    /**
     * Handle contact inquiry via API.
     */
    public function contact(ContactRequest $request): JsonResponse
    {
        $message = ContactMessage::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject', 'API Contact Inquiry'),
            'message' => $request->input('message'),
            'ip_address' => $request->ip(),
            'is_read' => false,
        ]);

        try {
            $adminEmail = env('ADMIN_NOTIFICATION_EMAIL', 'divyanshchawla029@gmail.com');
            \Illuminate\Support\Facades\Mail::raw(
                "You have received a new API inquiry from your portfolio!\n\n" .
                "Sender: {$message->name}\n" .
                "Email: {$message->email}\n" .
                "Subject: " . ($message->subject ?: 'API Inquiry') . "\n" .
                "Time: " . now()->format('Y-m-d H:i:s') . "\n\n" .
                "Message:\n{$message->message}",
                function ($mail) use ($adminEmail, $message) {
                    $mail->to($adminEmail)
                         ->replyTo($message->email, $message->name)
                         ->subject("📬 New Portfolio API Inquiry: " . ($message->subject ?: "from {$message->name}"));
                }
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Failed sending API contact notification email: ' . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Your inquiry has been successfully received.',
            'data' => [
                'id' => $message->id,
                'created_at' => $message->created_at->toIso8601String(),
            ],
        ], 201);
    }
}

