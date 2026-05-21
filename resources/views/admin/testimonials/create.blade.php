@extends('layouts.admin')
@section('title','Yeni Rəy')
@section('content')
<div class="page-header">
  <h1>Yeni Rəy</h1>
  <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Geri</a>
</div>
<form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
@csrf
<div style="display:grid;grid-template-columns:1fr 300px;gap:1.5rem;align-items:start">
  <div class="card">
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Ad Soyad *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">Vəzifə</label>
        <input type="text" name="position" class="form-control" value="{{ old('position') }}">
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Şirkət</label>
      <input type="text" name="company" class="form-control" value="{{ old('company') }}">
    </div>
    <div class="form-group">
      <label class="form-label">Rəy Mətni *</label>
      <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
    </div>
  </div>
  <div style="display:flex;flex-direction:column;gap:1rem">
    <div class="card">
      <div class="form-group">
        <label class="form-label">Reytinq (1-5) *</label>
        <input type="number" name="rating" class="form-control" value="{{ old('rating',5) }}" min="1" max="5" required>
      </div>
      <div class="form-group">
        <label class="form-label">Sıra</label>
        <input type="number" name="order" class="form-control" value="{{ old('order',1) }}" min="1">
      </div>
      <div class="form-group">
        <label class="form-check"><input type="checkbox" name="is_active" value="1" checked> Aktiv</label>
      </div>
      <div class="form-group">
        <label class="form-label">Avatar</label>
        <input type="file" name="avatar" class="form-control" accept="image/*">
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center"><i class="fas fa-save"></i> Saxla</button>
    </div>
  </div>
</div>
</form>
@endsection
