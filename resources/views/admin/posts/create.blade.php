@extends('layouts.admin')
@section('title','Yeni Yazı')
@section('content')
<div class="page-header">
  <h1>Yeni Blog Yazısı</h1>
  <a href="{{ route('admin.posts.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Geri</a>
</div>
<form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
@csrf
<div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">
  <div>
    <div class="card mb-2">
      <div class="form-group">
        <label class="form-label">Başlıq *</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required placeholder="Yazı başlığı">
        @error('title')<div class="text-danger" style="font-size:.78rem;margin-top:.3rem">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Xülasə</label>
        <textarea name="excerpt" class="form-control" rows="2" placeholder="Qısa xülasə (SEO üçün)">{{ old('excerpt') }}</textarea>
      </div>
      <div class="form-group">
        <label class="form-label">Məzmun *</label>
        <textarea name="content" id="content" class="form-control" rows="14" required placeholder="Yazı məzmunu...">{{ old('content') }}</textarea>
        @error('content')<div class="text-danger" style="font-size:.78rem;margin-top:.3rem">{{ $message }}</div>@enderror
      </div>
    </div>
  </div>
  <div style="display:flex;flex-direction:column;gap:1rem">
    <div class="card">
      <div class="card-title mb-1" style="font-size:.9rem;font-weight:700">Yayımlama</div>
      <div class="form-group">
        <label class="form-check">
          <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
          Yayımla
        </label>
      </div>
      <div class="form-group">
        <label class="form-check">
          <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
          Öne çıxarılmış
        </label>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.5rem"><i class="fas fa-save"></i> Saxla</button>
    </div>
    <div class="card">
      <div class="card-title mb-1" style="font-size:.9rem;font-weight:700">Kateqoriya & Müəllif</div>
      <div class="form-group">
        <label class="form-label">Kateqoriya *</label>
        <input type="text" name="category" class="form-control" value="{{ old('category') }}" required placeholder="AI & Tech">
      </div>
      <div class="form-group">
        <label class="form-label">Müəllif</label>
        <input type="text" name="author" class="form-control" value="{{ old('author','OghuzTech') }}" placeholder="OghuzTech">
      </div>
    </div>
    <div class="card">
      <div class="card-title mb-1" style="font-size:.9rem;font-weight:700">Şəkil</div>
      <div class="form-group" style="margin-bottom:0">
        <label class="form-label">Örtük şəkli</label>
        <input type="file" name="image" class="form-control" accept="image/*">
      </div>
    </div>
  </div>
</div>
</form>
@endsection
