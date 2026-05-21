@extends('layouts.admin')
@section('title','Yazı Redaktə Et')
@section('content')
<div class="page-header">
  <h1>Yazı Redaktə Et</h1>
  <a href="{{ route('admin.posts.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Geri</a>
</div>
<form method="POST" action="{{ route('admin.posts.update',$post) }}" enctype="multipart/form-data">
@csrf @method('PUT')
<div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">
  <div>
    <div class="card mb-2">
      <div class="form-group">
        <label class="form-label">Başlıq *</label>
        <input type="text" name="title" class="form-control" value="{{ old('title',$post->title) }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">Xülasə</label>
        <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt',$post->excerpt) }}</textarea>
      </div>
      <div class="form-group">
        <label class="form-label">Məzmun *</label>
        <textarea name="content" class="form-control" rows="14" required>{{ old('content',$post->content) }}</textarea>
      </div>
    </div>
  </div>
  <div style="display:flex;flex-direction:column;gap:1rem">
    <div class="card">
      <div class="card-title mb-1" style="font-size:.9rem;font-weight:700">Yayımlama</div>
      <div class="form-group">
        <label class="form-check">
          <input type="checkbox" name="is_published" value="1" {{ $post->is_published ? 'checked' : '' }}>
          Yayımla
        </label>
      </div>
      <div class="form-group">
        <label class="form-check">
          <input type="checkbox" name="is_featured" value="1" {{ $post->is_featured ? 'checked' : '' }}>
          Öne çıxarılmış
        </label>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.5rem"><i class="fas fa-save"></i> Yadda Saxla</button>
    </div>
    <div class="card">
      <div class="form-group">
        <label class="form-label">Kateqoriya *</label>
        <input type="text" name="category" class="form-control" value="{{ old('category',$post->category) }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">Müəllif</label>
        <input type="text" name="author" class="form-control" value="{{ old('author',$post->author) }}">
      </div>
    </div>
    <div class="card">
      <div class="card-title mb-1" style="font-size:.9rem;font-weight:700">Şəkil</div>
      @if($post->image)
        <img src="{{ Storage::url($post->image) }}" style="width:100%;border-radius:6px;margin-bottom:.75rem;max-height:140px;object-fit:cover" alt="">
      @endif
      <input type="file" name="image" class="form-control" accept="image/*">
    </div>
  </div>
</div>
</form>
@endsection
