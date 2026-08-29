@extends('layouts.admin')

@section('title', 'View Inquiry')

@section('content')
<div class="card-box" style="max-width: 800px;">
  <div class="card-header">
    <div>
      <h2 class="card-title">{{ $message->subject ?: 'Portfolio Contact Inquiry' }}</h2>
      <div class="mono" style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">
        Received on {{ $message->created_at->format('F d, Y \a\t h:i A') }} ({{ $message->created_at->diffForHumans() }})
      </div>
    </div>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary" style="font-size: 11px;">← Back to Inbox</a>
  </div>

  <div style="background: #151620; border: 1px solid var(--card-border); border-radius: 6px; padding: 20px; margin-bottom: 24px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; border-bottom: 1px solid var(--card-border); padding-bottom: 16px;">
      <div>
        <div class="mono" style="font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Sender Name</div>
        <div style="font-size: 16px; font-weight: 700; color: #fff; margin-top: 4px;">{{ $message->name }}</div>
      </div>
      <div>
        <div class="mono" style="font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Email Address</div>
        <div style="font-size: 16px; font-weight: 700; color: var(--sky); margin-top: 4px;">
          <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
        </div>
      </div>
      <div>
        <div class="mono" style="font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Sender IP Address</div>
        <div class="mono" style="font-size: 13px; color: var(--text-muted); margin-top: 4px;">{{ $message->ip_address ?? 'Not recorded' }}</div>
      </div>
      <div>
        <div class="mono" style="font-size: 11px; color: var(--text-muted); text-transform: uppercase;">Status</div>
        <div style="font-size: 13px; color: var(--lime); margin-top: 4px;">● Read</div>
      </div>
    </div>

    <div>
      <div class="mono" style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px;">Message Content</div>
      <div style="background: #101118; padding: 18px; border-radius: 4px; font-size: 15px; line-height: 1.7; white-space: pre-wrap; color: #e2e8f0;">{{ $message->message }}</div>
    </div>
  </div>

  <div style="display: flex; gap: 12px; justify-content: space-between;">
    <div style="display: flex; gap: 10px;">
      <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject ?: 'Your Portfolio Inquiry') }}" class="btn btn-lime">
        Reply via Email ↗
      </a>
      <form action="{{ route('admin.messages.toggleRead', $message) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary">
          Mark as Unread
        </button>
      </form>
    </div>

    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message permanently?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">
        Delete Message
      </button>
    </form>
  </div>
</div>
@endsection

