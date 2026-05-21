@extends('layouts.admin')
@section('title','Mesajlar')
@section('content')
<div class="page-header">
  <h1>Əlaqə Mesajları</h1>
</div>
<div class="card">
  <div class="table-wrap">
    <table>
      <thead><tr><th>#</th><th>Göndərən</th><th>Xidmət</th><th>Tarix</th><th>Status</th><th>Əməliyyat</th></tr></thead>
      <tbody>
      @forelse($messages as $m)
      <tr style="{{ !$m->is_read ? 'background:rgba(255,255,255,.03);font-weight:600' : '' }}">
        <td class="text-muted">{{ $m->id }}</td>
        <td>
          <div style="font-size:.9rem">{{ $m->name }} @if(!$m->is_read)<span class="badge badge-danger" style="margin-left:.4rem">Yeni</span>@endif</div>
          <div style="font-size:.75rem;color:var(--muted)"><i class="fas fa-envelope"></i> {{ $m->email }} &nbsp;&nbsp; <i class="fas fa-phone"></i> {{ $m->phone ?: '-' }}</div>
        </td>
        <td>{{ $m->service ?: '-' }}</td>
        <td><div style="font-size:.85rem">{{ $m->created_at->format('d.m.Y H:i') }}</div><div style="font-size:.7rem;color:var(--muted)">{{ $m->created_at->diffForHumans() }}</div></td>
        <td>
          @if($m->status === 'replied') <span class="badge badge-success">Cavablandı</span>
          @elseif($m->is_read) <span class="badge badge-info">Oxundu</span>
          @else <span class="badge badge-warning">Gözləyir</span> @endif
        </td>
        <td>
          <div class="flex gap-2">
            <a href="{{ route('admin.messages.show',$m) }}" class="btn btn-outline btn-sm" title="Bax"><i class="fas fa-eye"></i></a>
            @if(!$m->is_read)
            <form method="POST" action="{{ route('admin.messages.read',$m) }}">@csrf @method('PATCH')
              <button class="btn btn-success btn-sm" title="Oxundu kimi işarələ" style="background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.2);color:#22C55E"><i class="fas fa-check"></i></button>
            </form>
            @endif
            <form method="POST" action="{{ route('admin.messages.destroy',$m) }}" onsubmit="return confirm('Silmək istəyirsiniz?')">@csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" title="Sil"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="6"><div class="empty-state"><i class="fas fa-envelope-open"></i>Mesaj tapılmadı</div></td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="pagi">{{ $messages->links() }}</div>
</div>
@endsection
