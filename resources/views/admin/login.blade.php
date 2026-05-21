<!DOCTYPE html>
<html lang="az">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Giriş — OghuzTech</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',sans-serif;background:#0A0A0F;color:#E2E8F0;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem}
.bg-glow{position:fixed;inset:0;pointer-events:none;overflow:hidden}
.bg-glow::before{content:'';position:absolute;width:600px;height:600px;background:radial-gradient(circle,rgba(0,212,255,.12),transparent 70%);top:-200px;left:-200px;border-radius:50%}
.bg-glow::after{content:'';position:absolute;width:500px;height:500px;background:radial-gradient(circle,rgba(124,58,237,.1),transparent 70%);bottom:-150px;right:-150px;border-radius:50%}
.login-box{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:3rem 2.5rem;width:100%;max-width:400px;position:relative;z-index:1;backdrop-filter:blur(20px)}
.login-logo{display:flex;align-items:center;gap:.75rem;margin-bottom:2rem;justify-content:center}
.logo-icon{width:42px;height:42px;background:linear-gradient(135deg,#00D4FF,#7C3AED);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;color:#fff}
.logo-text{font-weight:800;font-size:1.3rem}
.logo-text span{color:#00D4FF}
h1{font-size:1.3rem;font-weight:700;text-align:center;margin-bottom:.5rem}
.subtitle{text-align:center;color:#94A3B8;font-size:.85rem;margin-bottom:2rem}
.form-group{margin-bottom:1.1rem}
.form-label{display:block;font-size:.8rem;font-weight:600;color:#94A3B8;margin-bottom:.4rem}
.form-control{width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:.75rem 1rem;color:#E2E8F0;font-size:.9rem;font-family:'Inter',sans-serif;transition:.2s}
.form-control:focus{outline:none;border-color:#00D4FF;background:rgba(0,212,255,.05)}
.form-control::placeholder{color:rgba(255,255,255,.2)}
.input-wrap{position:relative}
.input-wrap .form-control{padding-left:2.75rem}
.input-icon{position:absolute;left:.9rem;top:50%;transform:translateY(-50%);color:#94A3B8;font-size:.85rem}
.btn-login{width:100%;background:linear-gradient(135deg,#00D4FF,#7C3AED);color:#fff;border:none;padding:.85rem;border-radius:8px;font-size:.95rem;font-weight:700;cursor:pointer;transition:.2s;font-family:'Inter',sans-serif;margin-top:.5rem}
.btn-login:hover{opacity:.9;transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,212,255,.3)}
.alert-danger{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);color:#EF4444;padding:.75rem 1rem;border-radius:8px;font-size:.85rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
.back-link{text-align:center;margin-top:1.5rem;font-size:.82rem;color:#94A3B8}
.back-link a{color:#00D4FF}
</style>
</head>
<body>
<div class="bg-glow"></div>
<div class="login-box">
  <div class="login-logo">
    <div class="logo-icon"><i class="fas fa-microchip"></i></div>
    <div class="logo-text">Oghuz<span>Tech</span></div>
  </div>
  <h1>Admin Paneli</h1>
  <p class="subtitle">Daxil olmaq üçün məlumatlarınızı yazın</p>

  @if($errors->has('login'))
    <div class="alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('login') }}</div>
  @endif

  <form method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <div class="form-group">
      <label class="form-label">İstifadəçi adı</label>
      <div class="input-wrap">
        <i class="fas fa-user input-icon"></i>
        <input type="text" name="username" class="form-control" placeholder="admin" value="{{ old('username') }}" required autofocus>
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Şifrə</label>
      <div class="input-wrap">
        <i class="fas fa-lock input-icon"></i>
        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>
    </div>
    <button type="submit" class="btn-login"><i class="fas fa-right-to-bracket"></i> Daxil ol</button>
  </form>
  <p class="back-link"><a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Sayta qayıt</a></p>
</div>
</body>
</html>
