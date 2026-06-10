@extends('layouts.admin')
@section('title','Tərcümələr')
@section('head')
<style>
.trans-toolbar{display:flex;align-items:center;gap:1rem;flex-wrap:wrap;margin-bottom:1.5rem}
.trans-toolbar form{display:flex;gap:.6rem;align-items:center;flex-wrap:wrap}
.group-tabs{display:flex;gap:.4rem;flex-wrap:wrap}
.group-tab{padding:.35rem .85rem;border-radius:50px;font-size:.75rem;font-weight:600;cursor:pointer;border:1px solid var(--border);color:var(--muted);background:transparent;transition:.2s;text-decoration:none}
.group-tab:hover{border-color:var(--primary);color:var(--primary)}
.group-tab.active{background:rgba(0,212,255,.12);border-color:var(--primary);color:var(--primary)}
.trans-table-wrap{overflow-x:auto}
.trans-table{width:100%;border-collapse:collapse}
.trans-table th{padding:.65rem 1rem;font-size:.72rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);text-align:left;border-bottom:1px solid var(--border);white-space:nowrap}
.trans-table td{padding:.6rem .8rem;border-bottom:1px solid rgba(255,255,255,.04);vertical-align:top}
.trans-table tr:hover td{background:rgba(255,255,255,.015)}
.key-cell{font-family:monospace;font-size:.78rem;color:#7dd3fc;white-space:nowrap}
.group-pill{display:inline-block;padding:.15rem .55rem;border-radius:50px;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em}
.gp-nav{background:rgba(124,58,237,.15);color:#a78bfa}
.gp-footer{background:rgba(245,158,11,.1);color:#fbbf24}
.gp-home{background:rgba(34,197,94,.1);color:#4ade80}
.gp-services{background:rgba(0,212,255,.1);color:#22d3ee}
.gp-portfolio{background:rgba(239,68,68,.1);color:#f87171}
.gp-blog{background:rgba(251,113,133,.1);color:#fb7185}
.gp-contact{background:rgba(99,102,241,.1);color:#818cf8}
.gp-meta{background:rgba(234,179,8,.1);color:#facc15}
.gp-general{background:rgba(148,163,184,.1);color:#94a3b8}
.lang-col{display:flex;flex-direction:column;gap:.3rem}
.lang-label{font-size:.65rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.1rem}
.trans-input{width:100%;min-width:260px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:6px;padding:.45rem .7rem;color:var(--text);font-size:.82rem;font-family:inherit;transition:.2s;resize:vertical}
.trans-input:focus{outline:none;border-color:var(--primary);background:rgba(0,212,255,.04)}
.trans-input.multiline{min-height:60px}
.save-bar{position:sticky;bottom:0;background:rgba(13,13,22,.95);backdrop-filter:blur(10px);border-top:1px solid var(--border);padding:1rem 2rem;display:flex;align-items:center;justify-content:space-between;z-index:30;margin:-2rem;margin-top:2rem}
.count-badge{font-size:.8rem;color:var(--muted)}
.add-key-card{background:rgba(0,212,255,.04);border:1px dashed rgba(0,212,255,.2);border-radius:var(--radius);padding:1.25rem;margin-bottom:1.5rem}
.add-key-card summary{cursor:pointer;font-weight:600;font-size:.88rem;color:var(--primary);list-style:none;display:flex;align-items:center;gap:.5rem}
.add-key-card summary::before{content:'+';width:20px;height:20px;background:rgba(0,212,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1rem;line-height:1}
.add-key-card[open] summary::before{content:'−'}
.add-key-body{margin-top:1rem;display:grid;grid-template-columns:1fr 1fr 1fr;gap:.75rem}
@media(max-width:900px){.add-key-body{grid-template-columns:1fr}}
.del-btn{display:inline-flex;align-items:center;justify-content:center;width:26px;height:26px;border:none;border-radius:6px;background:rgba(239,68,68,.1);color:var(--danger);cursor:pointer;transition:.2s;flex-shrink:0}
.del-btn:hover{background:rgba(239,68,68,.25)}
</style>
@endsection

@section('content')
<div class="page-header">
  <h1><i class="fas fa-language text-primary" style="margin-right:.5rem"></i>Sayt Tərcümələri</h1>
  <span class="count-badge">{{ $az->count() }} açar</span>
</div>

{{-- Toolbar --}}
<div class="trans-toolbar">
  {{-- Group Tabs --}}
  <div class="group-tabs">
    <a href="{{ route('admin.translations.index', array_merge(request()->query(), ['group'=>'all'])) }}"
       class="group-tab {{ $group==='all'?'active':'' }}">Hamısı</a>
    @foreach($groups as $g)
    <a href="{{ route('admin.translations.index', array_merge(request()->query(), ['group'=>$g])) }}"
       class="group-tab {{ $group===$g?'active':'' }}">{{ ucfirst($g) }}</a>
    @endforeach
  </div>

  {{-- Search --}}
  <form method="GET" action="{{ route('admin.translations.index') }}" style="margin-left:auto">
    <input type="hidden" name="group" value="{{ $group }}">
    <input type="text" name="search" value="{{ $search }}" placeholder="Açar və ya mətn axtar..."
           class="form-control" style="width:220px;padding:.45rem .85rem;font-size:.82rem">
    <button type="submit" class="btn btn-outline btn-sm"><i class="fas fa-search"></i></button>
    @if($search)
    <a href="{{ route('admin.translations.index', ['group'=>$group]) }}" class="btn btn-outline btn-sm"><i class="fas fa-times"></i></a>
    @endif
  </form>
</div>

{{-- Add New Key --}}
<details class="add-key-card">
  <summary><span>Yeni açar əlavə et</span></summary>
  <form method="POST" action="{{ route('admin.translations.create') }}" class="add-key-body">
    @csrf
    <div>
      <label class="form-label">Açar (yalnız a-z, 0-9, _)</label>
      <input type="text" name="key" class="form-control" placeholder="məs: hero_title" pattern="[a-z0-9_]+" required>
    </div>
    <div>
      <label class="form-label">Qrup</label>
      <select name="group" class="form-control">
        @foreach($groups as $g)
        <option value="{{ $g }}">{{ ucfirst($g) }}</option>
        @endforeach
        <option value="general">general</option>
      </select>
    </div>
    <div style="grid-column:1/-1;display:grid;grid-template-columns:1fr 1fr;gap:.75rem">
      <div>
        <label class="form-label">🇦🇿 Azərbaycanca mətn</label>
        <textarea name="value_az" class="form-control" rows="2" required></textarea>
      </div>
      <div>
        <label class="form-label">🇬🇧 İngiliscə mətn</label>
        <textarea name="value_en" class="form-control" rows="2" required></textarea>
      </div>
    </div>
    <div style="grid-column:1/-1">
      <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Əlavə et</button>
    </div>
  </form>
</details>

{{-- Main Form --}}
<form method="POST" action="{{ route('admin.translations.update') }}" id="transForm">
@csrf
<div class="card" style="padding:0;overflow:hidden">
  <div class="trans-table-wrap">
    <table class="trans-table">
      <thead>
        <tr>
          <th style="width:40px">#</th>
          <th style="width:140px">Açar</th>
          <th style="width:70px">Qrup</th>
          <th>🇦🇿 Azərbaycanca</th>
          <th>🇬🇧 İngiliscə</th>
          <th style="width:44px"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($az as $key => $row)
        @php
          $enRow  = $en->get($key);
          $isLong = strlen($row->value ?? '') > 80 || strlen($enRow?->value ?? '') > 80;
          $gpClass = 'gp-'.($row->group);
        @endphp
        <tr>
          <td style="color:var(--muted);font-size:.72rem">{{ $loop->iteration }}</td>
          <td class="key-cell">{{ $key }}</td>
          <td><span class="group-pill {{ $gpClass }}">{{ $row->group }}</span></td>
          <td>
            @if($isLong)
            <textarea name="translations[az][{{ $key }}]" class="trans-input multiline"
              >{{ $row->value }}</textarea>
            @else
            <input type="text" name="translations[az][{{ $key }}]"
              class="trans-input" value="{{ $row->value }}">
            @endif
          </td>
          <td>
            @if($isLong)
            <textarea name="translations[en][{{ $key }}]" class="trans-input multiline"
              >{{ $enRow?->value }}</textarea>
            @else
            <input type="text" name="translations[en][{{ $key }}]"
              class="trans-input" value="{{ $enRow?->value }}">
            @endif
          </td>
          <td>
            <button type="button" class="del-btn" title="Sil" onclick="deleteTranslation('{{ $key }}')">
              <i class="fas fa-trash-alt" style="font-size:.7rem"></i>
            </button>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="empty-state">
            <i class="fas fa-language"></i>
            Heç bir tərcümə tapılmadı
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Sticky Save Bar --}}
<div class="save-bar">
  <span class="count-badge"><i class="fas fa-info-circle"></i> Dəyişiklikləri etdikdən sonra saxlayın</span>
  <button type="submit" class="btn btn-primary" style="padding:.65rem 2rem;font-size:.9rem">
    <i class="fas fa-save"></i> Bütün Dəyişiklikləri Saxla
  </button>
</div>
</form>

{{-- Hidden form for delete --}}
<form id="deleteForm" method="POST" action="" style="display:none">
  @csrf
  @method('DELETE')
</form>

<script>
function deleteTranslation(key) {
    if (confirm("'" + key + "' açarını silmək istəyirsiniz?")) {
        const form = document.getElementById('deleteForm');
        form.action = "{{ route('admin.translations.destroy', 'PLACEHOLDER') }}".replace('PLACEHOLDER', key);
        form.submit();
    }
}
</script>
@endsection
