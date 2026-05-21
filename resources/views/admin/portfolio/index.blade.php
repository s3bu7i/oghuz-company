@extends('layouts.admin')
@section('title','Portfolio')
@section('content')
<div class="page-header">
  <h1>Portfolio</h1>
  <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Layihə</a>
</div>
<div class="card">
  <div class="table-wrap">
    <table>
      <thead><tr><th>#</th><th>Şəkil</th><th>Başlıq</th><th>Kateqoriya</th><th>Müştəri</th><th>Sıra</th><th>Status</th><th>Əməliyyat</th></tr></thead>
      <tbody>
      @forelse($portfolios as $p)
      <tr>
        <td class="text-muted">{{ $p->id }}</td>
        <td>@if($p->image)<img src="{{ Storage::url($p->image) }}" class="thumb" alt="">@else<div class="thumb" style="background:rgba(255,255,255,.05);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.2)"><i class="fas fa-image"></i></div>@endif</td>
        <td><div style="font-weight:600">{{ Str::limit($p->title,40) }}</div><div style="font-size:.75rem;color:var(--muted)">{{ $p->technologies }}</div></td>
        <td><span class="badge badge-info">{{ $p->category }}</span></td>
        <td>{{ $p->client }}</td>
        <td>{{ $p->order }}</td>
        <td><span class="badge {{ $p->is_active ? 'badge-success' : 'badge-danger' }}">{{ $p->is_active ? 'Aktiv' : 'Gizli' }}</span></td>
        <td>
          <div class="flex gap-2">
            <a href="{{ route('admin.portfolio.edit',$p) }}" class="btn btn-outline btn-sm"><i class="fas fa-pen"></i></a>
            <form method="POST" action="{{ route('admin.portfolio.destroy',$p) }}" onsubmit="return confirm('Silmək istəyirsiniz?')">@csrf @method('DELETE')
              <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="8"><div class="empty-state"><i class="fas fa-briefcase"></i>Layihə tapılmadı</div></td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="pagi">{{ $portfolios->links() }}</div>
</div>
@endsection
