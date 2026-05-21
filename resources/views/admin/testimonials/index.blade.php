@extends('layouts.admin')
@section('title','Rəylər')
@section('content')
<div class="page-header">
  <h1>Müştəri Rəyləri</h1>
  <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Rəy</a>
</div>
<div class="card">
  <div class="table-wrap">
    <table>
      <thead><tr><th>#</th><th>Ad</th><th>Vəzifə</th><th>Şirkət</th><th>Reytinq</th><th>Sıra</th><th>Status</th><th>Əməliyyat</th></tr></thead>
      <tbody>
      @forelse($testimonials as $t)
      <tr>
        <td class="text-muted">{{ $t->id }}</td>
        <td>
          <div class="flex items-center gap-2">
            @if($t->avatar)<img src="{{ Storage::url($t->avatar) }}" class="thumb" alt="">
            @else<div class="thumb" style="border-radius:50%;background:linear-gradient(135deg,#00D4FF,#7C3AED);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem">{{ strtoupper(substr($t->name,0,1)) }}</div>@endif
            <span style="font-weight:600">{{ $t->name }}</span>
          </div>
        </td>
        <td>{{ $t->position }}</td>
        <td>{{ $t->company }}</td>
        <td style="color:#F59E0B">{{ str_repeat('★', $t->rating) }}</td>
        <td>{{ $t->order }}</td>
        <td><span class="badge {{ $t->is_active ? 'badge-success' : 'badge-danger' }}">{{ $t->is_active ? 'Aktiv' : 'Gizli' }}</span></td>
        <td>
          <div class="flex gap-2">
            <a href="{{ route('admin.testimonials.edit',$t) }}" class="btn btn-outline btn-sm"><i class="fas fa-pen"></i></a>
            <form method="POST" action="{{ route('admin.testimonials.destroy',$t) }}" onsubmit="return confirm('Silmək istəyirsiniz?')">@csrf @method('DELETE')
              <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="8"><div class="empty-state"><i class="fas fa-star"></i>Rəy tapılmadı</div></td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="pagi">{{ $testimonials->links() }}</div>
</div>
@endsection
