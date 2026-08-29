<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store an incoming contact message with validation and rate limiting.
     */
    public function store(ContactRequest $request): JsonResponse|RedirectResponse
    {
        $message = ContactMessage::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject', 'Portfolio Inquiry'),
            'message' => $request->input('message'),
            'ip_address' => $request->ip(),
            'is_read' => false,
        ]);

        // Send email notification to admin
        try {
            $adminEmail = env('ADMIN_NOTIFICATION_EMAIL', 'divyanshchawla029@gmail.com');
            \Illuminate\Support\Facades\Mail::raw(
                "You have received a new inquiry from your portfolio message box!\n\n" .
                "Sender: {$message->name}\n" .
                "Email: {$message->email}\n" .
                "Subject: " . ($message->subject ?: 'General Inquiry') . "\n" .
                "Time: " . now()->format('Y-m-d H:i:s') . "\n" .
                "Sender IP: " . ($message->ip_address ?: 'Unknown') . "\n\n" .
                "------------------ MESSAGE ------------------\n\n" .
                "{$message->message}\n\n" .
                "---------------------------------------------\n" .
                "You can also manage and reply to this inquiry in your Admin Dashboard at: " . route('admin.messages.show', $message),
                function ($mail) use ($adminEmail, $message) {
                    $mail->to($adminEmail)
                         ->replyTo($message->email, $message->name)
                         ->subject("📬 New Portfolio Message: " . ($message->subject ?: "from {$message->name}"));
                }
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Failed sending contact notification email: ' . $e->getMessage());
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been received. I will get back to you shortly.',
                'data' => [
                    'id' => $message->id,
                    'created_at' => $message->created_at->diffForHumans(),
                ],
            ], 201);
        }

        return redirect()->to(url('/#say-hello'))
            ->with('success', 'Thank you! Your message has been received. I will get back to you shortly.');
    }
}
