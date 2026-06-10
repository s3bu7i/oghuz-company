<!DOCTYPE html>
<html lang="az">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Admin') — OghuzTech Panel</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--primary:#00D4FF;--accent:#7C3AED;--dark:#0A0A0F;--dark2:#111118;--dark3:#1A1A2E;--sidebar:#0D0D16;--text:#E2E8F0;--muted:#94A3B8;--border:rgba(255,255,255,0.07);--radius:10px;--danger:#EF4444;--success:#22C55E;--warning:#F59E0B}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--dark);color:var(--text);display:flex;min-height:100vh;font-size:.9rem}
a{color:inherit;text-decoration:none}
/* Sidebar */
.sidebar{width:240px;background:var(--sidebar);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;left:0;height:100vh;z-index:50;transition:.3s}
.sidebar-logo{padding:1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.75rem}
.logo-icon{width:34px;height:34px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;flex-shrink:0}
.logo-text{font-weight:700;font-size:1rem}
.logo-text span{color:var(--primary)}
.sidebar-nav{flex:1;padding:1rem 0;overflow-y:auto}
.nav-group{margin-bottom:1.5rem}
.nav-group-title{padding:.25rem 1.25rem;font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.25rem}
.sidebar-nav a{display:flex;align-items:center;gap:.75rem;padding:.65rem 1.25rem;color:var(--muted);font-size:.85rem;font-weight:500;transition:.2s;border-left:3px solid transparent;position:relative}
.sidebar-nav a:hover{color:var(--text);background:rgba(255,255,255,.04)}
.sidebar-nav a.active{color:var(--primary);background:rgba(0,212,255,.07);border-left-color:var(--primary)}
.sidebar-nav a i{width:18px;text-align:center;font-size:.85rem}
.badge-count{margin-left:auto;background:var(--danger);color:#fff;font-size:.65rem;font-weight:700;padding:.15rem .45rem;border-radius:50px;min-width:18px;text-align:center}
.sidebar-footer{padding:1rem 1.25rem;border-top:1px solid var(--border)}
.sidebar-footer form button{display:flex;align-items:center;gap:.75rem;color:var(--muted);background:none;border:none;cursor:pointer;font-size:.85rem;font-family:inherit;padding:.5rem 0;width:100%;transition:.2s}
.sidebar-footer form button:hover{color:var(--danger)}
/* Main */
.main{margin-left:240px;flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:var(--sidebar);border-bottom:1px solid var(--border);padding:.85rem 2rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:40}
.topbar-title{font-weight:700;font-size:1rem}
.topbar-right{display:flex;align-items:center;gap:1rem}
.topbar-user{display:flex;align-items:center;gap:.75rem;font-size:.85rem;color:var(--muted)}
.user-avatar{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--accent));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;color:#fff}
.content{flex:1;padding:2rem}
/* Cards */
.card{background:rgba(255,255,255,.03);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem}
.card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;padding-bottom:1rem;border-bottom:1px solid var(--border)}
.card-title{font-weight:700;font-size:.95rem}
/* Stat cards */
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem;margin-bottom:2rem}
.stat-card{background:rgba(255,255,255,.03);border:1px solid var(--border);border-radius:var(--radius);padding:1.25rem;display:flex;align-items:center;gap:1rem;transition:.2s}
.stat-card:hover{border-color:rgba(0,212,255,.2)}
.stat-icon{width:48px;height:48px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0}
.stat-num{font-size:1.6rem;font-weight:800;line-height:1}
.stat-label{font-size:.75rem;color:var(--muted);margin-top:.25rem}
/* Table */
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse}
th{padding:.75rem 1rem;font-size:.75rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--muted);text-align:left;border-bottom:1px solid var(--border)}
td{padding:.85rem 1rem;border-bottom:1px solid rgba(255,255,255,.04);font-size:.85rem;vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:rgba(255,255,255,.02)}
/* Badges */
.badge{display:inline-flex;align-items:center;padding:.25rem .6rem;border-radius:50px;font-size:.7rem;font-weight:700}
.badge-success{background:rgba(34,197,94,.1);color:var(--success)}
.badge-danger{background:rgba(239,68,68,.1);color:var(--danger)}
.badge-warning{background:rgba(245,158,11,.1);color:var(--warning)}
.badge-info{background:rgba(0,212,255,.1);color:var(--primary)}
/* Buttons */
.btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.1rem;border-radius:7px;font-size:.82rem;font-weight:600;cursor:pointer;border:none;transition:.2s;font-family:inherit}
.btn-primary{background:linear-gradient(135deg,var(--primary),var(--accent));color:#fff}
.btn-primary:hover{opacity:.9;transform:translateY(-1px)}
.btn-danger{background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.2);color:var(--danger)}
.btn-danger:hover{background:rgba(239,68,68,.25)}
.btn-sm{padding:.35rem .75rem;font-size:.78rem}
.btn-outline{background:transparent;border:1px solid var(--border);color:var(--muted)}
.btn-outline:hover{border-color:var(--primary);color:var(--primary)}
/* Forms */
.form-group{margin-bottom:1.1rem}
.form-label{display:block;font-size:.8rem;font-weight:600;margin-bottom:.4rem;color:var(--muted)}
.form-control{width:100%;background:rgba(255,255,255,.05);border:1px solid var(--border);border-radius:7px;padding:.65rem .9rem;color:var(--text);font-size:.875rem;font-family:inherit;transition:.2s;resize:vertical}
.form-control:focus{outline:none;border-color:var(--primary);background:rgba(0,212,255,.04)}
.form-control::placeholder{color:rgba(255,255,255,.2)}
.form-check{display:flex;align-items:center;gap:.6rem;cursor:pointer;font-size:.85rem;color:var(--muted)}
.form-check input{width:16px;height:16px;accent-color:var(--primary)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.form-row-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem}
/* Alert */
.alert{padding:.85rem 1.1rem;border-radius:8px;margin-bottom:1rem;font-size:.85rem;display:flex;align-items:center;gap:.5rem}
.alert-success{background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.2);color:var(--success)}
.alert-danger{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:var(--danger)}
/* Pagination */
.pagi{display:flex;gap:.4rem;justify-content:center;margin-top:1.5rem}
.pagi .page-link{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:7px;background:rgba(255,255,255,.04);border:1px solid var(--border);color:var(--muted);font-size:.82rem;transition:.2s}
.pagi .page-link:hover,.pagi .active .page-link{border-color:var(--primary);color:var(--primary)}
/* Misc */
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem}
.page-header h1{font-size:1.3rem;font-weight:800}
.text-muted{color:var(--muted)}
.text-primary{color:var(--primary)}
.text-danger{color:var(--danger)}
.text-success{color:var(--success)}
.mt-1{margin-top:.5rem}.mt-2{margin-top:1rem}.mt-3{margin-top:1.5rem}
.mb-1{margin-bottom:.5rem}.mb-2{margin-bottom:1rem}
.flex{display:flex}.items-center{align-items:center}.gap-2{gap:.5rem}.gap-3{gap:.75rem}
img.thumb{width:48px;height:48px;object-fit:cover;border-radius:6px;background:rgba(255,255,255,.05)}
.empty-state{text-align:center;padding:4rem;color:var(--muted)}
.empty-state i{font-size:3rem;margin-bottom:1rem;display:block;opacity:.3}
</style>
@yield('head')
</head>
<body>
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon"><i class="fas fa-microchip"></i></div>
    <div class="logo-text">Oghuz<span>Tech</span></div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-group">
      <div class="nav-group-title">Ümumi</div>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-gauge-high"></i> Dashboard
      </a>
    </div>
    <div class="nav-group">
      <div class="nav-group-title">Məzmun</div>
      <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts*') ? 'active' : '' }}">
        <i class="fas fa-newspaper"></i> Blog Yazıları
      </a>
      <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services*') ? 'active' : '' }}">
        <i class="fas fa-cogs"></i> Xidmətlər
      </a>
      <a href="{{ route('admin.portfolio.index') }}" class="{{ request()->routeIs('admin.portfolio*') ? 'active' : '' }}">
        <i class="fas fa-briefcase"></i> Portfolio
      </a>
      <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
        <i class="fas fa-star"></i> Rəylər
      </a>
    </div>
    <div class="nav-group">
      <div class="nav-group-title">Sistem</div>
      <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
        <i class="fas fa-envelope"></i> Mesajlar
        @php $unread = \App\Models\Message::unread()->count(); @endphp
        @if($unread > 0)<span class="badge-count">{{ $unread }}</span>@endif
      </a>
      <a href="{{ route('admin.translations.index') }}" class="{{ request()->routeIs('admin.translations*') ? 'active' : '' }}">
        <i class="fas fa-language"></i> Tərcümələr
      </a>
      <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
        <i class="fas fa-sliders"></i> Parametrlər
      </a>
    </div>
  </nav>
  <div class="sidebar-footer">
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit"><i class="fas fa-right-from-bracket"></i> Çıxış</button>
    </form>
  </div>
</aside>
<div class="main">
  <header class="topbar">
    <div class="topbar-title">@yield('title','Dashboard')</div>
    <div class="topbar-right">
      <a href="{{ route('home') }}" target="_blank" class="btn btn-outline btn-sm"><i class="fas fa-external-link-alt"></i> Saytı Aç</a>
      <div class="topbar-user">
        <div class="user-avatar">A</div>
        <span>Admin</span>
      </div>
    </div>
  </header>
  <main class="content">
    @if(session('success'))
      <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
    @yield('content')
  </main>
</div>
</body>
</html>
