@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="page-header">
  <h1>Dashboard</h1>
  <span class="text-muted" style="font-size:.8rem">{{ now()->format('d.m.Y H:i') }}</span>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(0,212,255,.1);color:#00D4FF"><i class="fas fa-newspaper"></i></div>
    <div><div class="stat-num">{{ $stats['posts'] }}</div><div class="stat-label">Blog Yazısı</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(124,58,237,.1);color:#7C3AED"><i class="fas fa-cogs"></i></div>
    <div><div class="stat-num">{{ $stats['services'] }}</div><div class="stat-label">Xidmət</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(245,158,11,.1);color:#F59E0B"><i class="fas fa-briefcase"></i></div>
    <div><div class="stat-num">{{ $stats['portfolio'] }}</div><div class="stat-label">Portfolio</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(34,197,94,.1);color:#22C55E"><i class="fas fa-star"></i></div>
    <div><div class="stat-num">{{ $stats['testimonials'] }}</div><div class="stat-label">Rəy</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(239,68,68,.1);color:#EF4444"><i class="fas fa-envelope"></i></div>
    <div><div class="stat-num">{{ $stats['messages'] }}</div><div class="stat-label">Mesaj <span style="font-size:.7rem;color:#EF4444">({{ $stats['unread'] }} oxunmamış)</span></div></div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
  <div class="card">
    <div class="card-header">
      <span class="card-title"><i class="fas fa-envelope" style="color:#00D4FF"></i> Son Mesajlar</span>
      <a href="{{ route('admin.messages.index') }}" class="btn btn-outline btn-sm">Hamısı</a>
    </div>
    @forelse($recentMessages as $msg)
    <div style="display:flex;align-items:center;justify-content:space-between;padding:.65rem 0;border-bottom:1px solid rgba(255,255,255,.04)">
      <div>
        <div style="font-weight:600;font-size:.85rem">{{ $msg->name }} @if(!$msg->is_read)<span class="badge badge-danger" style="margin-left:.4rem">Yeni</span>@endif</div>
        <div style="font-size:.75rem;color:var(--muted)">{{ Str::limit($msg->subject ?: $msg->message, 45) }}</div>
      </div>
      <div style="font-size:.72rem;color:var(--muted);white-space:nowrap;margin-left:.5rem">{{ $msg->created_at->diffForHumans() }}</div>
    </div>
    @empty
    <p class="text-muted" style="font-size:.85rem">Mesaj yoxdur</p>
    @endforelse
  </div>

  <div class="card">
    <div class="card-header">
      <span class="card-title"><i class="fas fa-newspaper" style="color:#7C3AED"></i> Son Yazılar</span>
      <a href="{{ route('admin.posts.index') }}" class="btn btn-outline btn-sm">Hamısı</a>
    </div>
    @forelse($recentPosts as $post)
    <div style="display:flex;align-items:center;justify-content:space-between;padding:.65rem 0;border-bottom:1px solid rgba(255,255,255,.04)">
      <div>
        <div style="font-weight:600;font-size:.85rem">{{ Str::limit($post->title,40) }}</div>
        <div style="font-size:.75rem;color:var(--muted)">{{ $post->category }} · {{ $post->views }} baxış</div>
      </div>
      <span class="badge {{ $post->is_published ? 'badge-success' : 'badge-warning' }}">{{ $post->is_published ? 'Yayımlandı' : 'Qaralama' }}</span>
    </div>
    @empty
    <p class="text-muted" style="font-size:.85rem">Yazı yoxdur</p>
    @endforelse
  </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-top:1.5rem">
  <a href="{{ route('admin.posts.create') }}" class="card" style="display:flex;align-items:center;gap:1rem;cursor:pointer;transition:.2s" onmouseover="this.style.borderColor='rgba(0,212,255,.3)'" onmouseout="this.style.borderColor='rgba(255,255,255,.07)'">
    <div class="stat-icon" style="background:rgba(0,212,255,.1);color:#00D4FF;width:40px;height:40px;font-size:.9rem"><i class="fas fa-plus"></i></div>
    <span style="font-weight:600;font-size:.88rem">Yazı Əlavə Et</span>
  </a>
  <a href="{{ route('admin.services.create') }}" class="card" style="display:flex;align-items:center;gap:1rem;cursor:pointer;transition:.2s" onmouseover="this.style.borderColor='rgba(124,58,237,.3)'" onmouseout="this.style.borderColor='rgba(255,255,255,.07)'">
    <div class="stat-icon" style="background:rgba(124,58,237,.1);color:#7C3AED;width:40px;height:40px;font-size:.9rem"><i class="fas fa-plus"></i></div>
    <span style="font-weight:600;font-size:.88rem">Xidmət Əlavə Et</span>
  </a>
  <a href="{{ route('admin.portfolio.create') }}" class="card" style="display:flex;align-items:center;gap:1rem;cursor:pointer;transition:.2s" onmouseover="this.style.borderColor='rgba(245,158,11,.3)'" onmouseout="this.style.borderColor='rgba(255,255,255,.07)'">
    <div class="stat-icon" style="background:rgba(245,158,11,.1);color:#F59E0B;width:40px;height:40px;font-size:.9rem"><i class="fas fa-plus"></i></div>
    <span style="font-weight:600;font-size:.88rem">Portfolio Əlavə Et</span>
  </a>
  <a href="{{ route('admin.testimonials.create') }}" class="card" style="display:flex;align-items:center;gap:1rem;cursor:pointer;transition:.2s" onmouseover="this.style.borderColor='rgba(34,197,94,.3)'" onmouseout="this.style.borderColor='rgba(255,255,255,.07)'">
    <div class="stat-icon" style="background:rgba(34,197,94,.1);color:#22C55E;width:40px;height:40px;font-size:.9rem"><i class="fas fa-plus"></i></div>
    <span style="font-weight:600;font-size:.88rem">Rəy Əlavə Et</span>
  </a>
</div>
@endsection
