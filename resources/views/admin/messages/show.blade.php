@extends('layouts.admin')
@section('title','Mesaj Detalı')
@section('content')
<div class="page-header">
  <h1>Mesaj Detalı</h1>
  <a href="{{ route('admin.messages.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Geri</a>
</div>

<div class="card" style="max-width:800px">
  <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid var(--border)">
    <div>
      <h2 style="font-size:1.4rem;font-weight:700;margin-bottom:.5rem">{{ $message->subject ?: 'Mövzu yoxdur' }}</h2>
      <div style="font-size:.9rem;color:var(--muted)">Xidmət: <span style="color:var(--text)">{{ $message->service ?: 'Qeyd edilməyib' }}</span></div>
    </div>
    <div style="text-align:right">
      <div style="font-weight:600;font-size:1.1rem;margin-bottom:.2rem">{{ $message->name }}</div>
      <div style="font-size:.85rem;color:var(--muted)">{{ $message->created_at->format('d.m.Y H:i') }}</div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem;background:rgba(255,255,255,.02);padding:1.5rem;border-radius:10px">
    <div>
      <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.3rem">Email</div>
      <div style="font-weight:500"><a href="mailto:{{ $message->email }}" style="color:var(--primary)">{{ $message->email }}</a></div>
    </div>
    <div>
      <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.3rem">Telefon</div>
      <div style="font-weight:500"><a href="tel:{{ $message->phone }}" style="color:var(--text)">{{ $message->phone ?: 'Qeyd edilməyib' }}</a></div>
    </div>
    <div>
      <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.3rem">IP Ünvan</div>
      <div style="font-weight:500;font-family:monospace">{{ $message->ip_address ?: '-' }}</div>
    </div>
    <div>
      <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.3rem">Status</div>
      <div>
        @if($message->status === 'replied') <span class="badge badge-success">Cavablandı</span>
        @else <span class="badge badge-warning">Gözləyir</span> @endif
      </div>
    </div>
  </div>

  <div>
    <div style="font-size:.85rem;color:var(--muted);margin-bottom:.75rem;font-weight:600">Mesaj mətni:</div>
    <div style="background:rgba(0,0,0,.2);padding:1.5rem;border-radius:10px;line-height:1.8;white-space:pre-wrap">{{ $message->message }}</div>
  </div>

  <div style="margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid var(--border);display:flex;gap:1rem">
    <a href="mailto:{{ $message->email }}" class="btn btn-primary"><i class="fas fa-reply"></i> Cavabla</a>
    @if($message->status !== 'replied')
    <form method="POST" action="{{ route('admin.messages.read',$message) }}">@csrf @method('PATCH')
      <button class="btn btn-outline" style="color:#22C55E;border-color:rgba(34,197,94,.3)"><i class="fas fa-check"></i> Həll edildi (Cavablandı)</button>
    </form>
    @endif
  </div>
</div>
@endsection
