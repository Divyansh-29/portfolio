@extends('layouts.admin')

@section('title', 'Manage Projects')

@section('content')
<div class="card-box">
  <div class="card-header">
    <div>
      <h2 class="card-title">Portfolio Projects</h2>
      <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">Add, reorder, or update your portfolio projects and showcase cards.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-lime">+ Add New Project</a>
  </div>

  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>Order</th>
          <th>Title & Subtitle</th>
          <th>Art Theme</th>
          <th>Tags</th>
          <th>Featured</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($projects as $project)
          <tr>
            <td class="mono">#{{ $project->sort_order }}</td>
            <td>
              <div style="font-weight: 700; color: #fff;">{{ $project->title }}</div>
              <div style="color: var(--text-muted); font-size: 12px;">{{ $project->subtitle }}</div>
            </td>
            <td>
              <span class="mono" style="background: rgba(255,255,255,0.08); padding: 3px 8px; border-radius: 3px; font-size: 11px;">
                {{ $project->art_type }}
              </span>
            </td>
            <td>
              @if(is_array($project->tags))
                <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                  @foreach($project->tags as $t)
                    <span class="mono" style="font-size: 10px; color: var(--lime); background: rgba(216,255,69,0.1); padding: 2px 6px; border-radius: 3px;">
                      {{ $t }}
                    </span>
                  @endforeach
                </div>
              @endif
            </td>
            <td>
              @if($project->is_featured)
                <span class="mono" style="color: var(--success); font-size: 11px;">● Active</span>
              @else
                <span class="mono" style="color: var(--text-muted); font-size: 11px;">○ Hidden</span>
              @endif
            </td>
            <td>
              <div class="action-links">
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 11px;">Edit</a>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
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
              No projects added yet. Click "+ Add New Project" to create one.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

