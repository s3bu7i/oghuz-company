@extends('layouts.admin')
@section('title','Xidmətlər')
@section('content')
<div class="page-header">
  <h1>Xidmətlər</h1>
  <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Xidmət</a>
</div>
<div class="card">
  <div class="table-wrap">
    <table>
      <thead><tr><th>#</th><th>İkon</th><th>Başlıq</th><th>Sıra</th><th>Aktiv</th><th>Öne Çıxarılmış</th><th>Əməliyyat</th></tr></thead>
      <tbody>
      @forelse($services as $s)
      <tr>
        <td class="text-muted">{{ $s->id }}</td>
        <td><div style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;background:{{ $s->color ?? '#00D4FF' }}22;color:{{ $s->color ?? '#00D4FF' }}"><i class="{{ $s->icon ?? 'fas fa-cog' }}"></i></div></td>
        <td><div style="font-weight:600">{{ $s->title }}</div><div style="font-size:.75rem;color:var(--muted)">{{ Str::limit($s->short_description,50) }}</div></td>
        <td>{{ $s->order }}</td>
        <td><span class="badge {{ $s->is_active ? 'badge-success' : 'badge-danger' }}">{{ $s->is_active ? 'Bəli' : 'Xeyr' }}</span></td>
        <td><span class="badge {{ $s->is_featured ? 'badge-info' : 'badge-warning' }}">{{ $s->is_featured ? 'Bəli' : 'Xeyr' }}</span></td>
        <td>
          <div class="flex gap-2">
            <a href="{{ route('admin.services.edit',$s) }}" class="btn btn-outline btn-sm"><i class="fas fa-pen"></i></a>
            <form method="POST" action="{{ route('admin.services.destroy',$s) }}" onsubmit="return confirm('Silmək istəyirsiniz?')">@csrf @method('DELETE')
              <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="7"><div class="empty-state"><i class="fas fa-cogs"></i>Xidmət tapılmadı</div></td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="pagi">{{ $services->links() }}</div>
</div>
@endsection
