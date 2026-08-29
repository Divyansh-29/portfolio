@extends('layouts.admin')

@section('title', 'Add Experience')

@section('content')
<div class="card-box" style="max-width: 700px;">
  <div class="card-header">
    <h2 class="card-title">Add Timeline Entry</h2>
    <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary" style="font-size: 11px;">← Back</a>
  </div>

  <form action="{{ route('admin.experiences.store') }}" method="POST">
    @csrf

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="company" class="form-label">Company / Institution *</label>
        <input type="text" name="company" id="company" class="form-control" value="{{ old('company') }}" required placeholder="e.g. Core Tech Info" />
      </div>

      <div class="form-group">
        <label for="role" class="form-label">Role / Degree Title *</label>
        <input type="text" name="role" id="role" class="form-control" value="{{ old('role') }}" required placeholder="e.g. Junior Developer" />
      </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="period" class="form-label">Time Period *</label>
        <input type="text" name="period" id="period" class="form-control" value="{{ old('period') }}" required placeholder="03/2025 - 12/2025" />
      </div>

      <div class="form-group">
        <label for="location" class="form-label">Location / Status</label>
        <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" placeholder="Delhi, India" />
      </div>

      <div class="form-group">
        <label for="sort_order" class="form-label">Display Order</label>
        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 1) }}" />
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="form-label">Description *</label>
      <textarea name="description" id="description" class="form-control" rows="4" required placeholder="Describe responsibilities and accomplishments...">{{ old('description') }}</textarea>
    </div>

    <div style="margin-top: 24px;">
      <button type="submit" class="btn btn-lime">Save Experience ↗</button>
    </div>
  </form>
</div>
@endsection

