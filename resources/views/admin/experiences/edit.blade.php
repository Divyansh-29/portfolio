@extends('layouts.admin')

@section('title', 'Edit Experience')

@section('content')
<div class="card-box" style="max-width: 700px;">
  <div class="card-header">
    <h2 class="card-title">Edit Timeline Entry</h2>
    <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary" style="font-size: 11px;">← Back</a>
  </div>

  <form action="{{ route('admin.experiences.update', $experience) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="company" class="form-label">Company / Institution *</label>
        <input type="text" name="company" id="company" class="form-control" value="{{ old('company', $experience->company) }}" required />
      </div>

      <div class="form-group">
        <label for="role" class="form-label">Role / Degree Title *</label>
        <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $experience->role) }}" required />
      </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="period" class="form-label">Time Period *</label>
        <input type="text" name="period" id="period" class="form-control" value="{{ old('period', $experience->period) }}" required />
      </div>

      <div class="form-group">
        <label for="location" class="form-label">Location / Status</label>
        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $experience->location) }}" />
      </div>

      <div class="form-group">
        <label for="sort_order" class="form-label">Display Order</label>
        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $experience->sort_order) }}" />
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="form-label">Description *</label>
      <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $experience->description) }}</textarea>
    </div>

    <div style="margin-top: 24px;">
      <button type="submit" class="btn btn-lime">Update Experience ↗</button>
    </div>
  </form>
</div>
@endsection

