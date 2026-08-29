@extends('layouts.admin')

@section('title', 'Manage Experience')

@section('content')
<div class="card-box">
  <div class="card-header">
    <div>
      <h2 class="card-title">Experience & Education Timeline</h2>
      <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">Manage career timeline entries, companies, and roles.</p>
    </div>
    <a href="{{ route('admin.experiences.create') }}" class="btn btn-lime">+ Add Experience</a>
  </div>

  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>Order</th>
          <th>Company / Institution</th>
          <th>Role / Degree</th>
          <th>Period</th>
          <th>Location</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($experiences as $exp)
          <tr>
            <td class="mono">#{{ $exp->sort_order }}</td>
            <td>
              <strong style="color: var(--orange);">{{ $exp->company }}</strong>
            </td>
            <td>
              <strong style="color: #fff;">{{ $exp->role }}</strong>
            </td>
            <td class="mono" style="font-size: 12px; color: var(--sky);">
              {{ $exp->period }}
            </td>
            <td class="mono" style="font-size: 12px; color: var(--text-muted);">
              {{ $exp->location }}
            </td>
            <td>
              <div class="action-links">
                <a href="{{ route('admin.experiences.edit', $exp) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 11px;">Edit</a>
                <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
              No experience items found. Click "+ Add Experience" to create one.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

