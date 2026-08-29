@extends('layouts.admin')

@section('title', 'Inquiries Inbox')

@section('content')
<div class="card-box">
  <div class="card-header">
    <div>
      <h2 class="card-title">Contact Inquiries Inbox</h2>
      <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">Messages received from the portfolio landing page and API contact forms.</p>
    </div>
  </div>

  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>Status</th>
          <th>Sender</th>
          <th>Subject / Excerpt</th>
          <th>Received</th>
          <th>IP Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($messages as $msg)
          <tr style="{{ !$msg->is_read ? 'background: rgba(216, 255, 69, 0.03);' : '' }}">
            <td>
              @if(!$msg->is_read)
                <span class="badge" style="background: var(--lime); color: #111;">NEW</span>
              @else
                <span style="color: var(--text-muted); font-size: 11px;" class="mono">READ</span>
              @endif
            </td>
            <td>
              <div style="font-weight: 700; color: #fff;">{{ $msg->name }}</div>
              <a href="mailto:{{ $msg->email }}" class="mono" style="font-size: 12px; color: var(--sky);">{{ $msg->email }}</a>
            </td>
            <td>
              <a href="{{ route('admin.messages.show', $msg) }}" style="font-weight: 600; color: {{ !$msg->is_read ? '#fff' : 'var(--text-muted)' }};">
                <strong>{{ $msg->subject ?: 'Inquiry' }}</strong> — {{ Str::limit($msg->message, 45) }}
              </a>
            </td>
            <td class="mono" style="font-size: 12px; color: var(--text-muted);">
              {{ $msg->created_at->format('M d, Y H:i') }}<br>
              <span style="font-size: 10px;">({{ $msg->created_at->diffForHumans() }})</span>
            </td>
            <td class="mono" style="font-size: 11px; color: var(--text-muted);">
              {{ $msg->ip_address ?? '—' }}
            </td>
            <td>
              <div class="action-links">
                <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 11px;">View</a>
                <form action="{{ route('admin.messages.toggleRead', $msg) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-secondary" style="padding: 5px 8px; font-size: 11px;">
                    {{ $msg->is_read ? 'Mark Unread' : 'Mark Read' }}
                  </button>
                </form>
                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete this message?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" style="padding: 5px 8px; font-size: 11px;">✕</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 40px;">
              No contact inquiries in your inbox.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div style="margin-top: 20px;">
    {{ $messages->links() }}
  </div>
</div>
@endsection

