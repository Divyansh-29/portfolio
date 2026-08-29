@extends('layouts.admin')

@section('title', 'Edit Skill Block')

@section('content')
<div class="card-box" style="max-width: 700px;">
  <div class="card-header">
    <h2 class="card-title">Edit Skill Block #{{ $skill->number }}</h2>
    <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary" style="font-size: 11px;">← Back</a>
  </div>

  <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: grid; grid-template-columns: 120px 1fr; gap: 20px;">
      <div class="form-group">
        <label for="number" class="form-label">Number *</label>
        <input type="text" name="number" id="number" class="form-control" value="{{ old('number', $skill->number) }}" required />
      </div>

      <div class="form-group">
        <label for="title" class="form-label">Skill / Area Title *</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $skill->title) }}" required />
      </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="category" class="form-label">Category</label>
        <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $skill->category) }}" />
      </div>

      <div class="form-group">
        <label for="sort_order" class="form-label">Display Order</label>
        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $skill->sort_order) }}" />
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="form-label">Tools & Frameworks List *</label>
      <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $skill->description) }}</textarea>
    </div>

    <div style="margin-top: 24px;">
      <button type="submit" class="btn btn-lime">Update Skill ↗</button>
    </div>
  </form>
</div>
@endsection

