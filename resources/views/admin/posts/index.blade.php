@extends('layouts.admin')
@section('title','Blog Yazıları')
@section('content')
<div class="page-header">
  <h1>Blog Yazıları</h1>
  <a href="{{ route('admin.posts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Yazı</a>
</div>
<div class="card">
  <div class="table-wrap">
    <table>
      <thead><tr><th>#</th><th>Şəkil</th><th>Başlıq</th><th>Kateqoriya</th><th>Müəllif</th><th>Baxış</th><th>Status</th><th>Tarix</th><th>Əməliyyat</th></tr></thead>
      <tbody>
      @forelse($posts as $post)
      <tr>
        <td class="text-muted">{{ $post->id }}</td>
        <td>@if($post->image)<img src="{{ Storage::url($post->image) }}" class="thumb" alt="">@else<div class="thumb" style="background:rgba(255,255,255,.05);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.2)"><i class="fas fa-image"></i></div>@endif</td>
        <td><div style="font-weight:600">{{ Str::limit($post->title,45) }}</div><div style="font-size:.75rem;color:var(--muted)">/blog/{{ $post->slug }}</div></td>
        <td><span class="badge badge-info">{{ $post->category }}</span></td>
        <td>{{ $post->author }}</td>
        <td>{{ $post->views }}</td>
        <td><span class="badge {{ $post->is_published ? 'badge-success' : 'badge-warning' }}">{{ $post->is_published ? 'Yayımlandı' : 'Qaralama' }}</span></td>
        <td class="text-muted">{{ $post->created_at->format('d.m.Y') }}</td>
        <td>
          <div class="flex gap-2">
            <a href="{{ route('admin.posts.edit',$post) }}" class="btn btn-outline btn-sm"><i class="fas fa-pen"></i></a>
            <form method="POST" action="{{ route('admin.posts.destroy',$post) }}" onsubmit="return confirm('Silmək istəyirsiniz?')">@csrf @method('DELETE')
              <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="9"><div class="empty-state"><i class="fas fa-newspaper"></i>Yazı tapılmadı</div></td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="pagi">{{ $posts->links() }}</div>
</div>
@endsection
