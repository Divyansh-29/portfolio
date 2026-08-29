@extends('layouts.admin')

@section('title', 'Manage Skills & Toolkit')

@section('content')
<div class="card-box">
  <div class="card-header">
    <div>
      <h2 class="card-title">Capabilities / Toolkit</h2>
      <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">Manage the 4-quadrant skill boxes and capabilities shown on the landing page.</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-lime">+ Add Skill Block</a>
  </div>

  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>Number</th>
          <th>Title</th>
          <th>Category</th>
          <th>Description & Technologies</th>
          <th>Order</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($skills as $skill)
          <tr>
            <td class="mono" style="color: var(--lime); font-size: 15px; font-weight: bold;">
              {{ $skill->number }}
            </td>
            <td>
              <strong style="color: #fff; font-size: 15px;">{{ $skill->title }}</strong>
            </td>
            <td>
              <span class="mono" style="font-size: 11px; color: var(--sky);">{{ $skill->category ?? 'General' }}</span>
            </td>
            <td style="color: var(--text-muted); max-width: 320px;">
              {{ $skill->description }}
            </td>
            <td class="mono">
              #{{ $skill->sort_order }}
            </td>
            <td>
              <div class="action-links">
                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 11px;">Edit</a>
                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Delete this skill block?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 11px;">Delete</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 30px;">
              No skill blocks found. Click "+ Add Skill Block" to create one.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

