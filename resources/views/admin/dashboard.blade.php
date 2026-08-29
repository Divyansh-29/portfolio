@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="grid-stats">
  <div class="stat-card lime">
    <div class="stat-label">Total Projects</div>
    <div class="stat-num">{{ $totalProjects }}</div>
  </div>
  <div class="stat-card orange">
    <div class="stat-label">Unread Inquiries</div>
    <div class="stat-num">{{ $unreadMessagesCount }}</div>
  </div>
  <div class="stat-card pink">
    <div class="stat-label">Experience Entries</div>
    <div class="stat-num">{{ $totalExperiences }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Toolkit / Skills</div>
    <div class="stat-num">{{ $totalSkills }}</div>
  </div>
</div>

<div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 24px;">
  <!-- Recent Messages Box -->
  <div class="card-box">
    <div class="card-header">
      <h2 class="card-title">Recent Inquiries</h2>
      <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary" style="font-size: 11px; padding: 6px 12px;">View All</a>
    </div>

    @if($recentMessages->count() > 0)
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>From</th>
              <th>Subject</th>
              <th>Received</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recentMessages as $msg)
              <tr>
                <td>
                  <strong>{{ $msg->name }}</strong><br>
                  <span class="mono" style="font-size: 11px; color: var(--text-muted);">{{ $msg->email }}</span>
                </td>
                <td>
                  <a href="{{ route('admin.messages.show', $msg) }}" style="color: var(--sky); font-weight: 600;">
                    {{ Str::limit($msg->subject ?: $msg->message, 35) }}
                  </a>
                </td>
                <td class="mono" style="font-size: 11px; color: var(--text-muted);">
                  {{ $msg->created_at->diffForHumans() }}
                </td>
                <td>
                  @if($msg->is_read)
                    <span style="color: var(--text-muted); font-size: 12px;">Read</span>
                  @else
                    <span class="badge">NEW</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p style="color: var(--text-muted); font-size: 14px;">No contact inquiries received yet.</p>
    @endif
  </div>

  <!-- Quick Project Overview -->
  <div class="card-box">
    <div class="card-header">
      <h2 class="card-title">Featured Projects</h2>
      <a href="{{ route('admin.projects.create') }}" class="btn btn-lime" style="font-size: 11px; padding: 6px 12px;">+ Add Project</a>
    </div>

    @if($recentProjects->count() > 0)
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Project</th>
              <th>Category</th>
              <th>Order</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recentProjects as $proj)
              <tr>
                <td>
                  <strong>{{ $proj->title }}</strong>
                </td>
                <td>
                  <span class="mono" style="font-size: 11px; color: var(--sky);">{{ $proj->category ?? 'Product' }}</span>
                </td>
                <td class="mono">
                  #{{ $proj->sort_order }}
                </td>
                <td>
                  <a href="{{ route('admin.projects.edit', $proj) }}" class="btn btn-secondary" style="padding: 4px 8px; font-size: 11px;">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p style="color: var(--text-muted); font-size: 14px;">No projects found.</p>
    @endif
  </div>
</div>
@endsection

